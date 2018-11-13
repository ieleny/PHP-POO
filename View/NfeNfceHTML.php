<?php

include_once __DIR__."../../../Include/HTML.php";
include_once __DIR__."/../../Modulos/Sessao/NfeNfceSession.php";

class NfeNfceHTML extends HTML
{
	
    function __construct()
    {
        parent::__construct();
        parent::setSession(new NfeNfceSession());
        parent::setCamposLabels($labels = array('Empresa','(NFE / NFC-E)','Número','Nota Fiscal','Cliente','Data Mov.','Emissão','Status','Danfe','CNPJ','Razão Social','Fantasia','Fone','Inc.Est','CEP','Logradouro','Número','Complemento','Bairro','Cód. Cidade','Cidade','UF','Emissão','Saída','Hora Saída','CFOP','Documento','Número NF','CPF','Importacao','Acréscimo Total','País','E Subst. Trib do Emit','Observação'));
        parent::setCamposInputs($inputs = array('empresa','tiponfcnfe','numero','notafiscal','cliente','datahora','datahora','autorizacao','danfe','cgc','razaosocial','fantasia','fonecomercial','incestadual','cep','logradouro','numero','complemento','bairro','codcidade','cidade','uf','emissao','saida','horasaida','cfop','numero','notafiscal','cpf','importacao','acrescimototal','pais','substtribemit','observacao'));
        parent::getSession()->setCampos(parent::getCamposInputs());
        parent::setQtdItemGrid(9);
    }

    public function getDireitoAlterarString() {
        
    }

    public function getDireitoExcluirString() {
        
    }

    public function getDireitoImprimirString() {
        
    }

    public function getDireitoIncluirString() {
    	return "danfeconfigurar";
    }

    public function getDireitoVerString() {
    	return "danfever";
    }

    public function getPageTitulo() {
    	return "NFCE & NFE";
    }

    public function loadFuncoes() {
        ?>
            <script src="../../Modulos/Ajax/AjaxNfeNfce.js" type="text/javascript"></script>
        <?php
    }

    public function getClassName() {
        return "NfeNfce";
    }
    
    public function loadModal() {
        include_once __DIR__."../../Modal/NfeNfceModal.php";
    }
    
    public function loadTopo() {
        include_once __DIR__."../../../Include/IncTopoNfeNfce.php";
    }
    
    public function loadGrid() {
        include_once __DIR__."../../../Include/IncGridNfeNfce.php";
    }
    
    //FUN��O QUE MONTA O COMBO DA EMPRESA
    public function loadComboBoxEmpresa($combo, $tabela, $campo, $value){
        $result = $this->getSession()->comboBox($tabela, $campo,$value);
        ?>
            <select name="<?=$combo?>" id="<?=$combo?>" required class="form-control input-sm" onchange="AjaxCarregarValorCombo(this.value);" onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="" autofocus="true">
            <option value="">SELECIONE</option>
        <?php

            while($linha = $result->fetch_assoc()){
                echo '<option value="'.$linha[$value].'">'.strtoupper($linha[$campo]).'</option>';  
            }
        echo '</select>';
    }
    
}
