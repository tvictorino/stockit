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
				    //$this->getStockInformationFromNasdaq($stock);
					break;
				case 2: //bovespa
				        $this->getStockInformationFromBovespa($stock);
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
		//$stock->setUpdated(date('Y-d-m H:i'));
		$stock->setVolume($doc->getElementById('quotes_content_left__Volume')->nodeValue);



	}

	private function getStockInformationFromBovespa(Stock $stock){
		//$page = file_get_contents($stock->getUrlNasdaq());
		//Fazer o tratamento de erro, caso a URL retorne errado
	    $xml = simplexml_load_file($stock->getUrlNasdaq());
	    $attrs = $xml->Papel->attributes();
	    print_r($attrs);
	    echo $attrs->Abertura;
	// 	$doc = new DomDocument;

	// 	// We need to validate our document before refering to the id
	// 	echo $stock->getUrlNasdaq();
	// 	$doc->loadHTML($stock->getUrlNasdaq());
	// 	$comportamento = $doc->getElementsByTagName('ComportamentoPapeis');
	// echo "\n\n Quantidade: ".$comportamento->length;
	// 	echo "\n\n".$comportamento->item(0)->nodeName."\n\n";
		//$papel = $comportamento->item(0)->getElementsByTagName('Papel');

		//echo "\n\n\nValor: ".$papel->item(0)->nodeValue."\n\n\n";//getAttribute('Codigo');
		$stock->setCurrent($attrs->Ultimo);
		$stock->setOpen($attrs->Abertura);
		$stock->setHigh($attrs->Maximo);
		$stock->setlow($attrs->Minimo);
		$stock->setPercent($attrs->Oscilacao);
		//$stock->setUpdated(date('Y-d-m H:i'));
		$stock->setVolume(0);
	}

}
?>
