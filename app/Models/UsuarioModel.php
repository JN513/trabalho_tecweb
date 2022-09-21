<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model{
	/*Atributos de Configuração*/
	protected $table = 'User';
	protected $primaryKey = 'id';
	//Campos editáveis
	protected $allowedFields = ['first_name','last_name','email', 'password', 'created_at'];
	/*Método Get para apresentar o usuário*/
	
	//mostra usuário específico
	public function getUsuario($user,$senha){
		return $this->asArray()->where(['User'=>$user])->first();
	}					
}
?>