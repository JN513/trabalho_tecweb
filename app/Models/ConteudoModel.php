<?php

namespace App\Models;

use CodeIgniter\Model;

class ConteudoModel extends Model
{
	/*Atributos de Configuração*/
	protected $table = 'Conteudo';
	protected $primaryKey = 'id';
	//Campos editáveis
	protected $allowedFields = ['imagem', 'titulo', 'descricao', 'body', 'created_at', 'user_id', 'updated_at'];
	/*Método Get para apresentar o conteúdo*/
	public function getConteudo()
	{
		return $this->orderBy('id', 'DESC')->findAll();
	}
	//mostra conteúdo específico
	public function getConteudoItem($id)
	{
		return $this->asArray()->where(['id' => $id])->first();
	}
	//delete conteúdo específico
	public function deleteConteudo($id)
	{
		return $this->delete($id);
	}
	// atualiza conteúdo específico
	public function updateConteudo($id, $data)
	{
		return $this->update($id, $data);
	}
}
