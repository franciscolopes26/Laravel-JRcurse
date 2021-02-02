<?php

namespace App\classes;

	class minhaClasse{

		public static function criarCodigo(){
			
			//criar um código aleatório (senha) com 10 caracteres
			$valor = '';
			$caracteres = 'abcdefghijklmnopqrstuvwyxz_ABCDEFGHIJKLMNOPQRSTUVWYXZ1234567890!?#$%';
			for($m=0; $m<10; $m++){
				$index = rand(0, strlen($caracteres));
				$valor .= substr($caracteres, $index, 1);
			}
			return $valor;
		}
	}
?>