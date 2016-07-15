<?php
	/**************************************************************************************************************************/	
	function init_vars(){
		session_start();
                $_SESSION[get_variable("prfx")."lang"] = "es";
	}
	function get_variable($var){
		switch($var){
                        case "sitename": return "M-ERP";
                        case "prfx": return "merp";
			case "home": return "http://localhost/myapp/merp/";
			case "ajax": return "function/service.php";
                        case "content": return "http://localhost/myapp/merp";
			default:{return "";}
		}
	}
        function startsession(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
	function is_login(){
		$user = false;
		if(isset($_SESSION[get_variable("prfx")."_userid"])){$user = $_SESSION[get_variable("prfx")."_userid"];}
		return $user;
	}
	function create_log($object_id){
		$key = isset($_SESSION[get_variable("prfx")."_key"])?$_SESSION[get_variable("prfx")."_key"]:create_sessionkey();
		$user = false;
		$rate = 0;
		include_once("backend/backend.php");
		$backend = new backend();	
		//test_data();
		return $backend->create_log($object_id, $key, $user, $rate);
	}
	
	function create_sessionkey(){
		$_SESSION[get_variable("prfx")."_key"]= time() . random_text();                
	}
	function kill_sessionkey(){		
		$_SESSION[get_variable("prfx")."_key"] = false;
	}
	function get_sessionkey(){
		if(!isset($_SESSION[get_variable("prfx")."_key"])  || !$_SESSION[get_variable("prfx")."_key"]){
			create_sessionkey();
		}
		return $_SESSION[get_variable("prfx")."_key"];	
	}
        function set_sessionkey($key){
            $_SESSION[get_variable("prfx")."_key"] = $key;
        }
	function random_text($size = 10){
		$text = "";
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_";
		for($i=0;$i<$size;$i++){
			$text.=$characters[mt_rand(0, (strlen($characters)-1))];			
		}
		return $text;
	}
	function array_contain($where, $what, $pos=false){		
		for($i=0;$i<sizeof($where);$i++){
			if($pos===false){
				if($where[$i]==$what) return $i+1;			
			}else{
				if($where[$i][$pos]==$what) return $i+1;
			}			
		}
		return false;
	}
        function print_array($array){
            echo "<pre>";
            print_r($array);
            echo "</pre>";
            
        }
        function out($text){
            echo utf8_encode($text);
        }
        function minimizer_string($cadena){
                $conv = array("á"=>"a","é"=>"e","í"=>"i","ó"=>"o","ú"=>"u","Á"=>"A","É"=>"E","Í"=>"I","Ó"=>"O","Ú"=>"U");
                $tofind = "áéíóúÁÉÍÓÚ";
                $replac = "aeiouAEIOU";
                return(strtr($cadena,$conv));
        }
        function resumetext($text, $charlength = 50) {	
                $excerpt = $text;
                $charlength++;
                $return = "";
                if ( mb_strlen( $excerpt ) > $charlength ) {
                        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
                        $exwords = explode( ' ', $subex );
                        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
                        if ( $excut < 0 ) {
                                $return.= mb_substr( $subex, 0, $excut );
                        } else {
                                $return.= $subex;
                        }
                        $return.= '[...]';
                } else {
                        $return.= $excerpt;
                }
                return $return;
        }        
/********************************************************************************************************************/	
        require_once 'login_logic.php';
        require_once 'user_logic.php';
        require_once 'catalogo_logic.php';
        require_once 'mail_logic.php';
        require_once 'files_logic.php';
?>