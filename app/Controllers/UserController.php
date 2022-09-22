<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ConteudoModel;

class UserController extends BaseController
{
    public function index($id = NULL)
    {
        if ($id == NULL) {
            $session = session();
            $id = $session->get('id');
        }

        $userModel = new UserModel();
        $conteudoModel = new ConteudoModel();

        $conteudoModel->where('user_id', $id);

        $data['user'] = $userModel->where('id', $id)->first();
        $data['conteudo'] = $conteudoModel->findAll();
        echo view('templates/Header', ['title' => 'Perfil']);
        echo view('pages/Profile', $data);
        echo view('templates/Footer');
    }

    public function list()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        echo view('templates/Header', ['title' => 'Usuários']);
        echo view('pages/Users', $data);
        echo view('templates/Footer');
    }

    public function delete()
    {
        $userModel = new UserModel();
        $id = session()->get('id');
        $userModel->delete($id);
        return redirect()->to('/logout');
    }

    public function edit($id = NULL)
    {
        $session = session();
        $userModel = new UserModel();
        $ids = $session->get('id');

        if ($id != $ids and !session()->get('is_staff')) {
            $session->setFlashdata('error', 'Você não tem permissão para acessar essa página.');
            return redirect()->to('/');
        }

        $data['user'] = $userModel->where('id', $id)->first();
        echo view('templates/Header', ['title' => 'Editar Perfil']);
        echo view('pages/EditProfile', $data);
        echo view('templates/Footer');
    }

    public function update()
    {
        $userModel = new UserModel();
        $session = session();
        $ids = $session->get('id');
        $id = $this->request->getVar('id');

        if ($id != $ids and !session()->get('is_staff')) {
            $session->setFlashdata('error', 'Você não tem permissão para acessar essa página.');
            return redirect()->to('/');
        }

        $data = [
            'id' => $id,
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'password' => $userModel->where('id', $id)->first()['password'],
        ];

        $userModel->save($data);

        $session->setFlashdata('success', 'Perfil atualizado com sucesso.');

        return redirect()->to("/profile/{$data['id']}");
    }
}
