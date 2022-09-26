<?php

namespace App\Controllers;

use App\Models\ConteudoModel;

class Home extends BaseController
{
    public function get_conteudo($start, $max_number)
    {
        $conteudoModel = new ConteudoModel();
        return $conteudoModel->limit($start, $max_number)->findAll();
    }

    public function get_reverse_data($where, $start, $max_number)
    {
        $conteudoModel = new ConteudoModel();

        if ($where == 'id') {
            return $conteudoModel->orderBy('id')->limit($start, $max_number)->findAll();
        } else if ($where == 'titulo') {
            return $conteudoModel->orderBy('titulo')->limit($start, $max_number)->findAll();
        } else if ($where == 'descricao') {
            return $conteudoModel->orderBy('descricao')->limit($start, $max_number)->findAll();
        } else {
            return $conteudoModel->limit($start, $max_number)->findAll();
        }
    }

    public function get_data($where, $start, $max_number)
    {
        $conteudoModel = new ConteudoModel();

        if ($where == 'id') {
            return $conteudoModel->orderBy('id', 'DESC')->limit($start, $max_number)->findAll();
        } else if ($where == 'titulo') {
            return $conteudoModel->orderBy('titulo', 'DESC')->limit($start, $max_number)->findAll();
        } else if ($where == 'descricao') {
            return $conteudoModel->orderBy('descricao', 'DESC')->limit($start, $max_number)->findAll();
        } else {
            return $conteudoModel->limit($start, $max_number)->findAll();
        }
    }

    public function get_num_of_registers()
    {
        $conteudoModel = new ConteudoModel();
        return $conteudoModel->countAll();
    }

    public function index()
    {
        helper(['form']);
        $data = [];

        $page = 1;
        $max_number = 10;

        if ($this->request->getVar("page")) {
            $page = $this->request->getVar("page");
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $max_number;
        $data["total_pages"] = ceil($this->get_num_of_registers() / $max_number);


        if ($this->request->getVar("orderby")) {
            $where = $this->request->getVar("orderby");

            if (!empty($this->request->getVar("reverse"))) {
                if ($this->request->getVar("reverse") == '1' or $this->request->getVar("reverse") == 1) {
                    $data['conteudo'] = $this->get_reverse_data($where, $start, $max_number);
                } else {
                    $data['conteudo'] = $this->get_data($where, $start, $max_number);
                }
            } else {
                $data['conteudo'] = $this->get_data($where, $start, $max_number);
            }
        } else {
            $data['conteudo'] = $this->get_conteudo($start, $max_number);
        }

        echo view('templates/Header', ['title' => 'Home']);
        echo view('pages/Index', $data);
        echo view('templates/Footer');
    }
}
