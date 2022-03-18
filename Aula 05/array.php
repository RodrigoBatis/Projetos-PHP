<?php

    // Criando um array e atribuindo valares 
    $nomes = array("José da Silva", "Maria da Silva", "André Souza");

    //  Exibe um texto um conteudo de uma vareavel (que não seja um array)
    // echo($nomes);

    // Exibe um texto ou um conteudo de uma vareavel msm sendo um array (sem detalhes tecnicos)
    // print_r($nomes);

    // Exibe um texto ou um conteudo de uma vareavel msm sendo um array (trazendo detalhes tecnicos)
    // var_dump($nomes);

    // Utilizando o echo para escrever o valor de um indice do array
    // echo($nomes[0]);

    $dados = array("José da Silva", 20, 1850.56, );
    var_dump($dados);

    // Declarando um array sem coloca os valores 
    $nomeFuncionarios = array();

   
    // Atribuindo valores nos indices do array
    $nomeFuncionarios[0] = "Luiz Silva";
    $nomeFuncionarios[3] = "Antonio Fonseca";
    

    echo("<br />");
    echo("<br />");
     // Só será criado os indices que vc solicitou msm pulando indices
    var_dump($nomeFuncionarios);

    $nomeClientes = array("Jurema" , "Claudete" , "Jucelino" , "Cleyson" , "Claudemir" , "Antonietta", "Josevaldo", "Osvaldo");

    // Forma 1 - De extrair dados com repetição
    // While:
    $cont = 0;
    // Permite retornar a quantidade de elementos de um array
    $conteudoArray = count($nomeClientes);
    echo("<br />");
    echo("<br />");
    echo("*****  Lupin Whhile  *****");
    while($cont < $conteudoArray){
        echo("<br />");
        echo($nomeClientes[$cont]);
        $cont ++;
    }

    echo("<br />");
    echo("<br />");
    echo("*****  Lupin For  *****");

    for($cont = 0; $cont < $conteudoArray; $cont++){
        echo("<br />");
        echo($nomeClientes[$cont]);
    }

    echo("<br />");
    echo("<br />");
    echo("*****  Lupin Foreach  *****");
    echo("<br />");
    
    // foreach  - permite criar uma do array fazendo já a contagem
    //de quantos elementos existem no array, e permitindo que 
    //na exibição dos valores não seja necessário especificar o 
    //indice do array

    foreach ($nomeClientes as $cliente){
        echo($cliente."<br />");
    }

    // Trabalhando com array (Chave-Valor)
    $produtos = array(

        "nome"          => "Teclado",
        "descricao"     => "Teclado da cor preto e vermelho",
        "qtde"          => 50,
        "valor"         => 80.45,
        "cor"           => "Preto",
        "mecanico"      => "Não",
    );

    
    //  executando o array chave completo 
    echo("<br />");
    echo("*****  Array Chave  *****");
    echo("<pre>");
    var_dump($produtos);
    echo("</pre>");


    // Chamando pelas Chaves
    echo("<br />");
    echo("*****  Chamando pelas chaves  *****");
    echo("<br />");
    echo("<br />");
    echo("Produto: ").($produtos["nome"]);
    echo("<br />");
    echo("Descrição: ").($produtos["descricao"]);
    echo("<br />");
    echo("Quantidade: ").($produtos["qtde"]);
    echo("<br />");
    echo("Valor: ").($produtos["valor"]);
    echo("<br />");
    echo("Cor predominante: ").($produtos["cor"]);
    echo("<br />");
    echo("Mecanico: ").($produtos["mecanico"]);

    echo("<br />");
    echo("<br />");

    //Trabalhando com array de indice, chave e valor 

    $produtosInformatica = array(

        array(
            "nome"          => "Teclado",
            "descricao"     => "Teclado RGB",
            "qtde"          => 20,
            "valor"         => 100.50,
            "cor"           => "Preto",
            "mecanico"      => "Sim",
        ),
        array(
            "nome"          => "Mouse",
            "descricao"     => "Mouse RGB com 5 botões",
            "qtde"          => 5,
            "valor"         => 250.70,
            "cor"           => "Preto e Vermelho",
            "mecanico"      => "Sim",
        )
    );

    echo("***** Array Indice Chave Valor *****");
    echo("<pre>");
    var_dump($produtosInformatica[0]);
    echo("</pre>");
    echo("<br />");
    echo("<pre>");
    var_dump($produtosInformatica[1]);
    echo("</pre>");

    echo("<br />");
    echo("***** Chamando Pela Chave + o Indice *****");
    echo("<br />");
    var_dump($produtosInformatica[0]["nome"]);
    echo("<br />");
    var_dump($produtosInformatica[1]["nome"]);

    echo("<br />");
    echo("<br />");

    
?>
