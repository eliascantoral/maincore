<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        <div class="container-fluid">
            <div id="main-wrapper" class="container-fluid row" align="center">
                <div id="login_background">
                        <h3>Bienvenido</h3>
                        <p>Por favor, ingrese su usuario y contraseña.</p>
                        <form class="form-horizontal" id="loginform" method="POST">
                            <input type="hidden" class="form-control" id="login_answer" value="">
                          <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" autofocus required="" value="admin">
                                </div>
                          </div>
                          <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required="" value="admin">
                                </div>
                          </div>
                          <div class="form-group">
                                <div class="col-sm-12" align='right'>
                                  <button type="submit" class="btn btn-info">Ingresar</button>
                                </div>
                          </div>
                          <div class="alert alert-danger message" role="alert" id="loginmessage"></div>
                        </form>
                </div>
</div>
<script>
    $( document ).ready( function(){
            $("#mainheader").hide("fast");
    });
    $("#loginform").submit(function(event){
        event.preventDefault();
        var user = $("#username").val();
        var pass = $("#password").val();
        ajax_("0", "&user="+user+"&pass="+pass, false, "login_answer");
        var answer = document.getElementById("login_answer").value;
        json = jQuery.parseJSON( answer );
        if(json.r==1){
             location.reload();
        }else{
             show_message("loginmessage",json.d);
        }

    })
</script>
