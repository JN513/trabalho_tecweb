<?php

namespace App\Controllers;
use App\Models\UserModel;

class SignupController extends BaseController
{

    public function register()
    {
        helper(['form']);
        $data = [];
        echo view('templates/Header');
        echo view('pages/Register', $data);
        echo view('templates/Footer');
    }

    public function store(){
        helper(['form']);
        $rules = [
            'first_name'          => 'required|min_length[2]|max_length[100]',
            'last_name'          => 'required|min_length[2]|max_length[100]',
            'email'         => 'required|min_length[4]|max_length[255]|valid_email|is_unique[User.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $userModel = new UserModel();
            $data = [
                'first_name'     => $this->request->getVar('fist_name'),
                'last_name'     => $this->request->getVar('last_name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'is_staff' => FALSE
            ];
            $userModel->save($data);
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            echo view('templates/Header');
            echo view('pages/Register', $data);
            echo view('templates/Footer');
        }
    }
}