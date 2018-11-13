<?php
    header('Content-type: text/html; charset=ISO-859-1');
    //CONEXAO 
    include_once '../../dados/conexao/SingletonConnection.php';
    
    try{
        $ConsultaItem = "SELECT * FROM ".$_POST['informacoes']." WHERE recno = ".$_POST['valor'].";";
        $result = SingletonConnection::getInstance()->query($ConsultaItem);
        if(!$result){
          echo  '';  
        }else{
            $linha  = $result->fetch_assoc();
            echo $linha['descricao'];  
        }
        
       
    } catch (Exception $ex) {
        throw new GensysException($ex->getMessage());
    }

?>

