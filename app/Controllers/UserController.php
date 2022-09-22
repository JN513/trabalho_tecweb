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

        if (!session()->get('is_staff') or !$id == $ids) {
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
    }
}
