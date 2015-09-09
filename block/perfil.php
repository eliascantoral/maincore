<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="form-horizontal col-sm-8">
  <div class="form-group">
    <label class="col-sm-2 control-label">Usuario</label>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo get_userdata("username");?></p>
    </div>
  </div>
  <div class="form-group">
    <label for="oldpass" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">     
        <form id="form-changepassword" class="form-horizontal">
            <div class="form-group">
                <input type="button" class="btn btn-danger" id="btn-changepass" value="Cambiar contraseña">
            </div>
            <div id="div-changepass" class="message">
                <div class="form-group">
                <input type="password" class="form-control" id="oldpass" placeholder="Password Actual" required="true">
                <br>
                <input type="password" class="form-control" id="newpass1" placeholder="Nuevo Password" required="true">
                <br>
                <input type="password" class="form-control" id="newpass2" placeholder="Repetir Nuevo Password" required="true">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-danger" id="btn-changepass-ok" value="Cambiar contraseña">
                    <input type="button" class="btn btn-default" id="btn-changepass-cancel" value="Cancelar">
                </div>
            </div>
        </form>
    </div>
    <div class="form-group">
        <input type="hidden" id="ajaxanswer">
        <div class="alert alert-danger message" id="error-perfil" role="alert"></div>
        <div class="alert alert-success message" id="ok-perfil" role="alert"></div>
    </div> 
  </div>
</div>

<script>
    $("#btn-changepass").click(function(){
        $(this).hide("fast");
        $("#div-changepass").show("fast");
    });
    $("#btn-changepass-cancel").click(function(){
        $("#btn-changepass").show("fast");
        $("#div-changepass").hide("fast");
    }); 
    $("#form-changepassword").submit(function(e){
        e.preventDefault();
        var pass = $("#oldpass").val();
        var pass1 = $("#newpass1").val();
        var pass2 = $("#newpass2").val();
        if(pass!="" && pass1!="" && pass2!=""){
            if(pass1 == pass2 && pass1.length>=5 && pass != pass1){
              ajax_("1","&old="+pass+"&new="+pass2,false,"ajaxanswer"); 
                var answer = $("#ajaxanswer").val();
                json = jQuery.parseJSON( answer );
                if(json.r==1){
                     show_message("ok-perfil",json.d);
                    $("#btn-changepass").show("fast");
                    $("#div-changepass").hide("fast");
                }else{
                    show_message("error-perfil",json.d);
                }              
            }else{
                show_message("error-perfil","Los campos de nueva contraseña deben ser iguales y al menos 5 caracteres y la contraseña nueva debe ser diferente a la anterior.");
            }
        }else{
            show_message("error-perfil","Todos los campos son obligatorios.");
        }
    });
    
</script>