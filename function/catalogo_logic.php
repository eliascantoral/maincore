<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function get_catalogolist($catalogo){
    if(is_login()){
        include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->get_catalogolist($catalogo);
    }
}
function get_catalogooption($catalogo, $id){	
        include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->get_catalogooption($catalogo, $id);  
}
function get_catalogovalue($catalogo, $id){
    if(is_login()){
        include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->get_catalogovalue($catalogo, $id);
    }
}
function add_catalogovalue($catalogo, $name, $description, $atributos){
	session_start();
	if(is_login()){
		include_once 'backend/backend.php';
		$backend = new backend();
		return $backend->add_newcatalogovalue($catalogo, $name, $description, is_login(), $atributos);
	}
}

function update_catalogovalue($catalogo, $name, $description, $id, $atributos){	
	session_start();
	if(is_login()){
		include_once 'backend/backend.php';
		$backend = new backend();		
		return $backend->update_catalogovalue($catalogo, $name, $description, $id, is_login(), $atributos);
	}
}

function delete_catalogooption($catalogo, $id){
	session_start();
	if(is_login()){
		include_once 'backend/backend.php';
		$backend = new backend();
		return $backend->delete_catalogooption($catalogo, $id, is_login());
	}
}

function get_user_relation($catalogo, $userid){
    include_once 'backend/backend.php';
    $backend = new backend();
    $relationship =  $backend->get_user_relation($userid,"asistenciatipo");
    $catalogolist = array();
    for($i=0;$i<sizeof($relationship[1]);$i++){
        $option = get_catalogooption($catalogo, $relationship[1][$i]);
        array_push($catalogolist, $option[1][0]);
    }
    return array(true, $catalogolist);
}