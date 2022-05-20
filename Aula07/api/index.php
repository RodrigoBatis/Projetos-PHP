<?php
   /********************************************************************************************************
    * Objetivo: Arquivo principal da API que irá receber a URL requisitada e redirecionar para as APIS(router)
    * Data: 19/05/2022
    * Autor: Rodrigo
    * Versão: 1.0
   ********************************************************************************************************/

   //Permite ativar quais endereços de sites que poderão fazer requisições na API(* Libera para todos os sites) 
   header('Access-Control-Allow-Origin: *');
   //Permite ativar os metados do protocolo do protocolo HTTP que irão requisitar a API
   header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
   //Permite ativar o content-type das requisições (formato de dados que será utilizado (JSON, XML, FORM/DATA e etc))
   header('Access-Control-Allow-Header: Content-Type');
   //Permite liberar quais type serão uilizados na API
   header('Content-Type: application/json');


   //Recebe a URL digitada na requisição 
   $urlHTTP = (String) $_GET["url"];

   //Converte a url requisitada em um array para dividir as optios de busca que é separada pela "/" 
   $url = explode('/', $urlHTTP);

   //Verifica qual a API será encaminhada a requisição (contatos, estados e etc)
   switch(strtoupper($url[0])){
      case 'CONTATOS':
         require_once('contatosAPI/index.php');
         break;
      case 'ESTADOS':
         require_once('estadosAPI/index.php');
         break;
   }

?>