<?php
abstract class HTML {
    
    private $totalRegistros;
    private $totalPaginas;
    private $itensPagina;
    private $camposLabels;
    private $camposAtributos;
    private $camposInputs;
    private $session;
    private $filtro;
    private $qtdItemGrid;
    protected $labelsGrid;
    protected $titleBtnPreview;

    public function __construct() {
        $this->camposLabels = array();
        $this->camposAtributos = array();
        $this->labelsGrid = NULL;
        $this->itensPagina = 7;
        $this->filtro = NULL;
        $this->qtdItemGrid = 5;
        $this->titleBtnPreview = "Preview";
    }
    
    public function getLabelsGrid(){
        return ($this->labelsGrid === NULL) ? $this->camposLabels : $this->labelsGrid;
    }
    
    public function setLabelsGrid($labelsGrid){
        $this->labelsGrid = $labelsGrid;
    }
    
    function setItensPagina($itensPagina) {
        $this->itensPagina = $itensPagina;
    }

    public function getQtdItemGrid(){
        return $this->qtdItemGrid;
    }

    public function setQtdItemGrid($qtd){
        $this->qtdItemGrid = $qtd;
    }
    
    public function getTabs(){
        return $this->tabs;
    }
    
    public function getSession(){
        return $this->session;
    }
    
    public function setSession($session){
        $this->session = $session;
    }  

    public function setCamposAtributos($atributos){
        $this->camposAtributos = $atributos;
    }
    
    public function getFiltro(){
        return $this->filtro;
    }
    
    public function setFiltro($filtro){
        $this->filtro = $filtro;
    }

    public function getCamposInputs(){
        return $this->camposInputs;
    }
    
    public function setCamposInputs($inputs){
        $this->camposInputs = $inputs;
    }
    
    public function setCamposLabels($labels){
        $this->camposLabels = $labels;
    }
    
    public function getPaginaInicio(){
        return ($this->itensPagina * $this->getPaginaAtual()) - $this->itensPagina;
    }
    
    public function getAtributosFiltrados(){
        $VOs = $this->getSession()->searchLimit($this->getFiltro(), $this->getPaginaInicio(), $this->getItensPagina());
        $this->setTotalPaginas(ceil($this->session->registroTotalFiltro($this->filtro) / $this->getItensPagina()));
        return $VOs;
    }
    
    public function loadGrid(){
        include_once __DIR__."/IncGrid.php";
    }
    
    public function loadTopo(){
        include_once __DIR__."/IncTopo.php";
    }
    
    public function loadModal(){
        include_once "../../Modulos/Modal/IncModalSimples.php";
    }
    
    public function loadComboChosen($combo, $tabela, $campo, $value){
        $result = $this->session->comboBox($tabela, $campo, $value);
        echo '<select name="'.$combo.'" id="'.$combo.'" class="form-control input-sm chosen-select" onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="">
            <option value=""></option>';
        while($linha = $result->fetch_assoc()){
            echo '<option value="'.$linha[$value].'">'.strtoupper($linha[$campo]).'</option>'; 
        }
        echo '</select>';
    }
    
    public function loadComboChosenMult($id, $name, $tabela, $campo, $value){
        $result = $this->session->comboBox($tabela, $campo, $value);
        echo '<select name="'.$name.'" id="'.$id.'" class="form-control input-sm chosen-select" multiple onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="">
            <option value=""></option>';
        while($linha = $result->fetch_assoc()){
            echo '<option value="'.$linha[$value].'">'.strtoupper($linha[$campo]).'</option>'; 
        }
        echo '</select>';
    }
    
    public function loadCombo($combo, $tabela, $campo, $value){
        $result = $this->session->comboBox($tabela, $campo, $value);
        ?><select name="<?=$combo?>" id="<?=$combo?>" class="form-control input-sm" onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="">
          <option value="">SELECIONE</option>
        <?php
        while($linha = $result->fetch_assoc()){
            echo '<option value="'.$linha[$value].'">'.strtoupper($linha[$campo]).'</option>'; 
        }
        echo '</select>';
    }
    
    public function loadComboAutoFocus($combo, $tabela, $campo, $value, $required = false){
        $result = $this->session->comboBox($tabela, $campo, $value);
        ?><select name="<?=$combo?>" id="<?=$combo?>" required="<?=$required?>" class="form-control input-sm" onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="" autofocus="true">
          <option value="">SELECIONE</option>
        <?php
        while($linha = $result->fetch_assoc()){
            echo '<option value="'.$linha[$value].'">'.strtoupper($linha[$campo]).'</option>'; 
        }
        echo '</select>';
    }
    
    public function getCamposLabels(){
        return $this->camposLabels;
    }
    
    public function getCamposAtributos(){
        $VOs = $this->getSession()->retrieveAllLimit($this->getPaginaInicio(), $this->getItensPagina());        
        $this->setTotalPaginas(ceil($this->session->registroTotal() / $this->getItensPagina()));
        return $VOs;
    }
    
    public function getItensPagina(){
        return $this->itensPagina;
    }
    
    public function getPaginaAtual(){
        return intval($this->escapaGET('pagina', 1));
    }
    
    public function getTotalPaginas(){
        return $this->totalPaginas;
    }
    
    public function getTotalRegistros(){
        return $this->totalRegistros;
    }
    
    public function setTotalRegistro($registros){
        $this->totalRegistros = $registros;
    }
    
    public function setTotalPaginas($total){
        $this->totalPaginas = $total;
    }
    
    public function loadFuncoes(){
        ?>
            <script src="../../libs/jquery-ui-1.12.1.custom/external/jquery/chosen.jquery.js" type="text/javascript"></script>
            <link href="../../css/chosen.css" rel="stylesheet" type="text/css"/>
            <script>
                $(function (){
                    $(".chosen-select").chosen({
                        allow_single_deselect: true,
                        no_results_text:'Oops,Não encontrado!',
                        placeholder_text:'Pesquisar...',
                        width:'100%',
                        max_shown_results: 15,
                        search_contains: true});
                });
            </script>
        <?php
    }
    
    //FUNÇÃO PARA ESCAPAR TRATAMENTO DADOS DO FORMULARIOS SUBMETIDO PELO METODO GET
    private function escapaGET($atributo, $valor_padrao = null, $add_aspas = false){

        //CHAMA A FUN��O ESCAPA DEFININDO E M�TODO GET
        return $this->escapa($atributo, $valor_padrao, $add_aspas, "GET");
    }

    //FUNÇÃO PARA ESCAPAR TRATAMENTO DADOS PERSISTENTES NA BASE DE DADOS
    private function escapa($atributo, $valor_padrao = null, $add_aspas = false, $metodo = null){

        //VERIFICA SE FOI DEFINIDO O M�TODO POST
        if ($metodo==='POST'){

            //VERIFICA SE A VARI�?VEL FOI INICIALIZADA
            if(isset($_POST[$atributo])){ $atributo = addslashes(strip_tags(htmlspecialchars_decode(trim($_POST[$atributo]),ENT_QUOTES))); }
            else{ $atributo = $valor_padrao; }
        }
        //VERIFICA SE FOI DEFINIDO O M�TODO GET
        else if ($metodo==='GET'){

            //VERIFICA SE A VARI�?VEL FOI INICIALIZADA
            if(isset($_GET[$atributo])){ $atributo = addslashes(strip_tags(htmlspecialchars_decode(trim($_GET[$atributo]),ENT_QUOTES))); }
            else{ $atributo = $valor_padrao; }
        }
        else{

            //VERIFICA SE A VARI�VEL FOI INICIALIZADA
            if(isset($atributo)){ $atributo = addslashes(strip_tags(htmlspecialchars_decode(trim($atributo),ENT_QUOTES))); }
            else{  $atributo = $valor_padrao; }
        }

        //VERIFICA SE O ELEMENTO EST�O VAZIO
        if(empty($atributo)){ $atributo = $valor_padrao; }

        //VERIFICA SE S�O PARA ADICIONAR ASPAS
        if($add_aspas===true){ $atributo = addAspas($atributo, $valor_padrao); }    

        //RETORNA ATRIBUTO TRATADO
        return $atributo;
    }
    
    //ESCOLHER A CONSULTA
    public function ChoiceConsulta(){
        return 'AjaxConsulta';
    }
    
    //FUN��ES ABSTRATAS
    //FUN��O PARA ESCOLHER QUAL A FUN��O DE CONSULTA
    public abstract function getPageTitulo();
    public abstract function getClassName();
    public abstract function getDireitoVerString();
    public abstract function getDireitoIncluirString();
    public abstract function getDireitoAlterarString();
    public abstract function getDireitoExcluirString();    
    public abstract function getDireitoImprimirString();  
}