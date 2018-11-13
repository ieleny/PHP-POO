<?php

include_once __DIR__.'/IValueObjectHTML.php';

class NfeNfceVO implements IValueObjectHTML{    
    
    private $recno;
    private $empresa;
    private $nfcnfe;
    private $numero;
    private $notafiscal;
    private $cliente;
    private $datamov;
    private $emissao;
    private $status;
    private $danfe;
       
    public function __construct($recno, $empresa, $nfcnfe,$numero,$notafiscal,$cliente,$datamov,$emissao,$status,$danfe) {
        $this->recno = $recno;
        $this->empresa = $empresa;
        $this->nfcnfe = $nfcnfe;
        $this->numero = $numero;
        $this->notafiscal = $notafiscal;
        $this->cliente = $cliente;
        $this->datamov = $datamov;
        $this->emissao = $emissao;
        $this->status = $status;
        $this->danfe = $danfe;
    }
    public function getRecno() {
        return $this->recno;  
    }

    public function printAtributos() {
        echo '<td>'.$this->empresa.'</td>';        
        echo '<td>'.$this->nfcnfe.'</td>';                      
        echo '<td>'.$this->numero.'</td>';                      
        echo '<td>'.$this->notafiscal.'</td>';                      
        echo '<td>'.$this->cliente.'</td>';                      
        echo '<td>'.$this->datamov.'</td>';                      
        echo '<td>'.$this->emissao.'</td>';                      
        echo '<td>'.$this->status.'</td>';                      
        echo '<td>'.$this->danfe.'</td>';                      
    }

    public static function createVO($linha) {
        return new NfeNfceVO($linha['recno'], $linha['empresa'], $linha['tiponfcnfe'],$linha['numero'],$linha['notafiscal'],$linha['cliente'],$linha['datahora'],$linha['datahora'],$linha['autorizacao'],$linha['danfe']);
    }
    
    //'empresa','tiponfcnfe','numero','notafiscal','cliente','datahora','datahora','autorizacao','danfe'
}
