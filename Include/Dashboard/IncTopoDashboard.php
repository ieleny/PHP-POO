<!---->
<!--<p style="text-align:center; font-size:2.0em" id="alertp" hidden >-->
<!--Você não tem nenhuma empresa cadastrada!-->
<!--<br>-->
<!--<a id="alerta" href="MenuInicio.php?Sistema=Empresa" style="color: #dd4b39;" >-->
<!---->
<!--    >>Clique aqui para cadastrar<<-->
<!--</a>-->
<!--</p>-->

<div class="row">

  <div class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Escolha a Empresa </span>
        <span class="info-box-number"><?php $this->loadCombo($this->getCamposInputs()[1], 'empresa', 'descricao', 'id_empresa'); ?></span>
      </div>
    </div>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-cart-plus"></i></span>
          <div class="info-box-content">
            <span class="info-box-text"> Compras Mensal</span>
            <span class="info-box-number">R$ <span id="ComprasMensal"></span></span>
          </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Vendas Di&aacute;rias</span>
          <span class="info-box-number">R$ <span id="VendaDiarias"></span></span>
        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total de Clientes</span>
          <span class="info-box-number" id="TotalClientes"></span>
        </div>
      </div>
    </div>
    
</div>