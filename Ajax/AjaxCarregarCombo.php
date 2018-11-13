<?php
// CLASSE QUE RETORNA OS DADOS DO COMBO BOX
$classSession = $_POST['tipo'].'Session';
require_once __DIR__.'/../Sessao/'.$classSession.'.php';
$objSession = new $classSession();
// RESULTADO DA CONSULTA PARA CARREGAMENTO
$result = $objSession->retrieveAll();
// EXIBIÇÃO DO COMBO BOX CARREGADO
while($linha = $result->fetch_assoc()){
    echo '<option value="'.utf8_encode($linha['recno']).'">'.strtoupper(utf8_encode($linha[$_POST['text']])).'</option>'; 
}