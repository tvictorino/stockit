<?php

require_once 'stockExchange.php';

class Stock {

	private $id,$name,$sigla,$current,$open,$high,$low,$percent,$urlNasdaq,$country,$updated,$stockExchangeId, $stockExchangeName, $volume;
	private $stockExchangeObj;

	function __construct($id,$name,$sigla,$stockExchangeId,$stockExchangeName){

		$this->id = $id;
		$this->name = $name;
		$this->sigla = $sigla;
		$this->stockExchangeId = $stockExchangeId;
		$this->stockExchangeName = $stockExchangeName;
		$this->load();
		$this->$stockExchangeObj = new StockExchange($stockExchangeId,$stockExchangeName);
	}

	public function load(){
		//Ira carregar do banco, que seria a ultima atualizacao dessa acao
		$this->setUrlNasdaq('http://www.nasdaq.com/symbol/fb/real-time');
		$this->setCurrent('111,11');
		$this->setOpen('110,00');
		$this->setHigh('115,11');
		$this->setlow('109,00');
		$this->setPercent('0,1%');
		$this->setCountry('us');
		$this->setUpdated('2013-06-11 11:11');
		$this->setVolume('1321213123');
	}

	public function save(){
		//ira salvar os dados no banco
	}

	public function refresh(){
		$this->$stockExchangeObj->getStockInformation($this);
	}


	public function getArrayObject(){
		$json = array(
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
				'country'=>$this->country
			);
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