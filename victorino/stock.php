<?php

require_once 'stockExchange.php';
require_once 'mysql.php';

class Stock {

	private $id,$name,$sigla,$current,$open,$high,$low,$percent,$urlNasdaq,$country,$updated,$stockExchangeId, $stockExchangeName, $volume;
	private $stockExchangeObj,$db;

	function __construct($id,$name,$sigla,$stockExchangeId,$stockExchangeName){

		$this->id = $id;
		$this->name = $name;
		$this->sigla = $sigla;
		$this->stockExchangeId = $stockExchangeId;
		$this->stockExchangeName = $stockExchangeName;
		$this->stockExchangeObj = new StockExchange($stockExchangeId,$stockExchangeName);
		$this->db = new Mysql();
		$this->load();
	}

	public function load(){
		//Ira carregar do banco, que seria a ultima atualizacao dessa acao
		//
		$r = $this->db->query('SELECT * FROM stock where id = '.$this->id.';');
		$r = $r[0];
		$this->setUrlNasdaq($r['url_nasdaq']);
		$this->setCurrent($r['current']);
		$this->setOpen($r['current']);
		$this->setHigh($r['high']);
		$this->setlow($r['low']);
		$this->setPercent($r['percent']);
		$this->setCountry($r['country']);
		$this->setUpdated($r['updated']);
		$this->setVolume($r['volume']);
	}

	public function save(){
		$sql = "UPDATE stock SET ('current','high','low','percent','country','updated','volume') VALUES ('".$this->current."','".$this->high."','".$this->low."','".$this->percent."','".$this->country."','".$this->updated."','".$this->volume."') WHERE id = ".$this->id;

		echo $sql;
		//$this->db->query($sql);
	}

	public function refresh(){
		$this->stockExchangeObj->getStockInformation($this);
	}


	public function getArrayObject(){
		$arr = array(
				'id'=>$this->id,
				'name'=>$this->name,
				'sigla'=>$this->sigla,
				'stockExchangeId'=>$this->stockExchangeId,
				'stockExchangeName'=>$this->stockExchangeName,
				'urlNasdaq'=>$this->urlNasdaq,
				'current'=>$this->current,
				'open'=>$this->open,
				'high'=>$this->high,
				'low'=>$this->low,
				'percent'=>$this->percent,
				'volume' => $this->volume,
				'country'=>$this->country,
				'updated'=>$this->updated
			);
		return $arr;
	}

	/**
	 * Sets
	 */
	public function setId($value){
		$this->id = $value;
	}
	public function setName($value){
		$this->name = $value;
	}
	public function setSigla($value){
		$this->sigla = $value;
	}
	public function setCurrent($value){
		$this->current = $value;
	}
	public function setOpen($value){
		$this->open = $value;
	}
	public function setHigh($value){
		$this->high = $value;
	}
	public function setlow($value){
		$this->low = $value;
	}
	public function setPercent($value){
		$this->percent = $value;
	}
	public function setUrlNasdaq($value){
		$this->urlNasdaq = $value;
	}
	public function setCountry($value){
		$this->country = $value;
	}
	public function setUpdated($value){
		$this->updated = $value;
	}
	public function setStockExchangeId($value){
		$this->stockExchangeId = $value;
	}
	public function setStockExchangeName($value){
		$this->stockExchangeName = $value;
	}
	public function setVolume($value){
		$this->volume = $value;
	}


	/**
	 * Gets
	 */

	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getSigla(){
		return $this->sigla;
	}
	public function getCurrent(){
		return $this->current;
	}
	public function getOpen(){
		$this->open = $value;
	}
	public function getHigh(){
		return $this->high;
	}
	public function getlow(){
		return $this->low;
	}
	public function getPercent(){
		return $this->percent;
	}
	public function getUrlNasdaq(){
		return $this->urlNasdaq;
	}
	public function getCountry(){
		return $this->country;
	}
	public function getUpdated(){
		return $this->updated;
	}
	public function getStockExchangeId(){
		return $this->stockExchangeId;
	}
	public function getStockExchangeName(){
		return $this->stockExchangeName;
	}
	public function getVolume(){
		return $this->volume;
	}

}


?>
