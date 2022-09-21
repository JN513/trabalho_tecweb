<?php
namespace App\Models;
use CodeIgniter\Model;

class ConteudoModel extends Model{
	/*Atributos de Configuração*/
	protected $table = 'Conteudo';
	protected $primaryKey = 'id';
	//Campos editáveis
	protected $allowedFields = ['titulo','descricao','body','created_at'];
	/*Método Get para apresentar o conteúdo*/
	public function getConteudo(){
		return $this->findAll();
	}
	//mostra conteúdo específico
	public function getConteudoItem($id){
		return $this->asArray()->where(['id'=>$id])->first();
	}					
}
?>