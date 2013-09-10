<?php


require_once 'mysql.php';

class User{
	private $id, $mail, $user, $password, $name, $reais, $dollars;
	private $db;

	function __construct($id){
		$this->id = $id;
		$this->db = new Mysql();
		$this->load();
	}

	public function load(){
		$sql = "SELECT * FROM users WHERE id = ".$this->id;
		$r = $this->db->query($sql);
		$r = $r[0];
		$this->mail = $r['mail'];
		$this->user = $r['user'];
		$this->password = $r['password'];
		$this->nome = $r['name'];
		$this->reais = $r['reais'];
		$this->dollars = $r['dollars'];
	}

	public function setEmail($value){
		$this->email = $value;
	}
	public function setUser($value){
		$this->user = $value;
	}
	public function setPassword($value){
		$this->password = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function setReais($value){
		$this->reais = $value;
	}
	public function setDollar($value){
		$this->dollar = $value;
	}

	public function getEmail(){
		return $this->email;
	}
	public function getUser(){
		return $this->user;
	}
	public function getPassword(){
		return $this->password;
	}
	public function getName(){
		return $this->name;
	}
	public function getReais(){
		return $this->reais;
	}
	public function getDollars(){
		return $this->dollars;
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