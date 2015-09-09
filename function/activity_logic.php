<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_activitytype(){
    $types = array();
    if(is_login()){
        include_once 'backend/backend.php';
        $backend = new backend();
        $return = $backend->get_activitytype(is_login());        
        if($return[0]){
            for($i=0;$i<sizeof($return[1]);$i++){
                array_push($types, array($return[1][$i][0],$return[1][$i][1]));
            }
        }
    }
    return $types;
}

function create_activity($stime, $etime, $type, $desc, $client){
    session_start();
    if(is_login()){
        include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->create_activity($stime, $etime, $type, $desc, $client, is_login());
    }
    return array(false, "Acceso no valido.");
}

function seek_activity($stime, $etime, $type, $client){
    session_start();
    if(is_login()){
        include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->seek_activity($stime, $etime, $type, $client, is_login());
    }
    return array(false, "Acceso no valido.");
}