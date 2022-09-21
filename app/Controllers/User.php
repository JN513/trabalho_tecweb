<?php

namespace App\Controllers;

class User extends BaseController
{
    public function login()
    {
        echo view('Templates/Header');
        echo view('Pages/Login');
        echo view('Templates/Footer');
    }
}
