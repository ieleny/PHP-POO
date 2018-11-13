<?php
// CLASSE QUE RETORNA OS DADOS DO COMBO BOX
$classSession = $_POST['sessaoCombo'].'Session';
require_once __DIR__.'/../Sessao/'.$classSession.'.php';
$objSession = new $classSession();
// RESULTADO DA CONSULTA PARA CARREGAMENTO DO COMBO BOX
$result = $objSession->retrieveAll();
// EXIBIÇÃO DO COMBO BOX CARREGADO
while($linha = $result->fetch_assoc()){
    echo '<option value="'.utf8_encode($linha[$_POST['value']]).'">'.strtoupper(utf8_encode($linha[$_POST['atributo']])).'</option>'; 
}