<form id="FormCertificado">
    <!-- MODAL PARA INSERCAO DE CERTIFICADO DIGITAL -->
    <div class="modal fade" id="ModalConfigurar" role="dialog" data-backdrop="static">
        <!-- CHAMANDO A MODAL -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" onclick="location.reload()" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Cadastro <?=$this->getPageTitulo();?></h4>
                    </div>
                    <!-- CORPO DO MODAL -->  
                    <div class="modal-body">
                        <ul class="nav nav-pills">
                            <li class="active"><a data-toggle="tab" href="#configuracao"> Configuração </a></li>
                            <li><a data-toggle="tab" href="#dados"> Dados </a></li>
                                                                <li><a data-toggle="tab" href="#dadosDownloadXML"> Autorizar Download XML(Padrão dados Contabilidade) </a></li>
                        </ul>
                        <!-- CONTEUDO DAS TABS -->
                        <div class="tab-content">
                            <!-- Aba 1 -->
                            <div id="configuracao" class="tab-pane fade in active">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="tab" href="#certificado"> Certificado </a></li>
                                    <li><a data-toggle="tab" href="#webservice"> Web Service </a></li>
                                    <li><a data-toggle="tab" href="#danfe"> Danfe </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="certificado" class="tab-pane fade in active">
                                        <!-- ROW 1-->
                                        <!-- CRIAR UM AJAX PARA FAZER A BUSCAR DOS DADOS E TAMBEM DO CERTIFICADO DIGITAL -->
                                        <div class="row form-group">                                                                                               
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[0] ?></label>
                                                <?php $this->loadComboBoxEmpresa($this->getCamposInputs()[0], 'empresa', 'descricao', 'id_empresa'); ?>                                
                                            </div>                        
                                        </div>
                                        <!--ROW 2-->
                                        <div class="row form-group">                                                                                                                                                     
                                            <div class="col-md-10">
                                                <label>Certificado Digital A1</label>
                                                <input type="file" class="btn btn-default btn-block" name="certificado" id="certificado" required>
                                            </div>                                              
                                        </div>
                                        <!--ROW 3-->
                                        <div class="row form-group">                                                                                                                                                                                                
                                            <div class="col-md-4">
                                                <label>Senha do Certificado</label>
                                                <input name="senhaCertificado" id="senhaCertificado" class="form-control input-sm" type="password"/>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Certificado Válido até</label>
                                                <input name="dataCertificado" id="dataCertificado" class="form-control input-sm" type="date" readonly/>
                                            </div>
                                            <div class="col-md-4">
                                                <label>CRT</label>
                                                <input name="crt" id="crt" class="form-control input-sm" type="text"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="webservice" class="tab-pane fade">
                                        <div class="row form-group">
                                            <div class="col-md-4">
                                                <label>Selecione o Ambiente Destino</label>
                                                <div class="radio">
                                                     <label><input type="radio" name="ambiente" id="ambienteProducao"  />Producao</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="ambiente" id="ambienteHomologacao"  />Homologação</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Danfe</label>
                                                <div class="radio">
                                                    <label><input type="radio" name="layout" id="layoutRetrato" />Retrato</label>
                                                </div>
                                                <div class="radio">  
                                                    <label><input type="radio" name="layout" id="layoutPaisagem" />Paisagem</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Modo de Emissão</label>
                                                <div class="radio">
                                                    <label><input type="radio" name="notaEmissao" id="notaEmissaoNormal" />Normal</label>
                                                </div>
                                                <div class="radio">  
                                                    <label><input type="radio" name="notaEmissao" id="notaEmissaoComplementar" />Complementar</label>
                                                </div>
                                                <div class="radio">  
                                                    <label><input type="radio" name="notaEmissao" id="notaEmissaoCorrecao" />Carta Correção</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="danfe" class="tab-pane fade">                                   
                                        <div class="row form-group">
                                            <div class="col-sm-5">
                                                <label>Campo QTDE</label>
                                                <input type="text" class="form-control input-sm" name="campoqtde" id="campoqtde" />
                                            </div>                                        
                                            <div class="col-sm-5">
                                                <label>Campo Valor Unitário</label>
                                                <input type="text" class="form-control input-sm" name="campoValorUnitario" id="campoValorUnitario" />
                                            </div>                                        
                                        </div>                                        
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <div>
                                                    <label><input type="checkbox" name="usardescricaodetalhada" id="usardescricaodetalhada"/> Usar Descrição detalhada na nota em Inf.Adicionada</label>
                                                    <label><input type="checkbox" name="gerarprevia" id="gerarprevia"/> Gerar Prévia da NFE</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div>
                                                    <label><input type="checkbox" name="gerarDuplicatasNFE" id="gerarDuplicatasNFE"/> Exibir Detalhamento das Duplicatas na NFE</label>
                                                    <label><input type="checkbox" name="enviarCampoXped" id="enviarCampoXped"/> Enviar campo objeto na tag xPed</label>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div id="dados" class="tab-pane fade">
                                <ul class="nav nav-pills">
                                    <li class="active"><a data-toggle="tab" href="#dadosEmitente">Emitente </a></li>
                                    <li><a data-toggle="tab" href="#dadosDestinatarios">Destinatários </a></li>
                                    <li><a data-toggle="tab" href="#dadosObservacao">Observação </a></li>
                                    <li><a data-toggle="tab" href="#dadosDocumentos">Documentos e Referencias </a></li>
                                    <li><a data-toggle="tab" href="#dadosCartaCorrecao">Carta de Correção </a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="dadosEmitente" class="tab-pane fade in active">
                                        <div class="row form-group">
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[9] ?></label>
                                                <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[9]?>" id="<?=$this->getCamposInputs()[9]?>" readonly />
                                            </div>
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[10] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[10]?>" id="<?=$this->getCamposInputs()[10]?>" readonly/>
                                            </div>
                                            <div class="col-sm-5">
                                                <label><?= $this->getCamposLabels()[11] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[11]?>" id="<?=$this->getCamposInputs()[11]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[12] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[12]?>" id="<?=$this->getCamposInputs()[12]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[13] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[13]?>" id="<?=$this->getCamposInputs()[13]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[14] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[14]?>" id="<?=$this->getCamposInputs()[14]?>"  readonly/>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[15] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[15]?>" id="<?=$this->getCamposInputs()[15]?>" readonly />
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[16] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[16]?>" id="<?=$this->getCamposInputs()[16]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[17] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[17]?>" id="<?=$this->getCamposInputs()[17]?>"  readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[18] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[18]?>" id="<?=$this->getCamposInputs()[18]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[19] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[19]?>" id="<?=$this->getCamposInputs()[19]?>" readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[20] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[20]?>" id="<?=$this->getCamposInputs()[20]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[21] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[21]?>" id="<?=$this->getCamposInputs()[21]?>"  readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[22] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[22]?>" id="<?=$this->getCamposInputs()[22]?>" readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[23] ?></label>
                                                 <input type="date" class="form-control input-sm" name="<?=$this->getCamposInputs()[23]?>" id="<?=$this->getCamposInputs()[23]?>" />
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[24] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[24]?>" id="<?=$this->getCamposInputs()[24]?>"/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[25] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[25]?>" id="<?=$this->getCamposInputs()[25]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[26] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[26]?>" id="<?=$this->getCamposInputs()[26]?>" readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[27] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[27]?>" id="<?=$this->getCamposInputs()[27]?>" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dadosDestinatarios" class="tab-pane">
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[9] ?></label>
                                                <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[9]?>" id="<?=$this->getCamposInputs()[9]?>" readonly />
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[28] ?></label>
                                                <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[28]?>" id="<?=$this->getCamposInputs()[28]?>" readonly />
                                            </div>
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[10] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[10]?>" id="<?=$this->getCamposInputs()[10]?>" readonly/>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[11] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[11]?>" id="<?=$this->getCamposInputs()[11]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[12] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[12]?>" id="<?=$this->getCamposInputs()[12]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[13] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[13]?>" id="<?=$this->getCamposInputs()[13]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[14] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[14]?>" id="<?=$this->getCamposInputs()[14]?>"  readonly/>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[15] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[15]?>" id="<?=$this->getCamposInputs()[15]?>" readonly />
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[16] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[16]?>" id="<?=$this->getCamposInputs()[16]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-4">
                                                <label><?= $this->getCamposLabels()[17] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[17]?>" id="<?=$this->getCamposInputs()[17]?>"  readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[18] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[18]?>" id="<?=$this->getCamposInputs()[18]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[19] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[19]?>" id="<?=$this->getCamposInputs()[19]?>" readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[20] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[20]?>" id="<?=$this->getCamposInputs()[20]?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[21] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[21]?>" id="<?=$this->getCamposInputs()[21]?>"  readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[29] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[29]?>" id="<?=$this->getCamposInputs()[29]?>" readonly/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label><?= $this->getCamposLabels()[30] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[30]?>" id="<?=$this->getCamposInputs()[30]?>" readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[31] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[31]?>" id="<?=$this->getCamposInputs()[31]?>" readonly/>
                                            </div>
                                            <div class="col-sm-3">
                                                <label><?= $this->getCamposLabels()[32] ?></label>
                                                 <input type="text" class="form-control input-sm" name="<?=$this->getCamposInputs()[32]?>" id="<?=$this->getCamposInputs()[32]?>" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dadosObservacao" class="tab-pane">
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                  <label><?= $this->getCamposLabels()[33] ?></label>
                                                  <textarea class="form-control" rows="10" cols="20" name="<?=$this->getCamposInputs()[33]?>" id="<?=$this->getCamposInputs()[33]?>" style="max-width:100%;"></textarea>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div id="dadosDocumentos" class="tab-pane">
                                        
                                    </div>
                                    <div id="dadosCartaCorrecao" class="tab-pane">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- RODAPE DA MODAL -->
                    <div class="modal-footer">
                       <button type="button" onclick="location.reload()" class="btn btn-default" data-dismiss="modal" >Fechar</button>
                       <button type="submit" id="EnviarCertificadoDigital" class="btn btn-primary">Salvar</button>
                    </div>
                </div> 
            </div>
        </div>
</form>  

<!-- RESPONSAVEL POR DEFINIR A acao -->
<input type="hidden" id='acao'/> 
<!-- RESPONSAVEL POR RECEBER O ID --> 
<input type="hidden" id='id' /> 
<!-- MODAL DA IMPRESSAO -->
<span class="modal_impressao"  id="modal_impressao" title="Tipos de Relatorios"></span>