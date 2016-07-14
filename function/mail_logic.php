<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function mail_send($destino, $destinoname, $subjet, $message){
    require("aws_mailer/phpmailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    $mail->Host       = "email-smtp.us-east-1.amazonaws.com"; // SMTP server example
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
    $mail->Username   = "AKIAJO7EYLSWC2EYLOMQ"; // SMTP account username example
    $mail->Password   = "AhLgMoUT5d5UAO6ncRbOV/kEJdPae45mh15n3wpMg/Ox";        // SMTP account password example
    $mail->SMTPSecure = 'ssl'; 



    $mail->From = 'augusto.mazariegos@myappsoftware.com';
    $mail->FromName = 'Administrador de M&HFile';			
    $mail->addAddress($destino, $destinoname);     // Add a recipient


    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subjet;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    return $mail->send();    
}