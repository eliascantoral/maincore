<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    print_r($_POST);
    if(isset($_POST["action"])){
        switch ($_POST["action"]){
            case "0":{//Login
                if(isset($_POST["user"]) && isset($_POST["pass"])){
                    include_once('logic.php');
                    $result = try_login($_POST["user"], $_POST["pass"]);
                    if($result){
                        echo json_encode(array('r'=>1,'d'=>$result));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"Usuario o contraseña incorrectos."));
                        
                    }
                }
                break;}
            case "101":{
                if(isset($_POST["question"])){
                    include_once 'logic.php';
                    $questionid = $_POST["question"];
                    get_questionblock($questionid, true);
                }
                break;}
            case "102":{
                include_once 'logic.php';
                session_start();
                if(isset($_POST["course"]) && isset($_POST["status"])){                    
                    if(change_coursevisual($_POST["course"], $_POST["status"])){
                        echo json_encode(array('r'=>1,'d'=>"ok"));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"Ocurrio un error, por favor intente de nuevo."));
                    }
                }
                break;}
            case "200":{
                session_start();
                include_once 'logic.php';
                kill_sessionkey();
                break;}
            case "201":{
                if(isset($_POST["name"]) && isset($_POST["carnet"]) && isset($_POST["course"])){                                     
                    session_start();
                    include_once 'logic.php';
                    $name = $_POST["name"];
                    $carnet = $_POST["carnet"];
                    $course = $_POST["course"];                    
                   echo "-->".starttest($name, $carnet, $course)."<--";    
                    
                }
                break;}
            case "202":{
                    include 'logic.php';
                    $error = false;
                    $answerlist = array();
                    $resultlist = array();
                    if(isset($_POST['questionid']) && isset($_POST['totanswer']) && isset($_POST["test"])){
                        $test = $_POST['test'];
                        $questionid = $_POST['questionid'];
                        $total_anwer = $_POST['totanswer'];
                        $question_attempt = save_questionattempt($test, $questionid);
                        for($i=0;$i<$total_anwer;$i++){                            
                            $answerid = "";
                            $total_answerpart = 0;
                            if(isset($_POST["answerid_".$i])){$answerid = $_POST["answerid_".$i];}else{$error = true;}
                            if(isset($_POST["totanswerpart_".$i])){$total_answerpart = $_POST["totanswerpart_".$i];}else{$error = true;}
                            for($e=0;$e<$total_answerpart;$e++){
                                $answerpartvalue = "";
                                $answerpartid = "";
                                if(isset($_POST["value_".$i."_".$e])&& isset($_POST["answer_".$i."_".$e])){$answerpartvalue = $_POST["answer_".$i."_".$e];$answerpartid = $_POST["value_".$i."_".$e];}else{$error = true;}
                                if(!$error){
                                    $correct = checkanswer(array($questionid,$answerid,$answerpartid,$answerpartvalue));
                                    $useranswer = array($questionid,$answerid,$answerpartid,$answerpartvalue,$correct);
                                    save_answerattempt($test, $question_attempt, $useranswer);
                                    array_push($answerlist, $useranswer);
                                    array_push($resultlist, $correct);
                                }
                            }
                        }
                    }
                    $finalresult=1;
                    for($i=0;$i<sizeof($resultlist);$i++){
                        if($resultlist[$i]!=1) $finalresult = 0;
                    }
                    update_questionattempt($question_attempt,$finalresult);
                    $totalquestionattempt = get_totalquestionattempts($test, $questionid);
                    echo json_encode(array('r'=>$finalresult,'t'=>$totalquestionattempt,'d'=>json_encode($resultlist)));
                break;}
        }
        
    }

    
?>
