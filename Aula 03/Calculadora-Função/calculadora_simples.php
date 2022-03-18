<?php
	//include ou require - permitem a importação de arquivos no php
	//Utilizando a opção _once, o servidor realiza uma restrição o=para
		// importar somente uma vez o arquivo (melhor opção)

		
	//include()
	//include_once()
	//require()
	//require_once()

	//import do arquivo de configurações de variáveis e constantes
	require_once('modulo/config.php');

	//import do arquivo de funções para cálculos matemáticos
	require_once('modulo/calculos.php');

	


// declaração de variáveis 
$valor1 =(double) 0;
$valor2 = (double) 0;
$value = (String) null; // soma, subtração, multiplicação, divisão
$resultado = (double) 0;



if(isset($_POST['btncalc']))
{
	//recebe os dados do formulário
	$valor1 = $_POST['txtn1'];
	$valor2 = $_POST['txtn2'];
	

	if($_POST['txtn1'] == "" || $_POST['txtn2'] == "")
		echo(ERRO_MSG_CAIXA_VAZIA);
	else
	{
		//
		if(!isset($_POST['rdocalc']))
	    echo(ERRO_MSG_OPERACAO_INVALIDA);
		else {

			//validação de tratamento para a entrada de string ao invés de números
			if(!is_numeric($valor1) || !is_numeric($valor2))
			echo(ERRO_MSG_CARACTER_INVALIDO_TEXTO);

			else 
			{
		//apenas podemos receber o valor do rdo quando ele existir 		
		$value =  $_POST['rdocalc'];

		//chamada da função de cáculos matemáticos, passamos os valores e o tipo
		// da operação recebemos o valor de resultado
	    $resultado = operacaoMatematica($valor1 , $valor2 , $value);
	
		
		    }
		}
    }
}

?>
<html>
    <head>
        <title>Calculadora - Simples</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"> 
    </head>
	<body>
        
        <div id="conteudo">
            <div id="titulo">
                Calculadora Simples
            </div>

            <div id="form">
                <form name="frmcalculadora" method="post" action="calculadora_simples.php">
						Valor 1:<input type="text" name="txtn1" value="<?=$valor1;?>" > <br>
						Valor 2:<input type="text" name="txtn2" value="<?=$valor2;?>" > <br>
						<div id="container_opcoes">
							<input type="radio" name="rdocalc" value="somar"<?=$value =='somar'? 'checked' : null;?> >Somar <br>
							<input type="radio" name="rdocalc" value="subtrair"<?=$value =='subtrair'? 'checked' : null;?> >Subtrair <br>
							<input type="radio" name="rdocalc" value="multiplicar"<?=$value =='multiplicar'? 'checked' : null;?> >Multiplicar <br>
							<input type="radio" name="rdocalc" value="dividir" <?=$value =='dividir'? 'checked' : null;?>>Dividir <br>
							
							<input type="submit" name="btncalc" value ="Calcular" >
							
						</div>	
						<div id="resultado">
						O resultado é: <?php echo($resultado)?>
						</div>
						
					</form>
            </div>
           
        </div>
        
		
	</body>

</html>

