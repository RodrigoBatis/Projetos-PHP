<?php

    /***************************************************************************
     * Objetivo: Arquivo de rota, para segmentar as ações pela view
     *      (dados de um form, listagem de dados, ação de excluir ou atualizar).
     *      Esse arquivo será responsavel por encaminar as solicitações para 
     *      a controller
     * Autor: Rodrigo
     * Data: 04/03/2022
     * Versão: 1.0 
     * 
     **************************************************************************/
    


    $action     = (String) null;
    $component  = (String) null;


    // verificar se a requisição é POST
    if($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET")
    {
        // Recebendo dados pela url para saber quem está soliciando q qual ação será 
            //realizada
        $component  = strtoupper($_GET["component"]);
        $action     = strtoupper($_GET["action"]);

        // estrutura condicional para verificar quem está solicitando algo para o Router
        switch ($component)
        {
            case "CONTATOS";

            require_once("Controller/controllerContatos.php");

                // Validação para identificar o tipo de ação que será realizada
                if($action == "INSERIR")
                {
                    if(isset($_FILES) && !empty($_FILES))
                    {
                        $resposta = inserirContato($_POST, $_FILES);
                    }else
                    {
                        $resposta = inserirContato($_POST, null);
                    }

                    if(is_bool($resposta))
                    {
                        if($resposta){
                            echo("<script>
                                    alert('Registro inserido com sucesso');
                                    window.location.href = 'index.php'; 
                                </script>");
                        }
                    }elseif(is_array($resposta)){
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back(); 
                            </script>");
                    }
                }elseif($action == "DELETAR")
                {
                    // recebe o id do registro que deve ser excluido,
                    // que foi enviado pela URL no link da imagem 
                    //do excluir que foi acionado na index
                    $idContato = $_GET["id"];

                    // chama a função de excluir na controller
                    $resposta = excluirContato($idContato);

                    if(is_bool($resposta))
                    {
                        if($resposta)
                        {
                            echo("<script>
                                    alert('Registro excluido com sucesso');
                                    window.location.href = 'index.php'; 
                                </script>");
                        }
                    }elseif(is_array($resposta))
                    {
                        echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back(); 
                            </script>");
                    }
                }elseif($action == "BUSCAR")
                {
                    // recebe o id do registro que deve ser editado,
                    // que foi enviado pela URL no link da imagem 
                    //do editar que foi acionado na index
                    $idContato = $_GET["id"];

                    // chama a função de buscar na controller
                    $dados = buscarContato($idContato);
 
                    // ***    IMPORTANTE    ***
                    // Ativa a utilização de variavel de sessão no servidor 
                    session_start();

                    // Guarda em uma variavel de sessão os dados que o banco de 
                    //dados retornou para a busca do id.
                        //Obs: (Essa variavel de sessão será utilizada na index.php, 
                        //para colocar os dados nas caixas de texto).
                    $_SESSION["dadosContato"] = $dados;

                    // utilizando o header tambem poderemos chamar a index.php
                    //porem haverá uma ação de carregamento no navegador
                    //piscando a tela novamento
                    // header("location.index.php");

                    // utilizando o require iremos apenas importar a tela da index,
                    //assim não havera um novo carregamento da pagina;
                    require_once("index.php");
                }elseif($action == "EDITAR")
                {
                    //recebe o id que foi encaminhado pelo url por via get
                    $idContato = $_GET["id"];

                     // chama a função de editar na acontroller
                     $resposta = atualizarContato($_POST, $idContato);

                     if(is_bool($resposta))
                     {
                         if($resposta){
                             echo("<script>
                                     alert('Registro Atualizado com sucesso');
                                     window.location.href = 'index.php'; 
                                 </script>");
                         }
                     }elseif(is_array($resposta)){
                         echo("<script>
                                 alert('".$resposta['message']."');
                                 window.history.back(); 
                             </script>");
                     }
                }
            
                break;
        }
    }

?>