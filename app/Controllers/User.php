<?php

namespace App\Controllers;

class User extends BaseController
{
    public function login()
    {
        echo view('templates/Header');
        echo view('pages/Login');
        echo view('templates/Footer');
    }
}
