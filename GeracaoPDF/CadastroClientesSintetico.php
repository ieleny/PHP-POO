<?php

    date_default_timezone_set('UTC');
    include_once '../Sessao/ClienteSession.php';
    require '../../libs/pdf-php-0.12.45/src/CezTableImage.php';

    $pdf = new CezTableImage('a4');
    $Cliente = new ClienteSession();
    $clientes = $Cliente->CadastroClientesSintetico();
    
    //top
    $pdf->setFontFamily('Times-Roman','b');
    $data = array(
        array('<C:showimage:../../Imagens/bg_logo_Topo.png 90>' => '','  Cadastro de Clientes Sintético' => 'Configure Nome da Sua Empresa'),
    );
    
    $confTable = array(
            'width' => 550, 
            'xPos' => 'right',
            'xOrientation' => 'left',
            'gridlines' => 0,
            'fontSize' => 15,
            'evenColumnsMin' => 1,
    );
    
    $pdf->ezTable($data, '', '',$confTable);
    
    $pdf->ezText('');
    
    //Conteudo
    $pdf->selectFont('Helvetica');
    $cols = array('Nome Fantasia' => 'Nome Fantasia', 'Cidade' => 'Cidade', 'UF' => 'UF','Apelido' => 'Apelido','Fone Comercial' =>'Fone Comercial','Fone Res'=>'Fone Res','Email'=>'Email');
    $conf = array(
        'evenColumns' => 2,
        'evenColumnsMin' => 1,
        'maxWidth' => 550,
        'shadeHeadingCol' => array(0.6, 0.6, 0.5),
        'shaded' => 1,
        'shadeCol' => array(0.95, 0.95, 0.95),
        'shadeCol2' => array(0.85, 0.85, 0.85),
        'xPos' => 'right',
        'xOrientation' => 'left',
        'gridlines' => 6,
    );
 
    $pdf->ezTable($clientes, $cols, '', $conf);

    if (isset($_GET['d']) && $_GET['d']) {
        echo $pdf->ezOutput(true);
    } else {
        $pdf->ezStream();
    }

?>
