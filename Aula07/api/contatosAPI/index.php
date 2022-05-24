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
      if(!isset($dados["idErro"])){
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
        $dadosJSON=createJSON($dados);

        return  $response ->withStatus(404)
                          ->withHeader('Content-Type', 'application/json')
                          ->write('{"message" : "Dados invalidos",
                                  "Erro" : '.$dadosJSON.'}');
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

  //Endpoint Requisição para deletar contatos por id
  $app->delete('/contatos/{id}', function($request, $response, $args){

    

    if(is_numeric($args['id']))
    {
      require_once('../modulo/config.php');
      require_once('../Controller/controllerContatos.php');

      //Recebe o id enviado no Endpoint atraves da vareavel ID
      $id =$args['id'];

      //Busca o nome da foto para ser excluida na coontroller
      if($dados = buscarContato($id))
      {
        //Recebe o nome da foto que a controller retornou
        $foto = $dados['foto'];

        //Cria um arra com o nome da foto e do id para que a controller possa excluir o contato
        $arrayDados = array (
            "id"    => $id,
            "foto"  => $foto
        );

        //Chama a funtion de excluir contato, encaminhando o array com o ID e a FOTO
        $resposta = excluirContato($arrayDados);
        if(is_bool($resposta) && $resposta == true)
        {
          return  $response   ->withStatus(200)
                              ->withHeader('Content-Type', 'application/json')
                              ->write('{"message" : "Registro excluido com sucesso"}');
        }elseif(is_array($resposta) && isset($resposta['idErro']))
        {
          if($resposta['idErro'] == 5)
          {
            return  $response   ->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message" : "Resgistro excluido com sucesso, porém houve um problema na exclusão da foto"}');
          }else{

          
            $dadosJSON=createJSON($resposta);

            return  $response ->withStatus(404)
                              ->withHeader('Content-Type', 'application/json')
                              ->write('{"message" : "Ouve um problema no processo de excluir",
                                      "Erro" : '.$dadosJSON.'}');
          }                          
        }
      }else
      {
        return  $response   ->withStatus(404)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message" : "O ID informado não existe na base de dados"}');
      }
    }else
    {
      return  $response   ->withStatus(404)
                          ->withHeader('Content-Type', 'application/json')
                          ->write('{"message" : "É obrigatorio informar um ID com formato valido (número)"}');
    }

  });
  
  //Endpoint Requisição para inserir um novo contato
  $app->post('/contatos', function($request, $response, $args){

  });

  $app->run();

?>