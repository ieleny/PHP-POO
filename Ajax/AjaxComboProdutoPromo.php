<?php
// CLASSE QUE RETORNA OS DADOS DO COMBO BOX
require_once __DIR__.'/../Sessao/PromocoesItemSession.php';
$objSession = new PromocoesItemSession();
$result = $objSession->comboBoxProduto($_POST['id_empresa']);

$arr = array();
while($linha = $result->fetch_assoc()){
    foreach ($linha as $key => $value) {
        $linha[$key] = utf8_encode($value);
    }
    array_push($arr, $linha);
}
echo json_encode($arr);
