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

    public function store()
    {
        helper(['form']);
        $rules = [
            'titulo'          => 'required|min_length[2]|max_length[100]',
            'descricao'          => 'required|min_length[2]|max_length[350]',
            'body'         => 'required|min_length[4]',
        ];

        if ($this->validate($rules)) {

            $imagem = $this->request->getFile('imagem');
            $imagem->setName = time() . '' . rand(1000, 9999) . '.' . $imagem->getClientExtension();
            $imagem->move('./imagens');
            $nomeImagem = $imagem->getName();

            echo $nomeImagem;

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
        } else {
            $data['validation'] = $this->validator;
            echo view('templates/Header');
            echo view('pages/CreateContent', $data);
            echo view('templates/Footer');
        }
    }

    public function delete($id)
    {
        $conteudoModel = new ConteudoModel();

        $session = session();

        if ($conteudoModel->find($id)['user_id'] != session()->get('id')) {
            $session->setFlashdata('msg', 'Usuário não autorizado.');

            return redirect()->to('/');
        }

        $conteudoModel->delete($id);

        $session->setFlashdata('msg', 'Conteúdo excluído com sucesso.');

        return redirect()->to('/');
    }

    public function edit($id)
    {
        $conteudoModel = new ConteudoModel();

        $session = session();

        if ($conteudoModel->find($id)['user_id'] != session()->get('id')) {
            $session->setFlashdata('msg', 'Usuário não autorizado.');

            return redirect()->to('/');
        }

        $data['conteudo'] = $conteudoModel->find($id);

        echo view('templates/Header');
        echo view('pages/EditContent', $data);
        echo view('templates/Footer');
    }

    public function update()
    {
        helper(['form']);
        $rules = [
            'titulo'          => 'required|min_length[2]|max_length[100]',
            'descricao'          => 'required|min_length[2]|max_length[350]',
            'body'         => 'required|min_length[4]',
        ];

        if ($this->validate($rules)) {

            $conteudoModel = new ConteudoModel();

            $imagem = $this->request->getFile('imagem');
            $imagem->move('./imagens');
            $nomeImagem = $imagem->getName();

            $currentUserId = session()->get('id');

            $data = [
                'id' => $this->request->getVar('id'),
                'titulo'     => $this->request->getVar('titulo'),
                'descricao'     => $this->request->getVar('descricao'),
                'body'    => $this->request->getVar('body'),
                'imagem' => $nomeImagem,
                'user_id' => $currentUserId,
            ];

            $conteudoModel->save($data);

            return redirect()->to('/');
        } else {
            $data['validation'] = $this->validator;
            echo view('templates/Header');
            echo view('pages/EditContent', $data);
            echo view('templates/Footer');
        }
    }

    public function show($id = NULL)
    {
        $conteudoModel = new ConteudoModel();

        $data['conteudo'] = $conteudoModel->find($id);

        echo view('templates/Header');
        echo view('pages/ShowContent', $data);
        echo view('templates/Footer');
    }
}
