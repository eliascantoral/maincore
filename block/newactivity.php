<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$activitytype = get_activitytype();
$clients = get_clientlist();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="style/jquery.datetimepicker.css">
<script src="js/jquery.datetimepicker.js"></script>

<input type="hidden" id="ajaxanswer" value="">
<h3>Nueva actividad</h3>
<form id="newactivity" class="form-horizontal">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
              <label for="starttime" class="col-sm-2 control-label">Inicio</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control inputdate" id="startime" value="<?php echo date("Y/m/d H:i",  time()-(6*60*60));?>" required>
              </div>
            </div>            
        </div>
        <div class="col-md-4">
            <div class="form-group">
              <label for="endtime" class="col-sm-2 control-label">Fin</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control inputdate" id="endtime"  value="<?php echo date("Y/m/d H:i",  time()-(6*60*60));?>" required>
              </div>
            </div>  
        </div>
        <div class="col-md-4">
                <div class="form-group">
                  <label for="activitytype" class="col-sm-2 control-label">Tipo</label>
                  <div class="col-sm-10">
                      <select class="form-control" id="activitytype">
                          <?php for($i=0;$i<sizeof($activitytype);$i++){?>
                          <option value="<?php echo $activitytype[$i][0];?>"><?php out($activitytype[$i][1]);?></option>    
                          <?php }?>
                      </select>
                  </div>
                </div>            
        </div>
    </div>
  <div class="form-group ui-widget">
    <label for="client" class="col-sm-2 control-label">Cliente</label>
    <div class="col-sm-9">
        <input id="client" type="text" class="form-control">
    </div>
    <div class="col-sm-1">
        <a href="#" id="add-client"><img src="image/addcliente.png" width="25px"></a>
    </div>
  </div>  
  <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Descripción</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="description">
            
        </textarea>
    </div>
  </div>      
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Guardar</button>
      <button type="reset" class="btn btn-danger">Reiniciar</button>
    </div>
  </div>
    <div class="form-group">
        <div class="alert alert-danger message" id="error-newactivity" role="alert"></div>
        <div class="alert alert-success message" id="ok-newactivity" role="alert"></div>
    </div>  
</form>





<div class="modal fade" id="new-client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Nuevo cliente</h4>
      </div>
      <div class="modal-body">
          <form id="new-client-form">
          <div class="form-group">
            <label for="newcliente-name" class="control-label">Cliente (*):</label>
            <input type="text" class="form-control" id="newcliente-name" required="true">
            <input type="hidden" id="ajaxanswer-newcliente">
          </div>
          <div class="form-group">
            <label for="newcliente-mail" class="control-label">Email:</label>
            <input type="email" class="form-control" id="newcliente-email">
          </div>
          <div class="form-group">
              <label for="newcliente-phone" class="control-label">Tel&eacute;fono:</label>
            <input type="tel" class="form-control" id="newcliente-tel">
          </div>
          <div class="form-group">
            <label for="newcliente-empresa" class="control-label">Empresa:</label>
            <select type="text" class="form-control" id="newcliente-empresa">
                <?php $company = get_companylist();
                        for($i=0;$i<sizeof($company);$i++){?>
                <option value="<?php echo $company[$i][0]?>"><?php out($company[$i][1]);?></option> 
                <?php }?>
            </select>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>  
            <div class="form-group">
                <div class="alert alert-danger message" id="error-newcliente" role="alert"></div>
                <div class="alert alert-success message" id="ok-newcliente" role="alert"></div>
            </div>              
        </form>
      </div>
    </div>
  </div>
</div>



  <script>
  $(function() {
    $( "#startime" ).datetimepicker({
        lang:'es',
        step:5
    }); 
    $( "#endtime" ).datetimepicker({
        lang:'es',
        step:5        
    });     
  });  
    $(function() {
    var availableclient = 
        <?php
                        $clients = array();
                        $result = get_clientlist();
                        //var_dump($result);
                        if($result){
                            for($i=0;$i<sizeof($result);$i++){
                                array_push($clients, "(".$result[$i][0].") ".$result[$i][1]." - ".$result[$i][3]);
                            }
                        }
                        echo json_encode($clients);
        ?>
    ;
    $( "#client" ).autocomplete({
      source: availableclient
    });
        
  });  
  
  $("#newactivity").submit(function(e){      
      e.preventDefault();           
      var startime = $("#startime").val();
      var endtime = $("#endtime").val();
      var activitytype = $("#activitytype").val();
      var client = encodeURIComponent($("#client").val());
      var description = encodeURIComponent($("#description").val());
      if(startime!="" && endtime != "" && activitytype != "" && client !=""){
          ajax_("101","&startime="+startime+"&endtime="+endtime+"&activitytype="+activitytype+"&client="+client+"&description="+description,false,"ajaxanswer");
            var answer = $("#ajaxanswer").val();
            json = jQuery.parseJSON( answer );
            if(json.r==1){
                 show_message("ok-newactivity",json.d);
                 $("#newactivity")[0].reset();
            }else{
                switch(json.r){
                    case 0:
                        show_message("error-newactivity",json.d);
                        break;
                    case 2:///Cliente no valido
                        
                        break;
                    default:
                        show_message("error-newactivity","Error descoocido.");
                }
                 show_message("loginmessage",json.d);
            }
      }else{
          show_message("error-newactivity","Debe completar los campos obligatorios.");
      }
  });
  
  $("#add-client").click(function(e){
      e.preventDefault();
      $('#new-client').modal('show');
      
  });
 
 $("#new-client-form").submit(function(e){
     e.preventDefault();
     var newname = encodeURIComponent($("#newcliente-name").val());
     var newmail = encodeURIComponent($("#newcliente-email").val());
     var newcompany = encodeURIComponent($("#newcliente-empresa").val());
     var newtel = encodeURIComponent($("#newcliente-tel").val());
     if(newname!="" && newcompany !=""){
         ajax_("102","&newname="+newname+"&newemail="+newmail+"&newcompany="+newcompany+"&newtel="+newtel,false,"ajaxanswer-newcliente");
         var answer = $("#ajaxanswer-newcliente").val();
        json = jQuery.parseJSON( answer );
        if(json.r==1){             
             $("#client").val(json.d);
             $('#new-client').modal('hide');
             $("#description").focus();
             $('#new-client-form')[0].reset();
        }else{
            switch(json.r){
                case 0:
                    show_message("error-newcliente",json.d);
                    break;
                default:
                    show_message("error-newcliente","Error desconocido.");
            }
        }
     }
     
 });
  </script>