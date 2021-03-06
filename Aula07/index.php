<?php

    require_once("modulo/config.php");

    //$nome = (String) null;

    $form =(String) "router.php?component=contatos&action=inserir";
    //vareavel para carregar o nome da foto do bd
    $foto = (String) null;
    $idestado = (String) null;

    // valida se a variavel de sessão está ativa
    if(session_status())
    {
        if(!empty($_SESSION["dadosContato"]))
        {
            $id         = $_SESSION["dadosContato"]["id"];
            $nome       = $_SESSION["dadosContato"]["nome"];
            $telefone   = $_SESSION["dadosContato"]["telefone"];
            $celular    = $_SESSION["dadosContato"]["celular"];
            $email      = $_SESSION["dadosContato"]["email"];
            $obs        = $_SESSION["dadosContato"]["obs"]; 
            $foto       = $_SESSION["dadosContato"]["foto"];
            $idestado   = $_SESSION["dadosContato"]["idestado"]; 
            //mudamos a ação do form para editar o registro no click do botão salvar
            $form = "router.php?component=contatos&action=editar&id=".$id."&foto=".$foto;

            //destroi uma vareavel da memoria do navegador
            unset($_SESSION["dadosContato"]);
        }
    }    

?>
<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">


    </head>
    <body>
       
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>               
            </div>

            <div id="cadastroInformacoes">
                <!--Essa opção é obrigatória para enviar arquivos do formulário em html para o servidor -->
                <form  action="<?=$form?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="nome" value="<?= isset($nome)? $nome:null /*if ternario para tratar vareavel indefinida*/?>" placeholder="Digite seu nome" maxlength="100">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estado: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="estado">
                                <option value="">Selecione um item:</option>
                                <?php
                                    //Import a controller de estados
                                    require_once("controller/controllerEstados.php");
                                    //Chama a funtion para carregar todos os estados do BD
                                    $listEstados = listarEstado();
                                    foreach($listEstados as $item)
                                    {
                                        ?>
                                            <option <?=$idestado == $item['idestado'] ?'selected':null?> value="<?=$item['idestado']?>"><?=$item['nome'] . "  (" . $item['sigla'] . ")"?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                                     
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="telefone" value="<?= isset($telefone)? $telefone:null ?>" placeholder="Digite seu telefone">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="celular" value="<?= isset($celular)? $celular:null ?>" placeholder="Digite seu celular">
                        </div>
                    </div>
                   
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="email" value="<?= isset($email)? $email:null ?>" placeholder="Digite seu email">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Escolha um arquivo: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="foto"  accept=".png, .jpg, .svg, .gif, .jpeg">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="obs" cols="50" rows="7"><?= isset($obs)? $obs:null ?></textarea>
                        </div>
                    </div>

                    <div class="campos">
                        <img src="<?=DIRETORIO_FILE_UPLOAD.$foto?>">
                    </div>

                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
               <?php
                    require_once('Controller/controllerContatos.php');
                    $listContato = listarContato();

                    if(empty($listContato)){
                        return false;
                    }else{

                    foreach($listContato as $item)
                    {
                        //vareavel para carregar a foto que veio do bd
                        $foto = $item['foto'];

               ?>
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?= $item['nome']?></td>
                    <td class="tblColunas registros"><?= $item['celular']?></td>
                    <td class="tblColunas registros"><?= $item['email']?></td>
                    <td class="tblColunas registros"><img src="<?=DIRETORIO_FILE_UPLOAD.$foto?>" class="foto"></td>
                   
                    <td class="tblColunas registros">

                            <a href="router.php?component=contatos&action=buscar&id=<?=$item['id']?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>

                            <a onclick="return confirm('Tem certeza que quer excluir esse contato?')" href= "router.php?component=contatos&action=deletar&id=<?=$item['id']?>&foto=<?=$foto?>">
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                            </a>

                            <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                    </td>
                </tr>

                <?php
                 }
                }
                ?>

            </table>
        </div>
    </body>
</html>