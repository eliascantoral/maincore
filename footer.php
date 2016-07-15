<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        </div>        
        <div class="modal fade" id="ajax_loader"></div>      
    </body>
</html>
<script>
        function ajax_loading(){            
            $("#ajax_loader").modal({
                backdrop: 'static'
            });
        }
        function ajax_end(){
            $("#ajax_loader").modal('hide')
        }
	function show_message(where, message){
		$("#"+where).text(message);
		$("#"+where).show("fast");
		setTimeout(function(){$("#"+where).hide("fast");},5000)
	}
	$("#search_form").submit(function(){		
		var text = document.getElementById("search_text").value;
		if(text == ""){
			event.preventDefault();			
		}
	});
	
	
	function ajax_(action, data, update, dest){
                ajax_loading();
		$.ajax({
		  async:false, 
		  cache:false,
		  dataType:"html", 
		  type: 'POST',   
		  url: "<?php echo get_variable("ajax");?>",
		  data: "action="+ action + data, 
		  success:  function(respuesta){				
			if(update){
				if(dest==""){
					location.reload();
				}else{
					
					 window.location.assign(dest);
				}
				
			}else if(dest!=""){
                $("#"+dest).val(respuesta);
			}
			ajax_end();
		  },
		  beforeSend:function(){                      
			
		  },
		  error:function(objXMLHttpRequest){$("#"+dest).val("Error...");ajax_end();console.log(objXMLHttpRequest);}
		});
		
	}
	function ajax_async(action, data, update, dest){		
		$.ajax({
		  async:true, 
		  cache:false,
		  dataType:"html", 
		  type: 'POST',   
		  url: "<?php echo get_variable("ajax");?>",
		  data: "action="+ action + data, 
		  success:  function(respuesta){				
			if(update){
				if(dest==""){
					location.reload();
				}else{
					
					 window.location.assign(dest);
				}
				
			}else if(dest!=""){	
				document.getElementById(dest).innerHTML="";		
				document.getElementById(dest).innerHTML=respuesta;
			}
			$("#"+dest).removeClass("ajax_loader");
		  },
		  beforeSend:function(){
			$("#"+dest).addClass("ajax_loader");
		  },
		  error:function(objXMLHttpRequest){$("#"+dest).removeClass("ajax_loader");console.log(objXMLHttpRequest);}
		});
		
	}
        function uploadfile(id){             
            var fileSelect = document.getElementById('fileselect');         
            var files = fileSelect.files;
            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                var file = files[i];    
                formData.append('files[]', file, file.name);
            } 
            $.ajax({
              url: '<?php echo get_variable("ajax");?>?files='+id+'&table=expresion',
              data: formData,
              async: false,
              processData: false,
              contentType: false,
              type: 'POST',
              success: function(data){
                $("#answer").html(data);
              }
            });    
        }
</script>
