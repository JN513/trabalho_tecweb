<?php

namespace App\Controllers;

use App\Models\ConteudoModel;

class Home extends BaseController
{
    public function index()
    {
        $conteudoModel = new ConteudoModel();
        $data['conteudo'] = $conteudoModel->getConteudo();
        echo view('templates/Header', ['title' => 'Home']);
        echo view('pages/Index', $data);
        echo view('templates/Footer');
    }
}
