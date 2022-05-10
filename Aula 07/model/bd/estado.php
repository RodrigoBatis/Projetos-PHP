<?php
    /**************************************************************************
    * Objetivo: Arquivo responsavel por manipular os dados dentro do BD
    *          (select) 
    * Autor: Rodrigo
    * Data: 10/05/2022
    * Versão: 1.0 
    **********************************************************************/

    require_once("conexaomysql.php");

        // função para listar todos os estados do BD
        function selectAllEstados()
        {
            // Abre a conexao com o banco
            $conexao = conexaoMysql();
    
            // script para listar todos os dados do BD
            $sql = "select * from tblestados order by nome asc";
            // essa linha executa o script no BD e garda o retorno dos dados 
            $result = mysqli_query($conexao, $sql);
            //valida se o BD retornou registros
            if($result)
            {
                //mysqli_fetch_assoc() - permite converter os dados do BD
                //em um array para manipular no PHP
                //Nesta repetição estamos, convertendo os dados do BD em um array ($result), além de
                //o proprio while conseguir gerenciar a qtde de vezes que deverá ser feita a repetição
                $cont =0;
                while($rsDados = mysqli_fetch_assoc($result))
                {
                    $arrayDados[$cont] = array(
                        "idestado"  => $rsDados["idestado"],
                        "nome"      => $rsDados["nome"],
                        "sigla"     => $rsDados["sigla"]
                    );
                    $cont++;
                }   
                
                // solicita o fechamento da conexão com o BD
                fecharConexaoMysql($conexao);
    
                if(empty($arrayDados)){
                    return false;
                }else
                {
                    return $arrayDados;
                }
    
                
            }
    
        }
    

?>