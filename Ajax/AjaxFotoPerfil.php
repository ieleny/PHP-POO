<?php
try{
    $classe = $_POST['classe'];
    $metodo = $_POST['acao'];
    $classeSession = $classe.'Session';

    $urlSession = __DIR__."/../Sessao/" .$classeSession. ".php";
    require_once($urlSession);
    //Instancia o objeto do tipo
    $objSession = new $classeSession();

    $arr = array($_POST['id_vendedor']);
    if(isset($_FILES['foto'])){
        if(strpos($_FILES['foto']['type'], 'image/jpg') === false && 
            strpos($_FILES['foto']['type'], 'image/jpeg') === false){
            throw new GensysException(utf8_encode('Formato não permitido! Insira uma imagem de formato JPG ou JPEG.'));
        }
        if($_FILES['foto']['size'] > 1000000){
            throw new GensysException(utf8_encode('Tamanho de arquivo excedido! O tamanho máximo é de 1MB.'));
        }
        $foto = $_FILES['foto']['tmp_name'];
        $fp = fopen($foto, "rb");
        $conteudo_tmp = fread($fp, $_FILES['foto']['size']);
        $conteudo = addslashes($conteudo_tmp);
        fclose($fp);
        array_push($arr, $conteudo);
    }
    echo $objSession->$metodo($arr);
}catch(Exception $e){
    echo $e->getMessage();
}