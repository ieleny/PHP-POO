<?php
    include_once __DIR__."../../Modulos/WebSession/VendedorWebSession.php";    
    $vendedor = new VendedorWebSession($_SESSION['id_vendedor']); // par�metro: id do usu�rio logado
?>
    <style>
        body { 
            padding-right: 0px !important; 
        }
        #nav-compra li {
            float: left;
            text-align: center;
            cursor: pointer;
        }
        #nav-compra a {
            padding: 10px 12px;
        }
        #voltar a {
            color: #c00;
        }       
        #cliente a {
            color: #eb9316;
        }       
        #produto a {
            color: #149bdf;
        }       
        #pagamento a {
            color: #28a745;
        }
        #configurar a {
            color: #000;
        }
        #incluir-cod {
            margin-top: 15px;
        }
        #incluir-cod button {
            color: #fff;
            background-color: #149bdf;
        }
        #pesquisar-prod {
            margin: 15px 0px;
        }
    </style>
    
<div class="container-fluid">
    <!-- TOPO -->
    <!-- Nav tabs -->
    <div class="tabs-wrapper"> 
        <ul id="nav-compra" class="nav navbar-nav">
            <li id="pagamento" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><i class="fa fa-arrow-circle-right fa-2x" aria-hidden="true"></i><br>Gerar Pr&eacute;via</a>
            </li>
            <li id="cliente" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><img src="../../Imagens/bloggif_5af2e94dbcf46.png" width=""/><br>Gerar NF-E</a>
            </li>
            <li id="cliente" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><img src="../../Imagens/bloggif_5af2ea418be1a.png" width=""/><br>Gerar NFC-E</a>
            </li>
<!--            <li id="produto" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i><br>Enviar E-mail</a>
            </li>-->
            <li id="produto" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><img src="../../Imagens/bloggif_5af35ea53c282.png" width=""/><br>Gerar XML</a>
            </li>
<!--            <li id="configurar" class="nav-item">
                <a class="nav-link" href="?Sistema=Configurar"><i class="fa fa-cog fa-2x" aria-hidden="true"></i><br>Configurar</a>
            </li>-->
            <li id="configurar" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalConfigurar"><i class="fa fa-cog fa-2x" aria-hidden="true"></i><br>Configurar</a>
            </li>
            <li id="pagamento" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><i class="fa fa-file-o fa-2x" aria-hidden="true"></i><br>Carta de Corre&ccedil;&atilde;o</a>
            </li>
<!--            <li id="pagamento" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><i class="fa fa-dollar fa-2x" aria-hidden="true"></i><br>Complementar</a>
            </li>-->
<!--            <li id="pagamento" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><i class="fa fa-dollar fa-2x" aria-hidden="true"></i><br>Inutilizar</a>
            </li>-->
            <li id="produto" class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#ModalDesenvolvimento"><i class="fa fa-search fa-2x" aria-hidden="true"></i><br>Filtro</a>
            </li>
        </ul>
    </div>
</div>


