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
    require_once("modulo/config.php");

    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (String) null;
    $nameFile = (String) null;
    
    if($arquivo['size'] > 0 && $arquivo['type']!="")
    {
        $sizeFile = $arquivo["size"]/1024;
        $typeFile = $arquivo["type"];
        $nameFile = $arquivo["name"];

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

                $nome = md5($nome);
                

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