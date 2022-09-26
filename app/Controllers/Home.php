<?php

namespace App\Controllers;

use App\Models\ConteudoModel;

class Home extends BaseController
{
    public function get_conteudo()
    {
        $conteudoModel = new ConteudoModel();
        return $conteudoModel->getConteudo();
    }

    public function get_reverse_data($where)
    {
        $conteudoModel = new ConteudoModel();

        if ($where == 'id') {
            return $conteudoModel->orderBy('id')->findAll();
        } else if ($where == 'titulo') {
            return $conteudoModel->orderBy('titulo')->findAll();
        } else if ($where == 'descricao') {
            return $conteudoModel->orderBy('descricao')->findAll();
        } else {
            return $conteudoModel->getConteudo();
        }
    }

    public function get_data($where)
    {
        $conteudoModel = new ConteudoModel();

        if ($where == 'id') {
            return $conteudoModel->orderBy('id', 'DESC')->findAll();
        } else if ($where == 'titulo') {
            return $conteudoModel->orderBy('titulo', 'DESC')->findAll();
        } else if ($where == 'descricao') {
            return $conteudoModel->orderBy('descricao', 'DESC')->findAll();
        } else {
            return $conteudoModel->getConteudo();
        }
    }

    public function index()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getVar("orderby")) {
            $where = $this->request->getVar("orderby");

            if (!empty($this->request->getVar("reverse"))) {
                if ($this->request->getVar("reverse") == '1' or $this->request->getVar("reverse") == 1) {
                    $data['conteudo'] = $this->get_reverse_data($where);
                } else {
                    $data['conteudo'] = $this->get_data($where);
                }
            } else {
                $data['conteudo'] = $this->get_data($where);
            }
        } else {
            $data['conteudo'] = $this->get_conteudo();
        }

        echo view('templates/Header', ['title' => 'Home']);
        echo view('pages/Index', $data);
        echo view('templates/Footer');
    }
}
