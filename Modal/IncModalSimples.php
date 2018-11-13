<form id="CamposForm" name="CamposForm" method="POST" onsubmit="AjaxManipulacoDados('<?=$this->getClassName()?>', $('#id').val(), $('#acao').val());">
    <!-- MODAL CADASTRO/ATUALIZAÇÃO-->
    <div class="modal fade" id="Modal" role="dialog" data-backdrop="static">
        <!-- CHAMANDO A MODAL -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" onclick="location.reload()" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Cadastro <?=$this->getPageTitulo();?></h4>
                </div>
                <!-- CORPO DO MODAL -->  
                <div class="modal-body">
                    <!-- TABS -->
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" href="#dadosPrincipal"> Dados Principais</a></li>
                    </ul>
                    <!-- CONTEUDO DAS TABS -->
                    <div class="tab-content">
                        <!-- TAB 1 -->
                        <div id="dadosPrincipal" class="tab-pane fade in active">
                            <div class="row form-group">
                                <?php
                                    for($x = 0; $x < count($this->camposLabels); $x++){
                                        $label = '<div class="col-sm-';
                                        echo (strlen($this->camposLabels[$x]) > 15) ? $label.'3">' : $label.'2">';
                                        echo '<label>'.$this->camposLabels[$x].'</label>';
                                        echo '<input name="'.$this->camposInputs[$x].'" id="'.$this->camposInputs[$x].'" type="text" class="form-control input-sm"/>';
                                        echo '</div>';
                                        if($x % 4 == 0 && $x != 0){
                                            echo '</div>';
                                            echo '<div class="row form-group">';
                                        }
                                    }
                                    echo '</div>';
                                ?>
                            </div>
                            <!-- RODAPE DA MODAL -->
                            <div class="modal-footer">
                               <button type="button" onclick="location.reload()" class="btn btn-default" data-dismiss="modal" >Fechar</button>
                               <button type="submit" id="salvar" class="btn btn-primary" title="">Salvar</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>    
</form>     
<!-- RESPONSAVEL POR DEFINIR A AÇÃO -->
<input type="hidden" id='acao'/> 
<!-- RESPONSAVEL POR RECEBER O ID --> 
<input type="hidden" id='id' /> 
<!-- MODAL DA IMPRESSÃO -->
<span class="modal_impressao"  id="modal_impressao" title="Tipos de Relatorios"></span>