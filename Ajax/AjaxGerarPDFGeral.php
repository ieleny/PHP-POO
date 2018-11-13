<?php

$GerarPdfText = $_POST;

if(isset($GerarPdfText['classe'])){
    $classe = $GerarPdfText['classe'];
    $indice = $GerarPdfText['indice'];
}

//Url do HTML
$classeHTML = $classe."HTML";
$urlHTML = "../View/".$classeHTML.".php";
require_once($urlHTML);
//Instancia o objeto do tipo
$objSession = new $classeHTML();
$paginaPDF = $objSession->LisOfPreview()[$indice];

//Url pagina PDF
echo '../../Modulos/GeracaoPDF/'.$paginaPDF.'.php';
