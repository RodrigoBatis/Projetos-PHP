<?php

    /**************************************************************************
     * Objetivo: Arquivo responsavel pelas manipulações de dados de contatos
     *      OBS(Este fará a ponte entre a View e é Model) 
     * Autor: Rodrigo
     * Data: 04/03/2022
     * Versão: 1.0 
     **************************************************************************/

     // função para receber dados da View encaminhar para a model 
     function inserirContato($dadosContato, $file)
     {
         $nomeFoto = (String) null;

         // validação para verificar se o objeto está vazio
        if(!empty($dadosContato))
        {
            //validação de caixa vazia dos lementos nome, celular e email pois são obrigatorios no banco de dados
            if(!empty($dadosContato["txtNome"]) && !empty($dadosContato["txtCelular"]) && !empty($dadosContato["txtEmail"]))
            {
                //validação para identificar se chegou um arquivo para upload
                if($file != null){
                    //import da funtion upload
                    require_once("modulo/upload.php");
                    //chava a funtion de upload
                    $nomeFoto = uploadFile($file['fileFoto']);
                

                    if(is_array($nomeFoto))
                    {
                        //caso aconteça algum erro no processo do upload a funtion 
                        //ira retornar um array com a possivel mensagem de erro esse 
                        //array será retornado para a router e ela ira inserir para o usuario
                        return $nomeFoto;
                    }
                   
                }
                //o if a cima e para fotos

                // criação do array de dados que será encaminhado da model 
                //para enserir no banco de dados, é importante criar esse 
                //array conforme a nescessidade de manipulação do BD.
                //OBS: criar as chaves do array conforme os nomes dos atributos do BD.
                $arrayDados = array 
                (
                    "nome"      => $dadosContato["txtNome"],
                    "telefone"  => $dadosContato["txtTelefone"],
                    "celular"   => $dadosContato["txtCelular"],
                    "email"     => $dadosContato["txtEmail"],
                    "obs"       => $dadosContato["txtObs"],
                    "foto"      => $nomeFoto
                );

                // Import do arquivo da modelagem para manipular o BB
                require_once("./model/bd/contato.php");

                // Chama a função que fará o insert no BD(esta função está na model)
                if(insertContato($arrayDados))
                {
                    return true;
                }else
                {
                    return array("idErro" => 1, 
                                "message" => "não foi possivel inserir os dados no Banco de Dados!!!");
                }

            }else
            {
                return array("idErro" => 2,
                            "message" => "existem campos obrigatorios que não foram preenchidos!!!");
            }
        }
     }

    // função para receber dados da View encaminhar para a model  (Atualizar)
    function atualizarContato($dadosContato, $id)
     {
         // validação para verificar se o objeto está vazio
         if(!empty($dadosContato))
         {
             //validação de caixa vazia dos lementos nome, celular e email pois são obrigatorios no banco de dados
             if(!empty($dadosContato["txtNome"]) && !empty($dadosContato["txtCelular"]) && !empty($dadosContato["txtEmail"]))
             {
                 //validação para garantir que o id seja valido
                 if(!empty($id) && $id != 0 && is_numeric($id))
                {
                    // criação do array de dados que será encaminhado da model 
                    //para enserir no banco de dados, é importante criar esse 
                    //array conforme a nescessidade de manipulação do BD.
                    //OBS: criar as chaves do array conforme os nomes dos atributos do BD.
                    $arrayDados = array 
                    (
                        "id"        => $id,   
                        "nome"      => $dadosContato["txtNome"],
                        "telefone"  => $dadosContato["txtTelefone"],
                        "celular"   => $dadosContato["txtCelular"],
                        "email"     => $dadosContato["txtEmail"],
                        "obs"       => $dadosContato["txtObs"]
                    );
    
                    // Import do arquivo da modelagem para manipular o BB
                    require_once("./model/bd/contato.php");
    
                    // Chama a função que fará o insert no BD(esta função está na model)
                    if(updateContato($arrayDados))
                    {
                        return true;
                    }else
                    {
                        return array("idErro" => 1, 
                                    "message" => "não foi possivel atualizar os dados no Banco de Dados!!!");
                    }
                }else
                {
                    return array('idErro' => 4,
                    'message' => "Não é possivel editar o registro sem informar um id valido.");
                }
             }else
             {
                 return array("idErro" => 2,
                             "message" => "existem campos obrigatorios que não foram preenchidos!!!");
             }
         }
     }

     // função para buscar um contato atravez do id do registro
     function buscarContato($id)
     {
        // Validação para verificar se contem um numero valido 
        if($id != 0 &&  !empty($id) && is_numeric($id))
        {
            // Importe do arquivo de contato
            require_once("model/bd/contato.php");

            $dados = selectByidContato($id);

            if(!empty($dados))
            {
                return $dados;
            }else
            {
                return false;
            }

        }else
        {
            return array('idErro' => 4,
                         'message' => "Não é possivel buscar um registro sem informar um id valido.");
        }
     }

     // função para realizar a exclusão de um contato 
     function excluirContato($id)
     {
        // Validação para verificar se contem um numero valido
        if($id != 0 &&  !empty($id) && is_numeric($id))
        {
            // Importe do arquivo de contato
            require_once("model/bd/contato.php");

            // Chama a função da model e valida se o retorno foi verdadeiro ou falso
            if(deleteContato($id))
            {
                return true;
            }else
            {
                return array('idErro' => 3,
                'message' => "O banco não pode excluir o registro.");
            }
        }else
        {
            return array('idErro' => 4,
                         'message' => "Não é possivel excluir o registro sem informar um id valido.");
        }
     }

      // função para rsolicitar os dados da model e encaminhar a lista
      // de contatos para View 
      function listarContato()
      {
        require_once("model/bd/contato.php");

        // chama a função que vai buscar os dados no BD
        $dados = selectAllContato();

        if(!empty($dados))
        {
            return $dados;
        }else
        {
            return false;
        }

      }    
?>