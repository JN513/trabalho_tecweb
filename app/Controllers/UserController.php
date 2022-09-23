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

    public function delete($id = NULL)
    {
        $session = session();
        $userModel = new UserModel();
        $ids = $session->get('id');

        if ($id != $ids and !$session->get('is_staff')) {
            $session->setFlashdata('error', 'Você não tem permissão para acessar essa página.');
            return redirect()->to('/');
        }

        $user = $userModel->where('id', $id)->first();

        if (!empty($user['avatar'])) {
            unlink('./imagens/' . $user['avatar']);
        }

        $userModel->delete($id);

        if ($session->get('is_staff')) {
            return redirect()->to('/users');
        } else {
            return redirect()->to('/logout');
        }
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

        $imagem = $this->request->getFile('avatar');

        if (!empty($imagem->getName())) {
            $imagem->move('./imagens');
            $nomeImagem = $imagem->getName();
            $oldimagename = $userModel->find($id)['avatar'];

            if (file_exists('./imagens/' . $oldimagename) and !empty($oldimagename)) {
                unlink('./imagens/' . $oldimagename);
            }
        } else {
            $nomeImagem = $userModel->find($id)['avatar'];
        }

        $staff = FALSE;

        if ($session->get('is_staff')) {
            $is_staff = $this->request->getVar('is_staff');

            if (!empty($is_staff)) {
                if ($is_staff) {
                    $staff = TRUE;
                }
            }
        }

        $data = [
            'avatar' => $nomeImagem,
            'id' => $id,
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email'),
            'password' => $userModel->where('id', $id)->first()['password'],
            'is_staff' => $staff,
        ];

        $userModel->save($data);

        $session->setFlashdata('success', 'Perfil atualizado com sucesso. e staff: ');

        return redirect()->to("/profile/{$data['id']}");
    }

    public function alterpassword()
    {
        echo view('templates/Header', ['title' => 'Alterar Senha']);
        echo view('pages/ChangePassword');
        echo view('templates/Footer');
    }

    public function changepassword()
    {
        helper(['form']);
        $rules = [
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $session = session();
            $id = $session->get('id');

            $u_password = $userModel->where('id', $id)->first()['password'];
            $old_password = $this->request->getVar('oldpassword');

            if (!password_verify($old_password, $u_password)) {
                $session->setFlashdata('error', 'Senha atual incorreta.');

                return redirect()->to('/user/alterpassword');
            }

            $data = [
                'id' => $id,
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            $userModel->save($data);

            $session->setFlashdata('success', 'Senha alterada com sucesso.');

            return redirect()->to("/profile/{$data['id']}");
        } else {
            $session = session();
            $session->setFlashdata('error', 'As senhas não conferem.');
            return redirect()->to('user/alterpassword');
        }
    }
}
