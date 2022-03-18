<?php

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
		echo('<script> alert("Favor preencher todas as caixas"); </script>');
	else
	{
		//
		if(!isset($_POST['rdocalc']))
	    echo('<script> alert("Favor escolher uma operação válida"); </script>');
		else {

			//validação de tratamento para a entrada de string ao invés de números
			if(!is_numeric($valor1) || !is_numeric($valor2))
			echo('<script> alert ("Não é possível realizar cálculos com dados não numéricos!") </script>');

			else 
			{
		//apenas podemos receber o valor do rdo quando ele existir 		
		$value =  $_POST['rdocalc'];

	//processamento 

	switch ($value)
	{
		case("somar"):
			$resultado = $valor1 + $valor2;
			break;
		case("subtrair"):
			$resultado = $valor1 - $valor2;
			break;
		case("multiplicar"):
			$resultado = $valor1 * $valor2;
			break;
		case("dividir"):
			if($valor2 == 0)
				echo('<script> alert ("Não é possível realizar uma divisão na qual o valor 2 seja igual a 0!");</script>');
			else
				$resultado = $valor1 / $valor2;
			break;
				
	}

	// if($value == 'somar')
	// 	$resultado = $valor1 + $valor2;
	// elseif ($value == 'subtrair')
	// 	$resultado = $valor1 - $valor2;
	// elseif ($value == 'multiplicar')
	// 	$resultado = $valor1 * $valor2;
	// elseif ($value == 'dividir')
	// {
	// 	if($valor2 == 0)
	// 		echo('<script> alert ("Não é possível realizar uma divisão na qual o valor 2 seja igual a 0!");</script>');
	// 	else
	// 	$resultado = $valor1 / $valor2;
	// }	
		//permite ajustar a quantidade de casas decimais realizando o arredondamento
		$resultado = round($resultado, 2);
		
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

