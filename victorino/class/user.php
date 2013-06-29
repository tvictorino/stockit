<?php


require_once 'mysql.php';

class User{
	private $id, $mail, $user, $password, $nome, $reais, $dollars;
	private $bd;

	function __construct($id){
		$this->id = $id;
		$this->db = new Mysql();
		$this->load();
	}

	public function load(){
		$sql = "SELECT * FROM users WHERE id = ".$this->id;
		$r = $db->query($sql);
		$r = $r[0];
		$this->mail = $r['mail'];
		$this->user = $r['user'];
		$this->password = $r['password'];
		$this->nome = $r['nome'];
		$this->reais = $r['reais'];
		$this->dollars = $r['dollars'];
	}

	public function save(){
		$sql = "UPDATE users SET (mail,user,password,nome,reais,dollars) VALUE ('".$this->mail."','".$this->user."','".$this->password."','".$this->nome."','".$this->reais."','".$this->dollars."') WHERE id = ".$this->id;
		$this->db->execute($sql);
	}

	public function getStocks(){
		$sql = "SELECT s.*,us.qtd from user_has_stocks as us,stock as s WHERE us.stock = s.id and us.user = ".$this->id;
		return $db->query($sql);
	}
}

?>