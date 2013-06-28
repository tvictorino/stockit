<?php

require_once 'operation.php';


abstract class Dealer {

	//vai analisar a operacao e retornar verdadeiro o falso para realizar a operacao.
	static function isAcceptable(Operation $operation){
		//se o valor for null, assume o valor de mercado
		if($operation->getValue() == null){
			$operation->setValue($operation->getStock()->getCurrent());
		}

		if($operation->getBuy()){//se for para comprar
			if($operation->getValue() >= $operation->getStock()->getCurrent()){
				return true;
			}
		}else{//se for venda
			if($operation->getValue() <= $operation->getStock()->getCurrent()){
				return true;
			}
		}

		return false;
	}

	static function deal(Operation $operation){
		if(self::isAcceptable($operation)){
			if($operation->getBuy){//se for comprar
				$value = $operation->getValue()*$operation->getQtd();
				/*
				 * @TODO Selecionar para ver que o usuario tem acoes dessa empresa, se tiver, soma a quantidade, senao, adicionar um registro novo.
				 */
				if($operation->getStock()->getStockExchangeId() == 1 ){//se for em dolar
					Bank::debit($operation->getUser(),$value,1);
				}else{
					Bank::debit($operation->getUser(),$value,2);
				}

			}else{//Se for vender
				$value = $operation->getValue()*$operation->getQtd();
				if($operation->getStock()->getStockExchangeId() == 1 ){//se for em dolar
				    /*
				 	* @TODO Ver a quantidade de acoes vendidas e diminuir da tabela, ou , se for, 0, excluir a linha
				 	*/
					Bank::credit($operation->getUser(),$value,1);
				}else{
					Bank::credit($operation->getUser(),$value,2);
				}

			}

		}else{
			throw new DealerException("This operation is not good for us, sorry!");

		}
	}

}

/**
*
*/
class DealerException extends Exception
{

	// Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}



?>