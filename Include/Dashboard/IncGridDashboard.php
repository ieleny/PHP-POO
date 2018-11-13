<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
                <h3 class="box-title">Relatório Movimentação Mensal</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Relatório Diário</a></li>
                          <li><a href="#">Relatório Mensal</a></li>
                          <li><a href="#">Relatório Anual</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Relatório de Vendas por grupo</a></li>
                        </ul>
                  </div>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
        </div>
 
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                      <strong>Vendas: <?= '1 Jan, 2018 - '.strftime("%d %B,%Y"); ?></strong>
                  </p>
                  <div class="chart">
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                </div>

                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Financeiro Mensal</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Pagar</span>
                    <span class="progress-number">R$  <span id="MensalPagar"></span></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                    </div>
                  </div>

                  <div class="progress-group">
                    <span class="progress-text">Pagos</span>
                    <span class="progress-number">R$  <span id="MensalPagos"></span></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 100%"></div>
                    </div>
                  </div>

                  <div class="progress-group">
                    <span class="progress-text">Receber</span>
                    <span class="progress-number">R$  <span id="MensalReceber"></span></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 100%"></div>
                    </div>
                  </div>

                  <div class="progress-group">
                    <span class="progress-text">Recebido</span>
                    <span class="progress-number">R$  <span id="MensalRecebido"></span></span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 100%"></div>
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
          <h3 class="box-title">Ultimos Produtos Adicionados</h3>
        </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
              <li class="item" id="itemEstoque"></li>
            </ul>
            <div class="box-footer text-center">
             <a href="./estoque" class="uppercase btn btn-sm btn-info btn-flat">Ver todos os Produtos</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Últimas Vendas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Número do Documento</th>
                    <th>Nome Cliente</th>
                    <th>Modelo da Nota</th>
                    <th>Valor</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php 
                          $VOs = $this->getCamposAtributos();
                          for($x = 0; $x < count($VOs);$x++){
                              $VOs[$x]->printAtributos();
                          }
                      ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- But�es -->
            <div class="box-footer clearfix">
              <a href="./vendaitens?registroID=&acao=create" class="btn btn-sm btn-info btn-flat pull-left">Adicionar nova Venda</a>
              <a href="./venda" class="btn btn-sm btn-default btn-flat pull-right">Ver todas as Vendas</a>
            </div>
            
        </div>
    </div>
</div>

