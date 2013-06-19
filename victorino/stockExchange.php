<?php

require_once 'stock.php';

class StockExchange{
	private $id,$name;

	function __construct($id,$name){
		$this->id = $id;
		$this->name = $name;
	}

	//Gets

	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}

	public function getStockInformation(Stock $stock){
			switch ($stock->getStockExchangeId()) {
				case 1: //nasdaq
				    $this->getStockInformationFromNasdaq($stock);
					break;
				case 2: //bovespa
				        //Fazer a loginca
					return;
					break;
				default:
					return false;
					break;
			}
	}

	private function getStockInformationFromNasdaq(Stock $stock){
		$page = file_get_contents($stock->getUrlNasdaq());
		//Fazer o tratamento de erro, caso a URL retorne errado
		$doc = new DomDocument;

		// We need to validate our document before refering to the id
		$doc->loadHTML($page);

		$stock->setCurrent($doc->getElementById('quotes_content_left__LastSale')->nodeValue);
		$stock->setOpen($doc->getElementById('quotes_content_left__PreviousClose')->nodeValue);
		$stock->setHigh($doc->getElementById('quotes_content_left__TodaysHigh')->nodeValue);
		$stock->setlow($doc->getElementById('quotes_content_left__TodaysLow')->nodeValue);
		$stock->setPercent($doc->getElementById('quotes_content_left__PctChange')->nodeValue);
		$stock->setUpdated(date('Y-d-m H:i'));
		$stock->setVolume($doc->getElementById('quotes_content_left__Volume')->nodeValue);



	}
}
?>
