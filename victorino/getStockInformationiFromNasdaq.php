<?php
error_reporting(4);
//$page = file_get_contents('http://www.nasdaq.com/symbol/aapl/real-time');
//
require_once 'stock.php';
require_once 'mysql.php';

$b = new Mysql();

$r = $b->query("SELECT * FROM stock");
$cr = count($r);

for($i=0;$i<$cr;$i++){
   $s = new Stock($r[$i]['id'],$r[$i]['name'],$r[$i]['sigla'],$r[$i]['stock_exchange_id'],'Nasdaq');
   $s->refresh();
   print_r($s->getArrayObject());
}
//$s = new Stock(0,'Facebook','FB','1','Nasdaq');

//print_r($s->getArrayObject());

//$s->refresh();

//print_r($s->getArrayObject());


?>
