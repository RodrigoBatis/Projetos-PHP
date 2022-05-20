<?php

  //import do arquivo autoload, que fará as instancias do slim
  require_once('vendor/autoload.php'); 
  //Criando um objeto do slim chamado app, para coonfigurar os endpoints(rotas)
  $app = new \Slim\App();
  //Endpoint Requisição para listar todos os contatos
  $app->get('/contatos', function($request, $response, $args){
    require_once('../modulo/config.php');

    require_once('../Controller/controllerContatos.php');

    if($dados = listarContato())
    {
      if($dadosJSON = createJSON($dados))
      {
        $response->write($dadosJSON);
      }  
    }

  });
  //Endpoint Requisição para listar contatos pelo id
  $app->get('/contatos/{id}', function($request, $response, $args){

  });
  //Endpoint Requisição para inserir um novo contato
  $app->post('/contatos', function($request, $response, $args){

  });
  
  $app->run();

?>