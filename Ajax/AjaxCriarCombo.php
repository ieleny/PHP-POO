<?php
//CONEXAO 
include_once __DIR__.'../../../dados/conexao/SingletonConnection.php';
//INSTANCIA DA QUERY
$classeSession = $_POST['pagina']."HTML";
$urlSession = "../view/".$classeSession.".php";
require_once($urlSession);
//Instancia o objeto do tipo
$objSession = new $classeSession();

mysqli_report(MYSQLI_REPORT_STRICT);
try{
    $result = SingletonConnection::getInstance()->query($objSession->LoadComboCriar($_POST['valor']));
    if($result->num_rows == '0'){ ?>
        <select name="<?=$_POST['NomeCombo']?>" id="<?=$_POST['NomeCombo']?>"  class="form-control input-sm chosen-select" onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="" >
        <option value="">SELECIONE</option>
        
    <?php }else{ ?>
        <select name="<?=$_POST['NomeCombo']?>" id="<?=$_POST['NomeCombo']?>" required class="form-control input-sm chosen-select" onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="" >
        <option value="">SELECIONE</option>
    
    <?php }
        while($linha = $result->fetch_assoc()){
            echo '<option value="'.$linha[$_POST['value']].'">'.strtoupper($linha[$_POST['campoQuery']]).'</option>';  
        }
        echo '</select>';
} catch (Exception $ex) {
    throw new GensysException($ex->getMessage());
}