<?php

require_once 'mysql.php';

abstract class Bank{


	static function getDb(){
		return new Mysql();
	}


	static function getDollarValueInReal(){
		$sql = "SELECT current FROM stock WHERE stock_exchange_id = 3";
		$db = self::getDb();
		$r = $db->query($sql);
		return $r = $r[0]['current'];
	}
	//1 - para dolar 2 - para real
	static function credit(User $user,$value,$currency){//credita o valor na conta do cara
		$db = self::getDb();
		$r = $db->query($sql);
	}

	//1 - para dolar 2 - para real
	static function debit(User $user,$value,$currency){//debita o valor na conta do cara
		$db = self::getDb();
		$r = $db->query($sql);
	}

	static function dollarToReal(User $user,$dValue,$rValue){

	}

	static function realToDollar(User $user,$rValue,$dValue){

	}
}

?>