<?php

    /***************************************************************************
     * Objetivo: arquivo responsável em realizar uploaads de arquivos 
     * Autor: Rodrigo
     * Data: 25/04/2022
     * Versão: 1.0 
     * 
     **************************************************************************/

  /* Fuçõa para relizar uploads de imagens */
  function uploadFile($arrayFile){

    //import de configurações do projeto
    require_once("modulo/config.php");

    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (string) null;
    $nameFile = (string) null;

    /*validação para identificar se existe um arquivo válido maior que 
    zero e tenha um extensão*/
    if($arquivo['size'] > 0 && $arquivo['type'] != ""){
      /*pega o tamanho do arquivo que é em bytes e converte para k bytes*/
      $sizeFile = $arquivo['size']/1024;

      /*pega o tipo do arquivo*/
      $typeFile = $arquivo['type'];

      /*pega o nome do arquivo*/
      $nameFile = $arquivo['name'];

      /* caminho do diretório temporário onde está o arquivo */
      $tempFile = $arquivo['tmp_name'];

      //validação para permitir apenas arquivos de no máximo 5mb 
      if($sizeFile <= MAX_FILE_UPLOAD){

        //validação para permitir somente as extensões válidas 
        if(in_array($typeFile, EXT_FILE_UPLOAD)){
          //SEPARA O NOME DO ARQUIVO SEM A EXTENSÃO
          $nome = pathinfo($nameFile, PATHINFO_FILENAME);
          //SEPARA SOMENTE A EXTENSÃO DO ARQUIVO SEM O NOME
          $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

          /*existem diversos algoritmos para criptografia de dados
          o php tem os:
            md5()
            sha1()
            hash()
          */

          /* 
            md5 gerando uma criptografia de dados

            uniqId gerando uma sequência numérica 
            diferente, tendo como base a máquina
            e dentro passando o time

            pega a hora minuto e segundo que está sendo
            feito o upload da foto
          */
          $nomeCripty = md5($nome.uniqid(time()));
          
          /* 
            formando o nome do arquivo novamente, só que agora
            encriptografado e com a extensão
          */
          $foto = $nomeCripty . '.' . $extensao;

          /* 
            este comando move um arquivo de lugar da pasta temporária
            para a pasta criada no projeto
            
            move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto);
          */

          if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto)){
            return $foto;
          }else{
            return array(
              "idErro" => 13,
              "message" => "Não foi possível mover o arquivo para o servidor"
            );
          }

        }else{
          return array(
            "idErro" => 12,
            "mesage" => "A extensão do arquivo selecionado não é permitida"
          );
        }
      }else{
        return array(
          "idErro" => 10,
          "message" => "tamanho de arquivo inválido no upload"
        );
      }
    }else{
      return array(
        "idErro" => 11,
        "message" => "Não é possível realizar um upload sem um arquivo selecionado"
      );
    }

  }
?>