<?php

?>
<!-- Modal de alerta -->
<div class="modal fade" id="importItemModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="">Atenção!</h4>
            </div>
            <div class="modal-body">
              <p>Deseja realmente importar todos os itens? Clique em IMPORTAR para continuar ou em CANCELAR para desistir da ação.</p>
              <p>Obs: Todos itens importados são salvos automaticamente.</p>
            </div>
            <div class="modal-footer">            
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-warning" onclick="includeAllItems(); $('#importItemModal').modal('hide');">IMPORTAR</button>
            </div>
        </div>
    </div>
</div>

