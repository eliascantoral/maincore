<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    if(isset($_GET["action"])){
        switch ($_GET["action"]){
            case "clnt":{///Clientes
                    include_once 'logic.php';
                    session_start();
                    if(is_login()){
                        $clients = array();
                        $result = get_clientlist();
                        //var_dump($result);
                        if($result){
                            for($i=0;$i<sizeof($result);$i++){
                                array_push($clients, "(".$result[$i][0].") ".$result[$i][1]." - ".$result[$i][3]);
                            }
                        }
                        echo json_encode($clients);
                    }
                break;}
        }
    }
