<?php

namespace App\Controllers;

use App\Models\UserModel;

class SigninController extends BaseController
{
    public function login()
    {
        helper(['form']);
        $data = [];
        echo view('templates/Header');
        echo view('pages/Login', $data);
        echo view('templates/Footer');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $userModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'first_name' => $data['first_name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE,
                    'is_staff' => $data['is_staff'],
                ];
                $session->set($ses_data);
                return redirect()->to('/profile');
            } else {
                $session->setFlashdata('msg', 'Senha incorreta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email não cadastrado');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
