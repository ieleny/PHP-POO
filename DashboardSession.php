<?php

include_once __DIR__."../../../dados/sql/DashboardDAOSQL.php";
include_once __DIR__."/../Vo/DashboardVO.php";
include_once __DIR__."/Session.php";

class DashboardSession extends Session{
    
    function __construct(){
        parent::__construct(new DashboardDAOSQL('venda'));
         parent::setClassVO("DashboardVO");
    }
}
