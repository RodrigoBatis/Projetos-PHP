<?php
    /***************************************************************************
     * Objetivo: arquivo responsável pela criação de váriáveis e constantes do projeto
     * Autor: Rodrigo
     * Data: 25/04/2022
     * Versão: 1.0 
     * 
     **************************************************************************/

  /***********************Variaveis e constantes globais do projeto********************************************/

  //limitado a 5mb para upload de imagens
  const MAX_FILE_UPLOAD = 5120;
  //tipos de arquivos que serão aceitos
  const EXT_FILE_UPLOAD = ["image/jpg", "image/jpeg", "image/png", "image/svg", "image/gif"];
  
  const DIRETORIO_FILE_UPLOAD = "arquivos/";

  define('SRC', $_SERVER['DOCUMENT_ROOT'].'/Rodrigo/Aulas-PHP/Aula07/');

  /***********************Funtions globais para o projeto********************************************/

  //funtion para converter um array para JSON
  function createJSON($arrayDados)
  {
    //Validação para tratar Array sem conteúdo
    if(!empty($arrayDados))
    {
      //Configura o padrão da conversão para o formato Json
      header('Content-Type: application/json');   
      $dadosJSON = json_encode($arrayDados);
      
      // json_encode(); -- Converte um Array para JSON
      // json_decode(); -- Coverte um JSON para Array

      return $dadosJSON;
    }else
    {
      return false;
    }
  }

?>