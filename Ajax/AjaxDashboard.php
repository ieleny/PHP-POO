<?php

require_once __DIR__."/../../dados/sql/DashboardDAOSQL.php";
include_once __DIR__."/../../exception/GensysException.php";

$DashText = $_POST;

if(isset($DashText['tabela'])){
    $tabela = $DashText['tabela'];
    $metodo = $DashText['metodo'];
    $empresa = $DashText['empresa'];
}

$objDAOSQL = new DashboardDAOSQL($tabela);

try{
    
    $result = $objDAOSQL->$metodo($empresa); 
    
    if($result){
        $linha  = $result->fetch_assoc();
        echo $linha['total']; 
    }
    
    if($result == '0'){
        echo '0';
    }
    
} catch(GensysException $e){
    echo utf8_encode($e->getMessage());
}




