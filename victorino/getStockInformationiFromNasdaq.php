<?php
error_reporting(4);
//$page = file_get_contents('http://www.nasdaq.com/symbol/aapl/real-time');
//
require_once 'stock.php';

$s = new Stock($id,$name,$sigla,$stockExchangeId,$stockExchangeName);

print_r($s->getArrayObject());

$s->refresh();

print_r($s->getArrayObject());


?>
