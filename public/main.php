<?php


//require_once '../victorino/class/user.php';

error_reporting(E_ALL);
ini_set('display_errors','On');

header('Content-type: text/json');
header('Content-type: application/json');

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
	 * {"id":123,"name":"getTabProfile","param":{}}
	 */

	/**
	 * Validando se o usuario existe
	 */
	//$u = new User($json['id']);

	switch ($json['name']) {
		case 'getTabProfile':
				$dados['user']['photo'] ='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn2/261130_54009252875_340934976_q.jpg';
				$dados['user']['rs'] = '123k';
				$dados['user']['private'] = 'false';
				$dados['user']['us'] = '10k';
				$dados['user']['flwg'] = '8k';
				$dados['user']['flwr'] = '3k';
				$dados['user']['rk'] = '100k';
				$dados['user']['name'] = 'Teste Usuario';
				$dados['user']['bio'] = 'Bla bla bla bla bla bla bl abla bla bla';
				$send = json_encode($dados);
			break;
			case 'getExchanges':
				$dados['exchanges'][0]['name'] = 'Nasdaq';
				$dados['exchanges'][1]['name'] = 'Bovespa';
				$dados['exchanges'][2]['name'] = 'Moeda';
				$send = json_encode($dados);
			break;
			case 'getNasdaqStocks':
				$dados['stocks'][0]['id'] = '1';
				$dados['stocks'][0]['name'] = 'Google Inc';
				$dados['stocks'][0]['current'] = 'GOOG';
				$dados['stocks'][0]['current'] = '12,00';
				$dados['stocks'][0]['open'] = '11,00';
				$dados['stocks'][0]['high'] = '12,50';
				$dados['stocks'][0]['low'] = '10,00';
				$dados['stocks'][0]['percent'] = '1,0';

				$dados['stocks'][1]['id'] = '1';
				$dados['stocks'][1]['name'] = 'Appl Inc';
				$dados['stocks'][1]['current'] = 'APPL';
				$dados['stocks'][1]['current'] = '13,11';
				$dados['stocks'][1]['open'] = '113,11';
				$dados['stocks'][1]['high'] = '123,51';
				$dados['stocks'][1]['low'] = '113,11';
				$dados['stocks'][1]['percent'] = '4,0';

				$dados['stocks'][2]['id'] = '1';
				$dados['stocks'][2]['name'] = 'Amazon Inc';
				$dados['stocks'][2]['current'] = 'AMZN';
				$dados['stocks'][2]['current'] = '14,22';
				$dados['stocks'][2]['open'] = '14,22';
				$dados['stocks'][2]['high'] = '15,52';
				$dados['stocks'][2]['low'] = '15,22';
				$dados['stocks'][2]['percent'] = '3,0';


				$send = json_encode($dados);
			break;

			case 'getBovespaStocks':
				$dados['stocks'][0]['id'] = '1';
				$dados['stocks'][0]['name'] = 'Banco do Brasil';
				$dados['stocks'][0]['current'] = 'BBB';
				$dados['stocks'][0]['current'] = '12,00';
				$dados['stocks'][0]['open'] = '11,00';
				$dados['stocks'][0]['high'] = '12,50';
				$dados['stocks'][0]['low'] = '10,00';
				$dados['stocks'][0]['percent'] = '1,0';

				$dados['stocks'][1]['id'] = '1';
				$dados['stocks'][1]['name'] = 'Petrobras';
				$dados['stocks'][1]['current'] = 'PTR3';
				$dados['stocks'][1]['current'] = '13,11';
				$dados['stocks'][1]['open'] = '113,11';
				$dados['stocks'][1]['high'] = '123,51';
				$dados['stocks'][1]['low'] = '113,11';
				$dados['stocks'][1]['percent'] = '4,0';

				$dados['stocks'][2]['id'] = '1';
				$dados['stocks'][2]['name'] = 'Vale Inc';
				$dados['stocks'][2]['current'] = 'VL03';
				$dados['stocks'][2]['current'] = '14,22';
				$dados['stocks'][2]['open'] = '14,22';
				$dados['stocks'][2]['high'] = '15,52';
				$dados['stocks'][2]['low'] = '15,22';
				$dados['stocks'][2]['percent'] = '3,0';

				$send = json_encode($dados);
			break;

			case 'getCurrencyStocks':
				$dados['stocks'][0]['id'] = '1';
				$dados['stocks'][0]['name'] = 'Dolar';
				$dados['stocks'][0]['current'] = 'U$';
				$dados['stocks'][0]['current'] = '2,20';
				$dados['stocks'][0]['open'] = '2,30';
				$dados['stocks'][0]['high'] = '2,350';
				$dados['stocks'][0]['low'] = '2,18';
				$dados['stocks'][0]['percent'] = '5,0';

				$dados['stocks'][1]['id'] = '1';
				$dados['stocks'][1]['name'] = 'Real';
				$dados['stocks'][1]['current'] = 'R$';
				$dados['stocks'][1]['current'] = '1';
				$dados['stocks'][1]['open'] = '1';
				$dados['stocks'][1]['high'] = '1';
				$dados['stocks'][1]['low'] = '1';
				$dados['stocks'][1]['percent'] = '0,0';

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