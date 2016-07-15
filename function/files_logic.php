<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function create_newfile($uniqueid, $dirfile, $urlfile, $filename, $table, $tableid){     
       include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->createnewfile($uniqueid, $dirfile, $urlfile, $filename, $table, $tableid, is_login());
}

function get_files($table, $tableid){
        include_once 'backend/backend.php';
        $backend = new backend();
        return $backend->getfiles($table, $tableid);
}