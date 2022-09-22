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
}
