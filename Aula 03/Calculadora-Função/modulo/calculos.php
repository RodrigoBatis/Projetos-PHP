<?php

/**************************************************************************************
 * Objetivo: Arquivo de funções matemáticas que poderá ser utilizado dentro do projeto
 * Autor: Samea Alencar
 * Data: 04/02/2022
 * Versão: 1.0
 *************************************************************************************/

//Criando uma função para calcular as operações matemáticas
function operacaoMatematica($numero1, $numero2, $operacao)
{
	// Declaração de variaveis locais da função 
	//(todas as variaveis recebem os dadis di parametro da function)

	$num1 = (double) $numero1;
	$num2 = (double) $numero2;
	$tipoCalculo = (string) $operacao;
	$result = (double) 0;

	//processamento 

	switch ($tipoCalculo)
	{
		case("somar"):
			$result= $num1 + $num2;
			break;
		case("subtrair"):
			$result =  $num1 - $num2;
			break;
		case("multiplicar"):
			$result= $num1 * $num2;
			break;
		case("dividir"):
			if($num2== 0)
				echo(ERRO_MSG_DIVISAO_ZERO);
			else
				$result = $num1/ $num2;
			break;
				
	}
	    $result = round($result, 2);

	return $result;

}



?>