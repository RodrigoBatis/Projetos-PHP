<?php
    // echo("testando PHP"); escreve conteudo na tela
    // print_r("testando outro modo PHP"); msm coisa que o echo

    // toda variavel tem que ser escrita com $ no inicio

    // isset() permite verificar a existencia de uma variavel ou um objeto
    
    //validação para verificar se o botão foi clicado e disponibilizado na ação do get
    
    if(isset($_GET["btnSalvar"])){

    //Recuperando dados com o metodo GET do HTML
    $nome = $_GET["txtNome"];
    $cidade = $_GET["sltCidade"];
    $sexo = $_GET["rdoSexo"];
    $obs = $_GET["txtObs"];

    // TRATAMENTO PARA RECUPERAR AS INFORMAÇÕES DOS  CHECK BOX

    if(isset($_GET["chkPortugues"])){
        $idiomaPortugues =$_GET["chkPortugues"];
    }else{
        $idiomaPortugues = null;
    }
    if(isset($_GET["chkIngles"])){
        $idiomaIngles =$_GET["chkIngles"];
    }else{
        $idiomaIngles = null;
    }
    if(isset($_GET["chkEspanhol"])){
        $idiomaEspanhol =$_GET["chkEspanhol"];
    }else{
        $idiomaEspanhol = null;
    }

    // escrevendo o conteudo das vareaveis no navegador
    echo("<b>RESULTADOS:</b> <br>");
    echo("<b>Nome: </b> " .$nome . "<br>");
    echo("<b>Cidade: </b> " .$cidade . "<br>");
    echo("<b>Sexo: </b> " .$sexo . "<br>");
    echo("<b>Idiomas: </b>" .$idiomaPortugues. "\n" .$idiomaIngles. "\n" .$idiomaEspanhol. "<br>");
    echo("<b>Observacao: </b> " .$obs . "<br>");
    echo("<br>");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        textarea{
            resize: none;
        }
        /*
        Codigo para desativar o redirecionamento da textarea 
         */
    </style>
</head>
<body>
    <!-- 
        GET -> PERMITE PEGAR OS DADOS DO FORMULARIO E DISPONIBILIZAR NA URL DA PAGINA ATUAL.
        
        POST -> PERMITE RETIRAR OS DADOS DO FORMULARIO E DISPONIBILIZAR EM VARIAVEIS LOCAIS. (INVISIVEIS) 
        
        ACTION -> E PARA ESPECFICAR EM QUAL ARQUIVO OU PAGINA SERA DISPONIBILIZADO OS DADOS DO HTML. 
        
        SELECT -> PERMITE CRIAR UMA LISTA. 
        
        OPTION -> E ATRAVEZ DELA QUE PODEMOS CRIAR ITENS DENTRO DA LISTA (OPTION E VALUE).
       
        VALUE -> A PROPRIEDADE VALUE E OBRIGATORA PARA QUE O FORMULARIO CONSIGA RESGATAR O VALOR DO ITEM SELECIONADO PELO USUARIOE DISPONIBILIZAR PARA O BACK-END. 
        
        A INPUT DO TIPO RADIO PERMITE CRIAR OPCOES DE ESCOLHA (PARA CONFIGURAR O RADIO FAZENDO COM QUE PERMITA APENAS 1 OPCAO DE ESCOLHA e 
        OBRIGATORIO TODAS AS INPUTS TEREM O MSM NOME).


     -->
    
    <form name="frmCadastro" method="get" action="formulario.php">
        Nome : <input type="text" name="txtNome" size="50" maxlength="30"><br><br>
        Cidade : 
        <select name="sltCidade" >
            <option value="" selected>Selecione uma cidade</option>
            <option value="jandira">Jandira</option>
            <option value="osasco">Osasco</option>
            <option value="barueri">Barueri</option>
            <option value="carapicuiba">Carapicuiba</option>
            <option value="itapevi">Itapevi</option>
        </select>
        <br><br>
        Sexo:
        <input type="radio" name="rdoSexo" value="F"> Feminino
        <input type="radio" name="rdoSexo" value="M"> Masculino
        <input type="radio" name="rdoSexo" value="O"> Outros
        <br><br>
        Idiomas:
        <input type="checkbox" name="chkPortugues" value="PT" checked> Português
        <input type="checkbox" name="chkIngles" value="EN"> inglês
        <input type="checkbox" name="chkEspanhol" value="ES"> Espanhol
        <br><br>
        Observações:
        <br>
        <textarea name="txtObs" cols="30" rows="15"></textarea>
        <br>
        <!-- 
            INPUT DO TIPO SUBMIT PERMITE RETIRAR OS DADOS DO FORMULARIO ATRAVEZ DO PROPRIO HTML, FAZENDO UM SUBMIT NOS DADOS.
            
            SE USAR A INPUT COM BUTTON SOMENTE SERA POSSIVEL TIRAR OS DADOS DO FORMULARIO ATRAVEZ DO JAVASCRIPT.

            INPUT COM RESET PERMITE LIMPARTODOS OS ELEMENTOS DO FORMULARIO.
         -->
        <input type="submit" name="btnSalvar" value="Salvar">
        <input type="reset" name="btnReset" value="Reset">
        <br><br>
        
    </form>
</body>
</html>