<?php
    $valor = (int) 0;
    $contador = (int) 0;
    $resultado = (String) "";

    if(isset($_POST["btnCalc"]))
    {
        $valor = $_POST['txtNumero'];
        //Exemplo ultiizando o while
        // while($contador <= $valor)
        // {
        //     echo($contador. "<br>");
        //     // Maneiras deadicionar mais 1 no na vareavel $contador
        //     //$contador = $contador +1; // Vantagem é que pode acrescentar de 2 em 2, 3 em 3 etc;
        //     //$contador++; // Desvantagem é que só da para acrescenatar de 1 em 1;
        //     $contador +=1; // Vantagem é que pode acrescentar de 2 em 2, 3 em 3 etc;
        // }

        for($contador = 0; $contador<=$valor;$contador++)
        {
            //echo($contador. "<br>");
            $resultado = $resultado . $contador."<br>";
        }
    }

?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            width: 100px;
            height: 500px;
            border: solid 5px;
        }
    </style>
</head>
<body>
    <form name="formRepeticao" method="POST" action="index.php">
        Digite um numero: <input type="text" name="txtNumero">
        <input type="submit" name="btnCalc" value="Calcular">
    </form>
    <div>
        <?php echo($resultado)?>
    </div>
</body>
</html>