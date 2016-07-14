<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Guatemala');?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<script src="js/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>	
	</head>
	<body>
	
	
		<?php

			require("phpmailer/PHPMailerAutoload.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->CharSet = 'UTF-8';

			$mail->Host       = "email-smtp.us-east-1.amazonaws.com"; // SMTP server example
			$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
			$mail->Username   = "AKIAIYAMNXZRXNZUNHJA"; // SMTP account username example
			$mail->Password   = "AtsgeUqMORS9i6F2q1V9GN4dq0tGBJraVl60MTBrTiUl";        // SMTP account password example
			$mail->SMTPSecure = 'ssl'; 
			
			
			
			$mail->From = 'aemc@socialvektor.com';
			$mail->FromName = 'Prueba expresate';			
			$mail->addAddress('eliascantoral@gmail.com', 'Augusto Mazariegos');     // Add a recipient
			$mail->addAddress('augusto.mazariegos@myappsoftware.com', 'Pruebas');     // Add a recipient
			
			
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Mensaje enviado desde SES';
			$mail->Body    = 'Esta es una prueba de mail enviado desde <b>SES AWS!</b>';
			$mail->AltBody = 'Esta es una prueba, Esta es una prueba, Esta es una prueba, Esta es una prueba';

			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
			
		

		
			/*
			require("aws_ses.php");
			$sender = new awsses("AKIAIUUYZTIWWY2VS3LQ","ArDWAJGnot8P+80h9ow6cn5QovORltiIVGze0cbmiITf");
			$sendto= array(array('augusto.mazariegos@myappsoftware.com', 'Augusto Mazariegos'),'luis.mendez@myappsoftware.com',array('edwin.archila@myappsoftware.com','Edwin'));
			if($sender->add_to_array("cc",$sendto)){
				echo "Agregado";				
			}
			if($sender->change_from("augusto.mazariegos@criptonube.com","Grupo Capris")){
				echo "From cambiado";				
			}
			
			if($sender->add_attachment("D:\imagen.png","Imagen adjunta")){
				echo "Attached";				
			}
			$sender->set_subject("Correo de prueba " . time());
			//$sender->set_body(file_get_contents("mail_03102015.php"));
			$sender->set_body("TEST");
			
			$trysend = $sender->sendmail();
			if($trysend===true){
				echo "Mensaje enviado correctamente";				
			}else{
				echo $trysend;				
			}*/
		?>	
	</body>

</html>
