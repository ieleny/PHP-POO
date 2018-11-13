<?php 

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    include_once __DIR__."../../../Include/HTML.php";
    include_once __DIR__."/../../Modulos/Sessao/DashboardSession.php";

    class DashboardHTML extends HTML{
        
        public function __construct() {
            parent::__construct();
            parent::setSession(new DashboardSession());  
            parent::setCamposLabels($labels = array('Numero','Empresa'));
            parent::setCamposInputs($inputs = array('Numero','id_empresa'));
            parent::getSession()->setCampos(parent::getCamposInputs());
        }
        
        public function getClassName() {
            return "Dashboard";
        }
        
        public function loadFuncoes(){
            ?>
                <link rel="stylesheet" href="../../libs/Dashboard/bower_components/Ionicons/css/ionicons.min.css">
                <link rel="stylesheet" href="../../libs/Dashboard/dist/css/AdminLTE.min.css">
                <script src="../../libs/Dashboard/dist/js/adminlte.min.js"></script>
                <script src="../../libs/Dashboard/bower_components/chart.js/Chart.js"></script>
                <script src="../../libs/Dashboard/dist/js/pages/dashboard2.js"></script>
                <script src="../../libs/Dashboard/dist/js/demo.js"></script>
                <script>AjaxEmpresaExistente()</script>
            <?php
        }

        public function getDireitoAlterarString() {

        }

        public function getDireitoExcluirString() {

        }

        public function getDireitoImprimirString() {

        }

        public function getDireitoIncluirString() {

        }

        public function getDireitoVerString() {

        }

        public function getPageTitulo() {
            return "Dashboard";
        }
        
        public function loadGrid() {
            include_once __DIR__."/../../Include/Dashboard/IncGridDashboard.php";
        }
        
        public function loadTopo(){
            include_once __DIR__."/../../Include/Dashboard/IncTopoDashboard.php";
        }
        
        public function loadCombo($combo, $tabela, $campo, $value) {
            $result = $this->getSession()->comboBox($tabela, $campo,$value); 
            ?>
                <select id="<?=$combo?>" class="form-control input-sm"  onfocus=javascript:this.style.backgroundColor="Khaki"; onblur=javascript:this.style.backgroundColor="" onchange="SendCompany($('#id_empresa').val())">
                <option value="">SELECIONE</option>
            <?php

                while($linha = $result->fetch_assoc()){
                    echo '<option value="'.$linha[$value].'">'.strtoupper($linha[$campo]).'</option>';  
                }
            echo '</select>';
        }
    }
?>


