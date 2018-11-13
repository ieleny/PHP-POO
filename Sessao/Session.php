<?php
include_once __DIR__."../../../dados/sql/GenericDAOSQL.php";
include_once __DIR__."../../../exception/GensysException.php";

abstract class Session{        

    private $genericDAO;
    private $campos;
    private $classVO;

    function __construct($dao){
        $this->genericDAO = $dao;
    }

    function getClassVO() {
        return $this->classVO;
    }

    public function setClassVO($name){
        $this->classVO = $name;
    }

    public function getGenericDAO(){
        return $this->genericDAO;
    }

    public function create($atributos){
        try{
            return $this->genericDAO->save($this->campos, $atributos);
        } catch (Exception $ex) {
            return utf8_encode($ex->getMessage());
        } catch(GensysException $ex){
            return utf8_encode($ex->getMessage());
        }
    }

    public function update($recno, $atributos){
        try{
            return $this->genericDAO->update($recno, $this->campos, $atributos);                
        } catch (Exception $ex) {
            return utf8_encode($ex->getMessage());
        } catch(GensysException $ex){
            return utf8_encode($ex->getMessage());
        }
    }

    public function delete($recno){
        try{
            $this->genericDAO->delete($recno);                
        } catch (Exception $ex) {
            return utf8_encode($ex->getMessage());
        } catch(GensysException $ex){
            return utf8_encode($ex->getMessage());
        }
    }

    public function addCampo($value){
        array_push($this->campos, $value);
    }

    public function setCampos($campos){
        $this->campos = $campos;
    }

    public function getCampos(){
        return $this->campos;
    }

    public function registroTotal(){
        return $this->genericDAO->numRows();            
    }

    public function registroTotalFiltro($filtro){
        return $this->genericDAO->numRowsFiltro($this->campos, $filtro, $this->campos[0]);
    }

    public function retrieveAll(){
        try{
            return $this->genericDAO->retrieveAll($this->campos[0]);                
        } catch (Exception $ex) {

        }
    }

    public function retrieveByRecno($recno){
        try{
            return $this->genericDAO->retrieveByRecno($recno, $this->campos); 
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function comboBox($tabela, $campo, $value){
        return $this->getGenericDAO()->comboBox($tabela, $campo, $value);                        
    }

    public function retrieveAllLimit($inicio, $itens) {
        $result = $this->getGenericDAO()->retrieveAllLimit($inicio, $itens, $this->campos[0]);
        if(!$result){
            return NULL;
        }
        $arr = array();
        while($linha = $result->fetch_assoc()){
            $class = $this->classVO;
            array_push($arr, $class::createVO($linha));
        }
        return $arr;                                
    }

    public function search($filtro) {
        $result = $this->getGenericDAO()->search($this->getCampos(), $filtro, $this->campos[0]);
        if(!$result){
            return NULL;
        }      
        $arr = array();
        while($linha = $result->fetch_assoc()){
            $class = $this->classVO;
            array_push($arr, $class::createVO($linha));
        }
        return $arr;
    }

    public function searchLimit($filtro, $inicio, $itens) {
        $result = $this->getGenericDAO()->searchLimit($this->getCampos(), $filtro, $inicio, $itens, $this->campos[0]);
        if(!$result){
            return NULL;
        }
        $arr = array();
        while($linha = $result->fetch_assoc()){
            $class = $this->classVO;
            array_push($arr, $class::createVO($linha));
        }
        return $arr;
    }

    public function retrieveFieldValue($field, $idField, $valueId){
        return $this->getGenericDAO()->retrieveFieldValue($field, $idField, $valueId);            
    }
    
    public function getValueOtherTable($tabela, $field, $compare, $comparable){
        return $this->getGenericDAO()->getValueOtherTable($tabela, $field, $compare, $comparable);
    }
    
    public function incrementValor($tabela,$valor,$field,$id_empresa,$field1){
        return $this->getGenericDAO()->incrementValor($tabela,$valor,$field,$id_empresa,$field1);
    }
    
    public function getNumeroMovimento($idempresa, $tipo){
        return $this->getGenericDAO()->getNumeroMovimento($idempresa, $tipo);
    }  
}