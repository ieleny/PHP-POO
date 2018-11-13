<?php
    include_once __DIR__."/../Modulos/WebSession/VendedorWebSession.php";
    $vendedor = new VendedorWebSession($_SESSION['id_vendedor']); // par�metro: id do usu�rio logado
?>
<!-- Carrega o recno do registro a ser excluido -->
<li value="" id="recnoDel" style="display: none"/></li>
<!-- Modal de alerta -->
<div class="modal fade" id="deleteModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" id="closeModalDelete" onclick="location.reload()" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Aten&ccedil;&atilde;o!</h4>
            </div>
            <!-- DIV PARA ALERTAS -->
            <div id="msg-notify-delete"></div>
            <div class="modal-body">
              <p id="pBodyModalDelete">Este registro ser&agrave; definitivamente exclu&Iacute;do. Clique em DELETAR para continuar ou em CANCELAR para desistir da a&ccedil;&atilde;o.</p>
            </div>
            <div class="modal-footer">            
              <button type="button" class="btn btn-secondary" id="btnCancelarDelete" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" id="btnDeleteModal" onclick="AjaxManipulacoDados('<?=$this->getClassName()?>', $('#recnoDel').val(), 'delete');" >Deletar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="saveModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeModalSave" onclick="location.reload()" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="saveModalTitle">Aten&ccedil;&atilde;o!</h4>
            </div>
            <!-- DIV PARA ALERTAS -->
            <div id="msg-notify-delete"></div>
            <div class="modal-body" class="alert-success">
                <div class="alert alert-success">
                    <strong>Sucesso!</strong> As informa&ccedil;&otilde;es preenchidas foram salvas.
                </div>
                <p id="msg">Escolha uma a&ccedil;&atilde;o abaixo para prosseguir.</p>
            </div>
            <div class="modal-footer">
                <div class="col-sm-4 form-group">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-block" id="btnAddSaveModal"><i class="glyphicon glyphicon-plus-sign"></i> Incluir um novo</button>
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group-btn">
                        <button class="btn btn-success btn-block" id="btnEditSaveModal"><i class="fa fa-edit"></i> Editar registro</button>
                    </div>
                </div>
                <div class="col-sm-4 form-group">
                    <div class="input-group-btn">
                        <button class="btn btn-danger btn-block" id="btnCloseSaveModal"><i class="fa fa-close"></i> Sair do cadastro</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CRIA��O DO GRID PRINCIPAL -->
<div class="row">
    <!-- LISTA -->
    <div class="table-responsive col-md-12">
        <table class="table h5" cellspacing="0" cellpadding="0">
            <!-- MONTA A CABECA DA TABELA -->
            <thead>                
                <tr class="bg-primary">
                    <?php
                        for($x = 0; $x < count($this->getLabelsGrid()) && $x < $this->getQtdItemGrid();$x++){
                            echo '<td>'.$this->getLabelsGrid()[$x].'</td>';
                        }
                    ?>
                    <td><i>A&ccedil;&otilde;es</i></td>
                </tr>
            </thead>
            <!-- MONTA O CORPO DA TABELA -->
            <tbody>
                <?php
                    if(isset($_GET['filtro'])){
                        $this->setFiltro($_GET['filtro']);
                        $VOs = $this->getAtributosFiltrados();
                    }else{
                        $VOs = $this->getCamposAtributos();
                    }                    
                    if($VOs){
                        for($x = 0; $x < count($VOs);$x++){ ?>
                <tr id="<?=$VOs[$x]->getRecno()?>">
                <?php
                    $VOs[$x]->printAtributos();               
                ?>                  
                    <td class="trucShow">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="acoes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="acoes">
                              <li><a href="#">Inutilizar Nota </a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#">Nota Complementar</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#">Enviar por E-mail</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                    <?php }}?>
            </tbody>
        </table>
        <?php 
            if(!$VOs){
                echo '<div class="alert alert-info">
                        <span>Nenhum registro encontrado!</span>
                    </div>';
            }
        ?>
        <!-- PAGINACAO -->
        <div id="bottom" class="row">
            <span id="Paginacao"></span>
        </div>
    </div>
</div>