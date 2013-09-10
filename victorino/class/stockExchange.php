<?php

require_once 'stock.php';
require_once 'bank.php';

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
				        $this->getStockInformationFromBovespa($stock);
					break;
				case 3:
						$this->getStockInformationFromDolar($stock);
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
		@$doc->loadHTML($page);

		$current = $doc->getElementById('quotes_content_left__LastSale')->nodeValue;
		$current = Bank::moneyFormat($current);

		$open = $doc->getElementById('quotes_content_left__PreviousClose')->nodeValue;
		$open = Bank::moneyFormat($open);

		$high = $doc->getElementById('quotes_content_left__TodaysHigh')->nodeValue;
		$high = Bank::moneyFormat($high);

		$low = $doc->getElementById('quotes_content_left__TodaysLow')->nodeValue;
		$low = Bank::moneyFormat($low);

		$percent = $doc->getElementById('quotes_content_left__PctChange')->nodeValue;
		$percent = str_replace('%','',$percent);
		$percent = Bank::moneyFormat($percent);
		$signal  = '';
		if($current < $open){
			$signal = '-';
		}
		$percent = $signal.$percent;

		$volume = $doc->getElementById('quotes_content_left__Volume')->nodeValue;
		$volume = str_replace(',','.',$volume);

		$stock->setCurrent($current);
		$stock->setOpen($open);
		$stock->setHigh($high);
		$stock->setlow($low);
		$stock->setPercent($percent);
		$stock->setVolume($volume);



	}

	private function getStockInformationFromBovespa(Stock $stock){

	    $xml = simplexml_load_file($stock->getUrlNasdaq());
	    $attrs = $xml->Papel->attributes();

		$stock->setCurrent($attrs->Ultimo);
		$stock->setOpen($attrs->Abertura);
		$stock->setHigh($attrs->Maximo);
		$stock->setlow($attrs->Minimo);
		$stock->setPercent($attrs->Oscilacao);
		//$stock->setUpdated(date('Y-d-m H:i'));
		$stock->setVolume(0);
	}

		private function getStockInformationFromDolar(Stock $stock){
		$page = file_get_contents($stock->getUrlNasdaq());
		//Fazer o tratamento de erro, caso a URL retorne errado
		$doc = new DomDocument;

		// We need to validate our document before refering to the id
		$doc->loadHTML($page);

		$span = $doc->getElementById('currency_converter_result')->getElementsByTagName('span')->item(0);
		$valor = explode(' ',$span->nodeValue);
		$valor = Bank::moneyFormat($valor[0]);
		$stock->setCurrent($valor);
	}

}
?>
