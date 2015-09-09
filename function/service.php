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
            case "101":{////CREATE ACTIVITY
                if(isset($_POST['startime']) && isset($_POST['endtime']) && isset($_POST['activitytype']) && isset($_POST['client']) && isset($_POST['description'])){
                    include_once 'logic.php';
                    $sdatepart = explode(" ", $_POST['startime']);
                    $sdatepartdate = explode("/", $sdatepart[0]);
                    $sdateparttime = explode(":", $sdatepart[1]);
                    $edatepart = explode(" ", $_POST['endtime']);
                    $edatepartdate = explode("/", $edatepart[0]);
                    $edateparttime = explode(":", $edatepart[1]);
                    
                    $startime = mktime($sdateparttime[0],$sdateparttime[1],0,$sdatepartdate[1],$sdatepartdate[2],$sdatepartdate[0]);
                    $endtime = mktime($edateparttime[0],$edateparttime[1],0,$edatepartdate[1],$edatepartdate[2],$edatepartdate[0]);
                    
                    $clientid = '0';
                    
                    if (preg_match_all("/(?<=\()(.*?)(?=\))/s", $_POST['client'], $result))
                        for ($i = 1; count($result) > $i; $i++) {
                            $clientid = $result[$i][0];
                        }   
                    if($clientid!='0'){
                        $respuesta = create_activity($startime, $endtime, $_POST['activitytype'], $_POST['description'], $clientid);
                        if($respuesta[0]){
                            echo json_encode(array('r'=>1,'d'=>"Actividad guardada."));
                        }else{
                            echo json_encode(array('r'=>0,'d'=>"No se pudo guardar la actividad."));
                        }
                    }else{
                        echo json_encode(array('r'=>2,'d'=>"Cliente no valido"));
                    } 
                    
                }
                break;
            }
            case "102":{//////CREATE CLIENT                
                if(isset($_POST['newname']) && isset($_POST['newemail']) && isset($_POST['newtel']) && isset($_POST['newcompany'])){                    
                    include_once 'logic.php';
                    $newname = $_POST['newname'];
                    $newemail = $_POST['newemail'];
                    $newtel = $_POST['newtel'];
                    $newcompany = $_POST['newcompany'];
                    
                    $respuesta = create_tempcliente($newname, $newemail,$newtel, $newcompany);
                    if($respuesta[0]){
                        echo json_encode(array('r'=>1,'d'=>$respuesta[1]));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"No se pudo guardar el cliente. ". $respuesta[1]));
                    }
                }
                break;
            }
            case "103":{////////Seek Activity
                if(isset($_POST['startime']) && isset($_POST['endtime']) && isset($_POST['activitytype']) && isset($_POST['client'])){
                    include_once 'logic.php';
                    $sdatepart = explode(" ", $_POST['startime']);
                    $sdatepartdate = explode("/", $sdatepart[0]);
                    $sdateparttime = explode(":", $sdatepart[1]);
                    $edatepart = explode(" ", $_POST['endtime']);
                    $edatepartdate = explode("/", $edatepart[0]);
                    $edateparttime = explode(":", $edatepart[1]);
                    
                    $startime = mktime($sdateparttime[0],$sdateparttime[1],0,$sdatepartdate[1],$sdatepartdate[2],$sdatepartdate[0]);
                    $endtime = mktime($edateparttime[0],$edateparttime[1],0,$edatepartdate[1],$edatepartdate[2],$edatepartdate[0]);
                    
                    $clientid = '0';
                    
                    if (preg_match_all("/(?<=\()(.*?)(?=\))/s", $_POST['client'], $result))
                        for ($i = 1; count($result) > $i; $i++) {
                            $clientid = $result[$i][0];
                        } 
                        
                    
                }
                break;            
            }
        }
    }

    
?>
