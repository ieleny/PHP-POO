<?php
include_once __DIR__."../../../dados/sql/GenericDAOSQL.php";
include_once __DIR__."../../Vo/NfeNfceVO.php";
include_once __DIR__."/Session.php";

class NfeNfceSession extends Session{
    function __construct(){
        parent::__construct(new GenericDAOSQL("danfe"));
        parent::setClassVO("NfeNfceVO");
    }
}
