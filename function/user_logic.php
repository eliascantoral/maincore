<?php

    function get_userdata($data){
        if(isset($_SESSION[get_variable("prfx")."_".$data])) return $_SESSION[get_variable("prfx")."_".$data];
        return "N/A";
    }
    
    function get_clientlist(){
        $clients = array();
        if(is_login()){
            include_once 'backend/backend.php';
            $backend = new backend();
            $result = $backend->get_clientlist(is_login());
            if($result[0]){
                for($i=0;$i<sizeof($result[1]);$i++){
                    array_push($clients, array($result[1][$i][0],$result[1][$i][1],$result[1][$i][2],$result[1][$i][3]));
                }
            }
        }
        return $clients;
    }
    
    function get_companylist(){
        $company = array();
        if(is_login()){
            include_once 'backend/backend.php';
            $backend = new backend();
            $result = $backend->get_companylist(is_login());
            if($result[0]){
                for($i=0;$i<sizeof($result[1]);$i++){
                    array_push($company, array($result[1][$i][0],$result[1][$i][1],$result[1][$i][2]));
                }
            }
        }
        return $company;
    }
    
    function create_tempcliente($newname, $newemail,$newtel, $newcompany){
        session_start();
        if(is_login()){
            include_once 'backend/backend.php';
            $backend = new backend();
            return $backend->create_tempcliente($newname, $newemail,$newtel, $newcompany, is_login());
        }
        return array(false, "Acceso no valido.");
    }
    
    function user_changepassword($old, $new){
        session_start();
        if(is_login()){
            include_once 'backend/backend.php';
            $backend = new backend();
            return $backend->user_changepassword($old, $new, is_login());
        }
        return array(false, "Acceso no valido.");
    }
?>