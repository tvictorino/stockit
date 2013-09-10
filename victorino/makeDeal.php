<?php

require_once 'class/dealer.php';
require_once 'class/mysql.php';
require_once 'class/operation.php';


$b = new Mysql();

$r = $b->query("SELECT * FROM operations");

print_r($r);

$cr = count($r);

for($i=0;$i<$cr;$i++){
   $s = new Operation($r[$i]['id'],$r[$i]['qtd'],$r[$i]['user'],$r[$i]['stock'],$r[$i]['buy'],$r[$i]['value']);
   Dealer::deal($s);
}

?>