<?php
    /**************************************************************************
     * Objetivo: Arquivo responsavel pelas manipulações de dados de estados
     *      OBS(Este fará a ponte entre a View e é Model) 
     * Autor: Rodrigo
     * Data: 10/05/2022
     * Versão: 1.0 
     **************************************************************************/

    //Import do arquivo deconfiguração do projeto
    require_once("modulo/config.php");

    // função para rsolicitar os dados da model e encaminhar a lista
    // de estados para View 
      function listarEstado()
      {
        require_once("model/bd/estado.php");

        // chama a função que vai buscar os dados no BD
        $dados = selectAllEstados();

        if(!empty($dados))
        {
            return $dados;
        }else
        {
            return false;
        }

      }    



?>