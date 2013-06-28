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
		$r = $r[0];
		$this->mail = $r['mail'];
		$this->user = $r['user'];
		$this->password = $r['password'];
		$this->nome = $r['nome'];
		$this->reais = $r['reais'];
		$this->dollars = $r['dollars'];
	}
}

?>