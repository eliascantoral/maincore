<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$activitytype = get_activitytype();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="style/jquery.datetimepicker.css">
<script src="js/jquery.datetimepicker.js"></script>

<input type="hidden" id="ajaxanswer" value="">
<h3>Mis Actividades</h3>


<form id="findactivity" class="form-horizontal">
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
                          <option value="all">Todos</option>
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
    <div class="col-sm-10">
        <input id="client" type="text" class="form-control">
    </div>
  </div>        
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info">Buscar</button>
      <button type="reset" class="btn btn-danger">Reiniciar</button>
    </div>
  </div>
    <div class="form-group">
        <div class="alert alert-danger message" id="error-newactivity" role="alert"></div>
        <div class="alert alert-success message" id="ok-newactivity" role="alert"></div>
    </div>  
</form>

<div id="seekresult">
    
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
    $("#findactivity").submit(function(e){
        e.preventDefault();
        var startime = $("#startime").val();
        var endtime = $("#endtime").val();
        var activitytype = $("#activitytype").val();
        var client = encodeURIComponent($("#client").val());
        if(startime !="" && endtime != "" && activitytype != "" && client != ""){
            ajax_async("103","&startime="+startime+"&endtime="+endtime+"&activitytype="+activitytype+"&client="+client,false,"seekresult");
        }        
    });
  
</script>