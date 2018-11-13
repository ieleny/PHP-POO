<?php
include_once __DIR__.'../../dados/conexao/Inc_Con.php';
include_once __DIR__ .'/../exception/GensysException.php';

class MySQLConnection extends Inc_Con {
    
    //GET CONEXAO GERAL
    public function getConexao(){
        return new mysqli($this->getGeniusServer(),$_SESSION["user"], $_SESSION["pass"], $_SESSION["bd"]);
    }
    
    //GET CONEXAO LOGIN
    public function getConexaoLM(){
        return new mysqli($this->getServidorlm(), $this->getUsuariolm() , $this->getSenhalm(), $this->getBancolm());
    }
    
    //FUNÇÃO PARA FECHAR A CONEXOES DO MYSQL
    public function FecharConexao($Link){
        mysqli_close($Link);
    }
    
    //VERIFICA SE A CONEXAO FOI BEM SUCEDIDA
    public function VerificaConexaoLogin(){
        if(!mysqli_connect($this->getServidorlm(), $this->getUsuariolm(), $this->getSenhalm(), $this->getBancolm())){
            $msg = 'Desculpe, nosso servidor está fora do ar! Ligue (71)3503-1982 e reporte esta situação.';
            throw new GensysException($msg);
        }
       
    }        
       
}   