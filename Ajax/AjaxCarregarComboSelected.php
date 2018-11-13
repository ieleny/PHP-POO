<?php
// FUNÇÃO PARA CARREGAR O COMBO E TRAZER O OPTION SELECIONADO
$classSession = $_POST['tipo'].'Session';
require_once __DIR__.'/../Sessao/'.$classSession.'.php';
$objSession = new $classSession();
//$result = $objSession->retrieveAll();
$result = $objSession->getValueOtherTable('cliente','funcionario','recno',$_POST['id']);

echo $result;
//while($linha = $result->fetch_assoc()){
//    if($linha['recno'] === $idComparado){
//    echo '<option value="'.utf8_encode($linha['recno']).'" selected="'.utf8_encode('selected').'">'.strtoupper(utf8_encode($linha[$_POST['text']])).'</option>'; 
//}else{
//    echo '<option value="'.utf8_encode($linha['recno']).'">'.strtoupper(utf8_encode($linha[$_POST['text']])).'</option>';
//}
//}