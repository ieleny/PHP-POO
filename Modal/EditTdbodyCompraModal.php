<!-- Modal -->
 <div id="EditTdbodyCompraModal" class="modal fade" role="dialog" data-backdrop="static">
     <div class="modal-dialog modal-lg">
     <!-- Modal content-->
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">Editar</h4>
         </div>
         <div class="modal-body">
             <!-- Linha 1 -->
             <div class="row form-group"> 
                 <div class="col-md-6">
                     <label>CNPJ</label>
                     <input type="text" class="btn btn-default btn-block" name="cnpjRelacionamento" id="cnpjRelacionamento" disabled />
                 </div>
                 <div class="col-md-6">
                     <label>Código XML</label>
                     <input type="text" class="btn btn-default btn-block" name="CodigoXml" id="CodigoXml" disabled />
                 </div>
             </div>  

             <div class="row form-group">
                 <div class="col-md-12">
                     <label>Desc. Produto Fornecedor</label>
                     <input type="text" class="btn btn-default btn-block" name="DescProdutoFornecedor" id="DescProdutoFornecedor" disabled/>
                 </div>
             </div>

             <div class="row form-group">
                 <div class="col-md-3">
                     <label>CST</label>
                     <input type="text" class="btn btn-default btn-block" name="cst" id="cst" autofocus="true"/>
                 </div>
                 <div class="col-md-3">
                     <label>Natureza</label>
                     <input type="text" class="btn btn-default btn-block" name="natureza" id="natureza" />
                 </div>
                 <div class="col-md-3">
                     <label>NCM</label>
                     <input type="text" class="btn btn-default btn-block" name="ncm" id="ncm" />
                 </div>
                 <div class="col-md-3">
                     <label>Código Interno</label>
                     <div id="ComboInterno"></div>
                 </div>
             </div>

             <div class="row form-group">
                 <div class="col-md-4">
                     <label>Descrição</label>
                     <input type="text" class="btn btn-default btn-block" name="descricao" id="descricao" disabled/>
                 </div>
                 <div class="col-md-4">
                     <label>Unidade</label>
                    <input type="text" class="btn btn-default btn-block" name="unidade" id="unidade" />
                 </div>
                 <div class="col-md-4">
                     <label>Qtde Relacionada</label>
                    <input type="text" class="btn btn-default btn-block" name="qtderelacionada" id="qtderelacionada" />
                 </div>
             </div>

         </div>
         <div class="modal-footer">     
             <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
             <button id="btn-edit-prod-rel" type="submit" class="btn btn-primary" data-dismiss="modal">Editar</button>
         </div>
     </div>
   </div>
 </div>
    



