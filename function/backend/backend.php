<?php 
	include_once("general.php");
	
	class backend{
			private function start_connect(){
						$con=mysqli_connect(DB_HOST2,DB_USER2,DB_PASSWORD2,DB_NAME2);						
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						return $con;				
				}

			private function close_connect($con){
						mysqli_close($con);					
				}
			private function encripter($key){
				return md5($key);
			}
                        private function makequery($query){
                            $status = false;
                            $return = "No se pudo realizar la conexión al server de base de datos.";                            
                            $link = $this->start_connect();
                            if($link){
                                $result = mysqli_query($link, $query);
                                if($result){
                                    $status = true;
                                    $return = $result;                                    
                                }else{
                                    $return = "No se pudor realizar la consulta.";
                                }
                                $this->close_connect($link);
                            }                            
                            return array($status, $return);
                        }    
                        private function makelog($user, $action, $description){
                            $time = time();
                            $query = "INSERT INTO `myactivity`.`log` (`id`, `user`, `time`, `action`, `description`) VALUES (NULL, '".$user."', '".$time."', '".$action."', '".$description."');";
                            
                            $result = $this->makequery($query);
                            if($result[0])
                                return true;
                            return false;
                        }
                        private function existdata($data, $field){
                            $query = "SELECT `id` FROM `user` WHERE `".$field."`='".$data."'";
                            $result = $this->makequery($query);
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    return true;
                                }
                            }
                            return false;
                        }                        
                        
 /********************************************************************************************************/
 /*********************************************************************************************************/
                        function trylogin($user, $pass){
                            $return = array(false, "Error 101");
                            $query = "SELECT `id`,`fname` FROM `user` WHERE `user`='".$user."' AND `password` = '".$this->encripter($pass)."';";
                            //echo $query;
                            $this->makelog($user, "try login", "Usuario ".$user." intenta ingresar al sistema");
                            $result = $this->makequery($query);            
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    $return = array(true, array($row['id'],$row['fname']));
                                    $this->makelog($user, "login", "Usuario '".$user."' ingreso al sistema");
                                }
                            }else{
                                $return = $result;
                            }
                            return $return;
                        }
                        function tryloginfb($userid){

                        }
                        function user_changepassword($old, $new, $user){
                            $return = array(false, "Error 101.");
                            $query = "SELECT `id` FROM `user` WHERE `id`='".$user."' AND `password`='".$this->encripter($old)."';";
                            
                            $result = $this->makequery($query);
                            if($result[0]){
                                $return = array(false, "Contraseña anterior incorrecta.");
                                while($row = mysqli_fetch_array($result[1])){                                
                                    $query = "UPDATE `user` SET `password` = '".$this->encripter($new)."' WHERE `id` = '".$user."';";
                                    $result2 = $this->makequery($query);
                                    if($result2[0]){
                                        $this->makelog($user, "2", "El usuario cambio su password");
                                        $return = array(true, "Contraseña modificada.");
                                    }else{
                                        $return = array(false, "No se pudo modificar la contraseña.");
                                    }                                    
                                }
                            }
                            return $return;
                        }            
/*********************************************************************************************************/
                        function get_catalogolist($catalogo){
                            $query = "SELECT * FROM `catalogo_".$catalogo."` WHERE `status` = 1";
                            
                            $result = $this->makequery($query);
                            $list = array();
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    array_push($list, $row);
                                }
                                return array(true, $list);
                            }
                            return array(false, $list);
                        }
			function get_catalogooption($catalogo, $id){
                            $query = "SELECT * FROM `catalogo_".$catalogo."` WHERE `status` = 1 AND `id`='".$id."'";
                            $result = $this->makequery($query);
                            $list = array();
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    array_push($list, $row);
                                }
                                return array(true, $list);
                            }
                            return array(false, $list);
						}
                        function get_catalogovalue($catalogo, $id){
                            $query = "SELECT `name` FROM `catalogo_".$catalogo."` WHERE `id`='".$id."'";
                            $result = $this->makequery($query);
                            $name = "";
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    $name = $row["name"];
                                }
                                return $name;
                            }
                            return false;
                        }
                        private function catalogo_newother($catalogo, $value){
                            $query = "SELECT `id` FROM `catalogo_$catalogo` WHERE `value` like '%$value%' LIMIT 1";
                            $position = false;
                            $result = $this->makequery($query);
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    $position = $row['id'];
                                }
                            }
                            if($position===false){
                                $time = time();
                                $query = "SELECT `id` FROM `user_otheroptions` WHERE `catalogo`='$catalogo' AND `value` like '%$value%' LIMIT 1";
                                $result = $this->makequery($query);
                                if($result[0]){
                                    while($row = mysqli_fetch_array($result[1])){
                                        $position = $row['id'];       
                                    }
                                }
                                if($position===false){///Nuevo no existe
                                    $query = "INSERT INTO `user_otheroptions` "
                                            . "(`id`, `catalogo`, `value`, `count`, `createtime`, `lastupdate`, `status`) "
                                            . "VALUES "
                                            . "(NULL, '$catalogo', '$value', '1', '$time', '$time', '1');";
                                    $result = $this->makequery($query);

                                    if($result[0]){
                                        $query2 = "SELECT `id` FROM `user_otheroptions` WHERE `value`='$value' AND `catalogo`='$catalogo' AND `createtime`='$time' LIMIT 1;";
                                        
                                        $result2 = $this->makequery($query2);
                                        if($result2[0]){
                                            while($row2 = mysqli_fetch_array($result2[1])){
                                                $position = $row2['id'];
                                            }
                                        }
                                        return array(true, $position);
                                    }
                                }else{///nuevo existente
                                   $query = "UPDATE `user_otheroptions` SET `count` = `count`+1 WHERE `user_otheroptions`.`id` = $position;"; 
                                   $result = $this->makequery($query);
                                   return array(true, $position);
                                }
                            }else{//Nuevo parte del catalogo
                                return array(FALSE, $position);
                            }
                        }
                        function createnewfile($uniqueid, $dirfile, $urlfile, $filename, $table, $tableid, $userid){
                            $time = time();
                            $query = "INSERT INTO `fileupload` (`id`, `uniqueid`, `dirfile`, `urlfile`, `filename`, `table`, `tableid`, `timecreate`, `status`) VALUES (NULL, '".$uniqueid."', '".$dirfile."', '".$urlfile."', '".$filename."', '".$table."', '".$tableid."', '".$time."','1');";
                            
                            $result = $this->makequery($query);
                            if($result[0])
                                return true;
                            return FALSE;
                        }
                        function deletefile($uniqueid){
                            $time = time();
                            $query = "UPDATE `fileupload` SET `status`='0' WHERE `uniqueid`='".$uniqueid."';";
                            $result = $this->makequery($query);
                            if($result[0]){
                                return true;
                            }
                            return false;
                        }
                        function getfiles($table, $tableid){
                            $query = "SELECT * FROM `fileupload` WHERE `table`='".$table."' AND `tableid`='".$tableid."' AND `status`='1';";
                            $result = $this->makequery($query);
                            $files = array();
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    array_push($files, $row);
                                }
                                return array(true, $files);
                            }
                            return array(false, $files);
                        }          
	}
?>
