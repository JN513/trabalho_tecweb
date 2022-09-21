<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $session->get('id'))->first();
        echo view('templates/Header');
        echo view('pages/Profile', $data);
        echo view('templates/Footer');
    }
}
