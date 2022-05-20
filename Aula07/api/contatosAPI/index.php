<?php

  /********************************************************************************************
   * $resquest -> recebe dados do corpo da requisição (JSON, FORM/DATA, XML e etc).
   * $response -> envia dados de retorno da API.
   * $args     -> permite receber dados de atributos na API.
   * *****************************************************************************************/

  //import do arquivo autoload, que fará as instancias do slim
  require_once('vendor/autoload.php'); 

  //Criando um objeto do slim chamado app, para coonfigurar os endpoints(rotas)
  $app = new \Slim\App();

  //Endpoint Requisição para listar todos os contatos
  $app->get('/contatos', function($request, $response, $args){
    require_once('../modulo/config.php');

    require_once('../Controller/controllerContatos.php');

    //Solicita os dados para a controller
    if($dados = listarContato())
    {
      //Realiza a conversão do array para JSON
      if($dadosJSON = createJSON($dados))
      {
        // Caso exista dados a serem retornados, informamos o statusCode 200 e
        // enviamos um JSON com todos os dados encontrados
        return  $response ->withStatus(200)
                          ->withHeader('Content-Type', 'application/json')
                          ->write($dadosJSON);
      }  
    }else
    {
      //retorna os statusCode que significa que a requisição foi aceita, porém 
      //sem conteudo de retorno
      return  $response ->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message" : "Nenhum contato encontrado"}');
    }

  });

  //Endpoint Requisição para listar contatos pelo id
  $app->get('/contatos/{id}', function($request, $response, $args){
    require_once('../modulo/config.php');

    require_once('../Controller/controllerContatos.php');

    $id = $args['id'];

    if($dados = buscarContato($id))
    {
      if($dadosJSON = createJSON($dados))
      {
        // Caso exista dados a serem retornados, informamos o statusCode 200 e
        // enviamos um JSON com todos os dados encontrados
        return  $response ->withStatus(200)
                          ->withHeader('Content-Type', 'application/json')
                          ->write($dadosJSON);
      }  
    }else
    {
      //retorna os statusCode que significa que a requisição foi aceita, porém 
      //sem conteudo de retorno
      return  $response ->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message" : "Nenhum contato encontrado"}');
    }
    
  });

  //Endpoint Requisição para inserir um novo contato
  $app->post('/contatos', function($request, $response, $args){

  });
  
  $app->run();

?>