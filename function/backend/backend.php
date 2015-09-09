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
                        
                        
                        
                        function get_clientlist($userid){
                            $return = array(false, "Error 101");
                            $query = "SELECT `user`.`id` AS userid, `user`.`fname` as fname, `user`.`lname` as lname, `user`.`mail` as mail, `company`.`name` as company FROM `user` INNER JOIN `company` ON `user`.`company`=`company`.`id` WHERE `user`.`status`='1' AND `rol`!='0';";                            
                            $result = $this->makequery($query);
                            if($result[0]){
                                $return = array(true, array());
                                while($row = mysqli_fetch_array($result[1])){
                                    array_push($return[1], array($row['userid'],$row['fname']." ".$row['lname'],$row['mail'],$row['company']));
                                }
                            }
                            return $return;
                        }
                        function get_companylist($userid){
                            $return = array(false, "Error 101");
                            $query = "SELECT * FROM `company` WHERE `status`='1'";
                            $result = $this->makequery($query);
                            if($result[0]){
                                $return = array(true, array());
                                while($row = mysqli_fetch_array($result[1])){
                                    array_push($return[1], array($row['id'],$row['name'],$row['address']));
                                }
                            }
                            return $return;
                        }
                        function create_tempcliente($newname, $newemail,$newtel, $newcompany, $userid){
                            $return = array(false, "Eror 101");
                            $time = time();
                            $name = explode(" ", $newname);
                            $fname = "";
                            $lname = "";                            
                            if(sizeof($name)>2){
                                for($i=0;$i<sizeof($name);$i++){        
                                    if($i<(sizeof($name)/2)-1){
                                        $fname.= $name[$i] . " ";
                                    }else{
                                        $lname.= $name[$i] . " ";
                                    }
                                }
                            }else{
                                $fname = $name[0];
                                if(sizeof($name)>1){
                                    $lname = $name[1];
                                }else{
                                    $lname = "---";
                                }
                            }
                            
                            $mail = $newemail!=""?$newemail:"user".$time."@temporal.com";
                            
                            if(!$this->existdata($mail, 'mail')){
                                $query = "INSERT INTO `user` (`id`, `user`, `password`, `fname`, `lname`, `createtime`, `mail`, `tel` ,`lasttime`, `gmid`, `rol`, `status`, `creater`, `company`) "
                                            . "VALUES "
                                        . "(NULL, 'user".$time."', '123456', '".$fname."', '".$lname."', '".$time."', '".$mail."', '".$newtel."', '0', '', '3', '1', '".$userid."', '".$newcompany."');";

                                $result = $this->makequery($query);
                                if($result[0]){
                                    
                                    $query = "SELECT `user`.`id`,`user`.`fname`,`user`.`lname`,`company`.`name` FROM `user` INNER JOIN `company` ON `user`.`company`=`company`.`id` WHERE `user`='user".$time."'";
                                    $result = $this->makequery($query);
                                    if($result[0]){
                                        while($row = mysqli_fetch_array($result[1])){
                                            $return = array(true, "(".$row[0].")".$row[1]." ".$row[2]." - ".$row[3]);
                                        }
                                    }                                    
                                }                                
                            }else{
                                $return = array(false,"Correo ya existe.");
                            }
                            return $return;
                        }
                        
/*********************************************************************************************************/
                        private function existdata($data, $field){
                            $query = "SELECT `id` FROM `".$field."` WHERE `mail`='".$data."'";
                            $result = $this->makequery($query);
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    return true;
                                }
                            }
                            return false;
                        }
                        
                        
/*********************************************************************************************************/
                        function get_activitytype($userid){
                            $return = array(false, "Error 101");
                            $query ="SELECT * FROM `activity_type` WHERE `status`='1';";
                            $result = $this->makequery($query);
                            if($result[0]){
                                $return = array(true, array());
                                while($row = mysqli_fetch_array($result[1])){
                                    array_push($return[1], array($row['id'],$row['name'],$row['description']));
                                }
                            }
                            return $return;
                        }
                        function create_activity($stime, $etime, $type, $desc, $client, $user){
                            $return = array(false, "Error 101");
                            $time = time();
                            $query ="INSERT INTO `activity` (`id`, `starttime`, `endtime`, `createtime`, `activitytype`, `description`, `client`, `user`, `status`)
                                    VALUES (NULL, '".$stime."', '".$etime."', '".$time."', '".$type."', '".$desc."', '".$client."', '".$user."', '1');";
                            $result = $this->makequery($query);
                            if($result[0]){
                                $return = array(true, "Actividad creada correctamente");                                
                            }
                            return $return;                            
                        }
                        function seek_activity($stime, $etime, $type, $client, $user){
                                $return = array(false, "Error 101");
                                $time = time();
                                
                                
                                $query ="SELECT user.id as userid, user.fname as fname, user.lname as lname, activity.starttime as start, activity.endtime as end, type.name as type, activity.description as descr, company.name as company, cliente.fname as clientefname, cliente.lname as clientelname
                                            FROM `user` as user INNER JOIN `activity` activity ON user.`id`=`activity`.`user`
                                                               INNER JOIN `activity_type` type ON activity.`activitytype` = type.`id`
                                                       INNER JOIN `user` as cliente ON cliente.`id`=activity.`client`
                                                       INNER JOIN `company` as company ON user.`company` = company.`id`
                                            WHERE";
                                
                                if($stime<$etime)
                                    $query.= " activity.starttime>=".$stime." AND activity.endtime<=".$etime;
                                
                                if($type!="all")
                                    $query.=" activity.type='".$type."'";
                                
                                if($client!="0")
                                    $query.=" activity.client = '".$client."'";
                                
                                $query.=" activity.user='".$user."'";
                                
                                echo $query;
                                
                                /*$result = $this->makequery($query);
                                if($result[0]){
                                    $return = array(true, "Actividad creada correctamente");                                
                                }*/
                                return $return;                            
                        }
	}
?>
