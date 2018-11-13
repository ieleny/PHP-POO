<?php
// CLASSE QUE RETORNA OS DADOS DO COMBO BOX
require_once __DIR__.'/../Sessao/TabelaPrecoSession.php';
$objSession = new TabelaPrecoSession();
$result = $objSession->comboBoxProduto($_POST['empresa'], $_POST['codsToRemove']);
// EXIBIÇÃO DO COMBO BOX CARREGADO
echo '<option value="">SELECIONE</option>';
while($linha = $result->fetch_assoc()){
    if($linha['codigo'] === $_POST['selected']){
        echo '<option selected value="'.$linha['codigo'].'">'.$linha['codigo'].' - '.strtoupper($linha['descricao']).'</option>'; 
    }else{
        echo '<option value="'.$linha['codigo'].'">'.$linha['codigo'].' - '.strtoupper($linha['descricao']).'</option>';
    }  
}