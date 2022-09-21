<?php

namespace App\Controllers;
use App\Models\ConteudoModel;

class ConteudoController extends BaseController
{
    public function create()
    {
        helper(['form']);
        $data = [];
        echo view('templates/Header');
        echo view('pages/CreateContent', $data);
        echo view('templates/Footer');
    }

    public function store(){
        helper(['form']);
        $rules = [
            'titulo'          => 'required|min_length[2]|max_length[100]',
            'descricao'          => 'required|min_length[2]|max_length[200]',
            'body'         => 'required|min_length[4]',
        ];

        if($this->validate($rules)){

            $imagem = $this->request->getFile('imagem');
            $imagem->move('./imagens');
            $nomeImagem = $imagem->getName();

            $currentUserId = session()->get('id');

            $conteudoModel = new ConteudoModel();
            $data = [
                'titulo'     => $this->request->getVar('titulo'),
                'descricao'     => $this->request->getVar('descricao'),
                'body'    => $this->request->getVar('body'),
                'imagem' => $nomeImagem,
                'user_id' => $currentUserId,
            ];

            $conteudoModel->save($data);

            return redirect()->to('/');
        }else{
            $data['validation'] = $this->validator;
            echo view('templates/Header');
            echo view('pages/CreateContent', $data);
            echo view('templates/Footer');
        }
    }
}
