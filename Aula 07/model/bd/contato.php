<?php

/**************************************************************************
     * Objetivo: Arquivo responsavel por manipular os dados dentro do BD
     *          (insert, update, select, delete) 
     * Autor: Rodrigo
     * Data: 11/03/2022
     * Versão: 1.0 
     **********************************************************************/

    // função para realizar o insert no BD

    require_once("conexaomysql.php");

    function insertContato($dadosContato)
    {
        // Abre a conexão com BD
        $conexao = conexaoMysql();

        // Monta do script para enviar para o BD
        $sql = "insert into tblcontatos
            (nome, 
            telefone, 
            celular, 
            email, 
            obs)
        values(
        '".$dadosContato["nome"]."', 
        '".$dadosContato["telefone"]."',
        '".$dadosContato["celular"]."',
        '".$dadosContato["email"]."',
        '".$dadosContato["obs"]."');";  

        echo($sql);
        
        //Executa o script no BD
        //Validação para verificar se o script esta certo
        if (mysqli_query($conexao, $sql))
        {
            // Validação para verificar se uma linha foi acrescentada no BD 
            if(mysqli_affected_rows($conexao)){
                return true;
            }else{
                return false;
            }
           
        }else{
            return false;
        }

    }

    // função para realizar o update no BD
    function updateContato()
    {

    }

    // função para listar todos os contatos do BD
    function selectAllContato()
    {
        // Abre a conexao com o banco
        $conexao = conexaoMysql();

        // script para listar todos os dados do BD
        $sql = "select * from dblcontatos";
        // essa linha executa o script no BD e garda o retorno dos dados 
        $result = mysqli_query($conexao, $sql);
        //valida se o BD retornou registros
        if($result)
        {
            //mysqli_fetch_assoc() - permite converter os dados do BD
            //em um array para manipular no PHP
            //Nesta repetição estamos, convertendo os dados do BD em um array ($result), além de
            //o proprio while conseguir gerenciar a qtde de vezes que deverá ser feita a repetição
            $cont =0;
            while($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados[$cont] = array(
                    "nome"      => $rsDados["nome"],
                    "telefone"  => $rsDados["telefone"],
                    "celular"   => $rsDados["celular"],
                    "email"     => $rsDados["email"],
                    "obs"       => $rsDados["obs"],
                );
                $cont++;
            }   
            
            return $arrayDados;
        }

    }

    // função para realizar o delete no BD
    function deleteContato()
    {

    }
?>