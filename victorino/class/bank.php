<?php

require_once 'mysql.php';

class Bank{


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
		echo "\n\nCreditando $value no usuario".$user->getName()."\n\n";
		//$db = self::getDb();
		//$r = $db->query($sql);
	}

	// 1 - American, 2 - European
	static function moneyFormat($value, $type = 2){
		if($type == 1){
			setlocale(LC_MONETARY, 'en_US');
			return money_format('%.2n', $value);
		}else if ($type == 2) {
			setlocale(LC_MONETARY, 'it_IT');
			$converted = money_format('%.2n', $value);
			$converted = explode(' ',$converted);
			return $converted[1];
		}else{
			return false;
		}

	}

	//1 - para dolar 2 - para real
	static function debit(User $user,$value,$currency){//debita o valor na conta do cara
	    if($currency == 1){//dolar
	    	echo "\n\nO usuario tem U$".$user->getDollars();
	    }else{
	    	echo "\n\nO usuario tem R$".$user->getReais();

	    }
		echo "\n\nDebitando $value no usuario". $user->getName()."\n\n";
	}

	static function dollarToReal(User $user,$dValue,$rValue){

	}

	static function realToDollar(User $user,$rValue,$dValue){

	}
}

?>