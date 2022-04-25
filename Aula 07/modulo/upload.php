<?php
/**************************************************************************
 * Objetivo: arquivo responsavel em realizar upload de arquivos
 * Autor: Rodrigo
 * Data: 25-04-2022
 * Versão: 1.0
***************************************************************************/



//função para realizar upload de img 
function uploadFile($arrayFile)
{
    require_once("config.php");

    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (String) null;
    $nameFile = (String) null;
    $tempFile = (String) null;
    
    if($arquivo['size'] > 0 && $arquivo['type']!="")
    {
        $sizeFile = $arquivo["size"]/1024;
        $typeFile = $arquivo["type"];
        $nameFile = $arquivo["name"];
        $tempFile = $arquivo["tmp_name"];

        //validação para permitir upload de no maximo 5MB
        if($sizeFile <= MAX_FILE_UPLOAD)
        {

            //Validação para permitir apenas extensões validas
            if(in_array($typeFile, EXT_FILE_UPLOAD))
            {
                //separa somente o nome do arquivo sem a extensão
                $nome = pathinfo($nameFile, PATHINFO_FILENAME);
                //separa somente a extensão do arquivo sem o nome
                $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);
                
                /*existem diversos algoritimos de criptografia de dados
                    *md5()
                    *sha1()
                    *hash()
                */

                //md5 gerando uma criptografia de dados
                //.uniqid() gerando uma sequencia de numeros diferentes tendo como base a maquina 
                //time() pega a hora, minuto e segundo que está sendo feito o upload 
                $nomeCripty = md5($nome.uniqid(time()));
                
                //montamos novamente o nome do arquivo com a extensão
                $foto = $nomeCripty.".".$extensao;

                //envia o aquivo da pasta temporaria para a pasta criada no projeto
                if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto))
                {
                    return $foto;
                }else
                {
                    return array("idErro" => 13,
                             "message" => "Não foi possivel mover o arquivo para o servidor!!!");
                }

            }else
            {
                return array("idErro" => 12,
                             "message" => "A extensão do arquivo selecionado não é permitida no Upload!!!");
            }

        }else
        {
            return array("idErro" => 10,
                             "message" => "Tamanho de arquivo invaldo no Upload!!!");
        }

    }else
    {
        return array("idErro" => 11,
                             "message" => "não é possivel realizar o Upload sem arquivo selecionado!!!");
    }
}

?>