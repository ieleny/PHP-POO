<?php
    $metodo = $_POST['acao'];
    $classe = $_POST['classe'];
    $classeSession = $classe."Session";
    if(isset($_POST['form'])){
        $form = $_POST['form'];
        foreach($form as $value){
            $campos[] = $value['name'];
            $atributos[] = $value['value'];
        }
    }
    //Url da sessao
    $urlSession = __DIR__."/../" .$classeSession. ".php";
    require_once($urlSession);
    //Instancia o objeto do tipo
    $objSession = new $classeSession();
    //Seta os campos que foram preenchidos
    $ref = new ReflectionClass($classeSession);
    if($ref->hasMethod('setCampos')){
        $objSession->setCampos((isset($campos)) ? $campos : NULL);
    }
    try{
        if(strpos($metodo, 'delete') !== false){            
            $recno = $_POST['recno'];
            echo $objSession->$metodo($recno);
        }else if($metodo === 'update'){
            $recno = $_POST['recno'];
            echo $objSession->$metodo($recno, $atributos);           
        }else if($metodo === 'create'){
            echo $objSession->$metodo($atributos);
        }else if($metodo === 'retrieveByRecno' || $metodo === 'retrieveToUpdate'){
            $recno = $_POST['recno'];
            try{
                $result = $objSession->retrieveByRecno($recno);
            }catch(Exception $ex){
                $arr = array('erro' => utf8_encode($ex->getMessage()));
                echo json_encode($arr);
                return;
            }
            $linha = $result->fetch_assoc();
            $arr = array();
            foreach($form as $value){
                array_push($arr, $linha[$value['name']]);
            }
            echo json_encode($arr);
        }else{
            echo $objSession->$metodo($_POST['genericParams']);
        }
        $_SESSION['time'] = time();
        $_SESSION['tempo_limite'] = 300;
    } catch (Exception $ex){
        $arr = array('erro' => $ex->getMessage());
        echo json_encode($arr);
    }
    unset($objSession);