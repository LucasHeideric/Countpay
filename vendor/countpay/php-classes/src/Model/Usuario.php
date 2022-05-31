<?php 
namespace Countpay\Model;
use \Countpay\DB\Sql;
use \Countpay\Model;

	class Usuario extends Model
	{


	// listar usuarios 
	public static function listAll(){
		$sql = new sql();
			return $sql->select("SELECT * FROM  usuario");
		}

	// obter id do user 
	public function get($id_usuario)
			{
			 
			 $sql = new Sql();
			 $results = $sql->select("SELECT * FROM usuario WHERE id_usuario = :id_usuario;", array(
			     ":id_usuario"=>$id_usuario
			 ));
			 
			 if(isset($results[0]))
			 {
				$row = $results[0];
				$this->setData($row);
			 }
			 
			}

			// atualizar dados do user
		public function update()
		{
			$sql = new Sql();
			$results = $sql->select("CALL sp_usuario_update(:id_usuario, :nome, :sobrenome, :email, :data_nascimento, :login, :senha, :id_tipo_usuario)", array(
				
				":id_usuario"=>$this->getid_usuario(),
				":nome"=>$this->getnome(),
                ":sobrenome"=>$this->getsobrenome(),
				":email"=>$this->getemail(),
				":login"=>$this->getlogin(),
				":senha"=>$this->getsenha(),
				":id_tipo_usuario"=>$this->getid_tipo_usuario()
			));
			$this->setData($results[0]);
		}

		// deletar user
		public function delete()
		{
			$sql = new sql();
			$sql->query("CALL sp_users_delete(:iduser)", array(
				":iduser"=>$this->getiduser()
			));
		}
				
}
?>