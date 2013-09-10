<?php

error_reporting(E_ALL);
ini_set('display_errors','On');

$cmd = @$_GET['cmd'];
$send = null;

if(!isset($cmd)){
	echo '{
		"suc":"false",
		"r":"No command find",
	}';
	die();
}
try{
	$json = json_decode($cmd,true);
	if($json === null){
		echo '{
			"suc":"false",
			"r":"Invalid requisition",
		}';
		die();
	}

	/*
	 * {"id":123,"name":"getProfile","param":{}}
	 */

	switch ($json['name']) {
		case 'getProfile':
				$dados['user']['tab'] = 'profile';
				$dados['user']['photo'] ='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn2/261130_54009252875_340934976_q.jpg';
				$dados['user']['rs'] = '123k';
				$dados['user']['us'] = '10k';
				$dados['user']['flwg'] = '8k';
				$dados['user']['flwr'] = '3k';
				$dados['user']['rk'] = '100k';
				$dados['user']['name'] = 'Teste Usuario';
				$dados['user']['bio'] = 'Bla bla bla bla bla bla bl abla bla bla';
				$send = json_encode($dados);
			break;
		
		default:
			echo '{
				"suc":"false",
				"r":"Invalid cmd name",
			}';
			die();
			break;
	}

	echo $send;
	
	

}catch(Exeption $e){
	echo '{
		"suc":"false",
		"r":"Invalid requisition",
	}';
	die();
}

?>