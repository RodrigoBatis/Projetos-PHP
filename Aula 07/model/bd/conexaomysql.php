<?php

use LDAP\Result;

/**************************************************************************
 * Objetivo: arquivo para criar a conexão com o bd Mysql
 * Autor: Rodrigo
 * Data: 25-02-2022
 * Versão: 1.0
***************************************************************************/

const SERVER = "localhost"; 
const USER = "root";
const PASSWORD = "bcd127";
const DATABASE = "dbcontatos";

 $resultado = conexaoMysql();
 
// Abre a conexão com o BD Mysql
function conexaoMysql()
{   
    $conexao = array();

    // Se a conexão for estabelecida com o BD, iremos ter um array de dados sobre a conexão
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    //Validar para verificar se a conexão foi realizada com sucesso
    if($conexao){
        return $conexao;
    }else{
        return false;
    }
}

/*
    Existem 3 formas de criar conexão com o BD Mysql

     mysql_connect() - Versão mais antigas do PHP de fazer a conexão com BD
                       (Não oferece perfomece e segurança)

    mysqli_connect() -- Versão mais atual ddo PHP de fazer a conexão com BD
                       (Ela permite ser utilizada para programação estruturada e POO)

               pdo() --- Versão mais completa e eficiente para conexão com BD
                       (É indicada pela segurança e POO)
*/
?>