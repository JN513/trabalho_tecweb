<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	/*Atributos de Configuração*/
	protected $table = 'User';
	protected $primaryKey = 'id';
	//Campos editáveis
	protected $allowedFields = ['avatar', 'first_name', 'last_name', 'email', 'password', 'created_at', 'is_staff'];
	/*Método Get para apresentar o usuário*/

	//mostra usuário específico
	public function getUsuario($user)
	{
		return $this->asArray()->where(['User' => $user])->first();
	}
	//mostra todos os usuários
	public function getUsuarios()
	{
		return $this->asArray()->findAll();
	}
	//mostra todos os usuários com paginação
	public function getUsuariosPaginados($limit, $offset)
	{
		return $this->asArray()->findAll($limit, $offset);
	}
	//mostra todos os usuários com paginação e ordenação
	public function getUsuariosPaginadosOrdenados($limit, $offset, $order)
	{
		return $this->asArray()->orderBy($order)->findAll($limit, $offset);
	}
	//mostra todos os usuários com paginação e ordenação e filtro
	public function getUsuariosPaginadosOrdenadosFiltrados($limit, $offset, $order, $filtro)
	{
		return $this->asArray()->like('User', $filtro)->orderBy($order)->findAll($limit, $offset);
	}
	//conta todos os usuários
	public function countUsuarios()
	{
		return $this->countAll();
	}
	//deleta usuário específico
	public function deleteUsuario($user)
	{
		return $this->delete($user);
	}
	// atualiza usuário específico
	public function updateUsuario($user, $data)
	{
		return $this->update($user, $data);
	}

	public function get_full_name($id)
	{
		$user = $this->find($id);
		return $user['first_name'] . ' ' . $user['last_name'];
	}
}
