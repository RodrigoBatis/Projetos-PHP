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
            obs,
            foto)
        values(
        '".$dadosContato["nome"]."', 
        '".$dadosContato["telefone"]."',
        '".$dadosContato["celular"]."',
        '".$dadosContato["email"]."',
        '".$dadosContato["obs"]."',
        '".$dadosContato["foto"]."');";  
        
        //Executa o script no BD
        //Validação para verificar se o script esta certo
        if (mysqli_query($conexao, $sql))
        {
            // Validação para verificar se uma linha foi acrescentada no BD 
            if(mysqli_affected_rows($conexao)){
                $statusResultado = true;
            }else{
                $statusResultado = false;
            }
           
        }else{
            $statusResultado = false;
        }

        fecharConexaoMysql($conexao);
        return $statusResultado;

    }

    
    // função para listar todos os contatos do BD
    function selectAllContato()
    {
        // Abre a conexao com o banco
        $conexao = conexaoMysql();

        // script para listar todos os dados do BD
        $sql = "select * from tblcontatos order by idcontato desc";
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
                    "id"        => $rsDados["idcontato"],
                    "nome"      => $rsDados["nome"],
                    "telefone"  => $rsDados["telefone"],
                    "celular"   => $rsDados["celular"],
                    "email"     => $rsDados["email"],
                    "obs"       => $rsDados["obs"],
                    "foto"      => $rsDados["foto"]
                );
                $cont++;
            }   
            
            // solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }

    }

    // função para realizar o delete no BD
    function deleteContato($id)
    {
        // abre a conexão como BD
        $conexao = conexaoMysql();

        
        $sql = "delete from tblcontatos where idcontato =".$id;

       if(mysqli_query($conexao, $sql)){
            if(mysqli_affected_rows($conexao)){
                $statusResultado = true;
            }else{
                $statusResultado = false;
            }

        }else{
            $statusResultado = false;
        }

        fecharConexaoMysql($conexao);
        return $statusResultado;
    }


    // função para realizar o update no BD
    function updateContato($dadosContato)
    {
         // Abre a conexão com BD
         $conexao = conexaoMysql();

         // Monta do script para enviar para o BD
         $sql = "update tblcontatos set
             nome            = '".$dadosContato["nome"]     ."', 
             telefone        = '".$dadosContato["telefone"] ."', 
             celular         = '".$dadosContato["celular"]  ."', 
             email           = '".$dadosContato["email"]    ."', 
             obs             = '".$dadosContato["obs"]      ."'
             where idContato =  ".$dadosContato["id"]       .";"
         ;  
         
         //Executa o script no BD
         //Validação para verificar se o script esta certo
         if (mysqli_query($conexao, $sql))
         {
             // Validação para verificar se uma linha foi acrescentada no BD 
             if(mysqli_affected_rows($conexao)){
                 $statusResultado = true;
             }else{
                 $statusResultado = false;
             }
            
         }else{
             $statusResultado = false;
         }
 
         fecharConexaoMysql($conexao);
         return $statusResultado;
    }

    //fução para buscar um contato no BD atravez do id do registro
    function selectByidContato($id)
    {
        // Abre a conexao com o banco
        $conexao = conexaoMysql();

        // script para listar todos os dados do BD
        $sql = "select * from tblcontatos where idcontato = ".$id;

        // essa linha executa o script no BD e garda o retorno dos dados 
        $result = mysqli_query($conexao, $sql);

        //valida se o BD retornou registros
        if($result)
        {
            //mysqli_fetch_assoc() - permite converter os dados do BD
            //em um array para manipular no PHP
            //Nesta repetição estamos, convertendo os dados do BD em um array ($result), além de
            //o proprio while conseguir gerenciar a qtde de vezes que deverá ser feita a repetição
            
            if($rsDados = mysqli_fetch_assoc($result))
            {
                $arrayDados = array(
                    "id"        => $rsDados["idcontato"],
                    "nome"      => $rsDados["nome"],
                    "telefone"  => $rsDados["telefone"],
                    "celular"   => $rsDados["celular"],
                    "email"     => $rsDados["email"],
                    "obs"       => $rsDados["obs"],
                );
            }   
            
            // solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }
    }

?>