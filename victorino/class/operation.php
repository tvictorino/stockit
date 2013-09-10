<?php

require_once 'mysql.php';
require_once 'stock.php';
require_once 'user.php';

class Operation {

	private $id, $qtd, $user, $stock, $buy, $value;
	private $bd;


	//Se o valor for null, vender ou comprar pelo valor de mercado
	function __construct($id, $qtd, $user, $stock, $buy, $value = 0){
		$this->id = $id;
		$this->qtd = $qtd;
		$this->user = $user;
		$this->stock = $stock;
		$this->buy = $buy;
		$this->value = $value;
		$this->getMarketStockInformation();
		$this->getObjectUser();
	}

	private function getMarketStockInformation(){
		$stock = new Stock($this->id);
		$this->stock = $stock;
	}

	private function getObjectUser(){
		$user = new User($this->user);
		$this->user = $user;
	}

	public function getId(){
		return $this->id;
	}
	public function getQtd(){
		return $this->qtd;
	}
	public function getUser(){
		return $this->user;
	}
	public function getStock(){
		return $this->stock;
	}
	public function getBuy(){
		return $this->buy;
	}
	public function getValue(){
		return $this->value;
	}

	public function setValue($value){
		$this->value = $value;
	}

}

?>