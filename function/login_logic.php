<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function try_login($user, $pass){
    include_once 'backend/backend.php';
    $backend = new backend();
    $return =  $backend->trylogin($user, $pass);
    if($return[0]){
        session_start();
        $_SESSION[get_variable("prfx")."_userid"] = $return[1][0];
        $_SESSION[get_variable("prfx")."_fname"] = $return[1][1];
        $_SESSION[get_variable("prfx")."_username"] = $user;
        return true;
    }
    return false;
}
