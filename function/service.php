<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    print_r($_POST);
    if(isset($_POST["action"])){
        switch ($_POST["action"]){
            case "0":{//Login
                if(isset($_POST["user"]) && isset($_POST["pass"])){
                    include_once 'logic.php';
                    $result = try_login($_POST["user"], $_POST["pass"]);
                    if($result){
                        echo json_encode(array('r'=>1,'d'=>$result));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"Usuario o contraseña incorrectos."));
                        
                    }
                }
                break;}
            case "1":{////Change pass
                if(isset($_POST["old"]) && isset($_POST["new"])){
                    include_once 'logic.php';
                    $result = user_changepassword($_POST['old'], $_POST['new']);
                    if($result[0]){
                        echo json_encode(array('r'=>1,'d'=>$result[1]));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"No se pudo modificar la contraseña. ". $result[1]));
                    }
                }
                break;}
        }
    }

    
?>
