<?php

include_once __DIR__.'/IValueObjectHTML.php';

class DashboardVO implements IValueObjectHTML{
    
    private $recno;
    private $numero;
    private $cliente;
    private $modelo;
    private $total;
    
    public function __construct($recno,$numero,$cliente,$modelo,$total) {
        $this->recno = $recno;
        $this->numero = $numero;
        $this->cliente = $cliente;
        $this->modelo = $modelo;
        $this->total = $total;
    }
    
    public function getRecno() {
        return $this->recno;
    }
    
    public function printAtributos() {
        echo '<tr>';        
            echo '<td><a href="index.php/venda?filtro='.$this->numero.'">'.$this->numero.'</a></td>';
            echo '<td>'.$this->cliente.'</td>';
            echo '<td><span>'.$this->modelo.'</span></td>';
            echo '<td><div>'.$this->total.'</div></td>';   
        echo '</tr>';                 
    }

    public static function createVO($linha) {
        return new DashboardVO($linha['recno'], $linha['numero'],$linha['id_cliente'],$linha['modelo'],$linha['total']);
    }

}
