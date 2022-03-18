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
    if($_SERVER["REQUEST_METHOD"] == "POST")
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
                    // chama a função 

                    $resposta = inserirContato($_POST);

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
                }
            
                break;
        }
    }

?>