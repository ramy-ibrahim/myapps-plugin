<?php
require_once('cls.php');

class gtmix_js extends gtmix_app {
	
	private function js_global(){
		?>
//<script>
function gtmix_get_id(replaceWord,tagName){
	
	
	var getobj = document.activeElement;

		if(getobj.tagName == tagName && getobj.id != ''){
			
			
			if(replaceWord !== false){
				var getID = String(getobj.id);
			
			   if(getID.search(replaceWord)==0){
				
				 var IdName = getID.replace(replaceWord,'');
				 
				 if(IdName !=''){
					
					 return IdName;
				 }else{
					 return false;
				 }
				   
			   }else{
				   return false;
			   }
				
				
			}else{
				return getobj.id;
				
			}
			
		}else{
			return false;
		}
	
}
//</script>
        <?php
	}
	
	
	
	
	
	
	private function unistall(){
		?>
//<script>
	document.addEventListener("click", function(){
       
		var idName = gtmix_get_id('del_','BUTTON');
		
		if(idName !==false){
			if (confirm('You going to uninstall App.\nAre you sure?') == true){
				
				gtmix_uninstall(idName );
			}
		}
		
    });
	
function gtmix_uninstall(dir_name){
   
	var get_block = document.getElementById('block_'+dir_name);
	
	if(get_block != 'undefined'){
		
		var get_content = get_block.innerHTML;
		
		var get_result = gtmix_ajax('POST','<?php echo $this->main_dir_url  ?>/actions.php?name=uninstall_app','app_name='+dir_name+'&log='+gtmix_global_log,true);
		get_block.innerHTML = 'uninstalling....';
		
		var Loop = setInterval(function(){
			
			if(global_ajax_back == null){
			   
				get_block.innerHTML = 'uninstalling....';
				
			}else{
				clearInterval(Loop);
				
				if(get_result != false){
					
					if(get_result == 'app uninstalled successfully'){
						get_block.remove();
						alert('app uninstalled successfully');
					}else{
						get_block.innerHTML = get_content;
						alert(get_result);
					}
					global_ajax_back = null;
				}else{
					
					get_block.innerHTML = get_content;
					alert('Error: can not uninstall! \nErr Code JSE');
					global_ajax_back = null;
				}
				
			}
			
		},1000);
		
		
	}
	
}				
//</script>
        <?php
	}
	
	
	private function ajax(){
		?>
//<script>
global_ajax_back = null;
				
function send_ajax(method,file_path,values,send_header) {
	
	global_ajax_back = null;
  var xhttp = new XMLHttpRequest();
      
     
		  
		  xhttp.onreadystatechange = function() {
			  

    if (this.readyState == 4 && this.status == 200) {

      global_ajax_back =  this.responseText;
		
    }else{
	
	  global_ajax_back =   false;
		
	}


  };


  xhttp.open(method, file_path, false);
	
  if(send_header == true){
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  }
	  
  xhttp.send(values);
}


function gtmix_ajax(method,file_path,values,send_header){
       
   send_ajax(method,file_path,values,send_header);
	

	return global_ajax_back;

}

  //</script>
        <?php
	}
	
	private function install(){
		?>
 //<script>
    document.getElementById('do_upload').addEventListener('click',function(){
		
		var contaner = document.getElementById('gtmix_install');
		
		
		var file =  document.getElementById('myfile');

		
		if(file.files[0] == undefined){
			alert('choose a file form your device first!');
			
		}else{
			
			
			var data = new FormData();
		   data.append('myfile',file.files[0]);
			
			
           global_ajax_back = null;
			
			
		   var getR = gtmix_ajax("POST",'<?php echo $this->main_dir_url  ?>/actions.php?name=install_app',data,false);
			
			document.getElementById('gtmix_upload_form').style.display = 'none';
		    document.getElementById('gtmix_installing_form').style.display = 'block';
			
			var loop = setInterval(function(){
				
				if(global_ajax_back == null){
					
					document.getElementById('gtmix_upload_form').style.display = 'none';
					document.getElementById('gtmix_installing_form').style.display = 'block';
					
				}else{
					
					clearInterval(loop);
					alert(getR);
					
					
					if(getR == 'Application Installed Successfully'){
						
						location.reload();
					}else{
						
						file.value='';
					document.getElementById('gtmix_installing_form').style.display = 'none';
					document.getElementById('gtmix_upload_form').style.display = 'block';
					global_ajax_back = null;
						
					}
					
					
					
					
				}
				
				
			},1000);

			
		}
		

	});

//</script>
		<?php
	}
	
	
	private function run(){
		?>
      //<script>
		  app_in_procc = null;
		  gtmix_app_info = null;
		  
		  //document.getElementById('gtmix_min_bar').onclick = function(){
			  
			  
		  //}
		  
		  
		  
           //document.addEventListener("click", function(){
             document.body.onclick =  function(){ 
			   
		        var idName = gtmix_get_id('run_','BUTTON');
			    var other = gtmix_get_id(false,'BUTTON') ; 
			   //alert('running');
			   if(idName !=false){
				   gtmix_run_app(idName);
				    document.getElementById('gtmix_min_bar').style.display = 'none';
				   
			   }else{
				   
				   if(other == 'gtmix_min_app'){
					   
					   var getMinBar = document.getElementById('gtmix_min_bar');
					   getMinBar.innerHTML = '<img src="'+gtmix_app_info.icon+'" width="30px" align="left">'+gtmix_app_info.name;
					   
					    document.getElementById('gtmix_app_screen').style.display = 'none';
					    getMinBar.style.display = 'block';
					   
					   
				   }else if(other == 'gtmix_exit_app'){
					   document.getElementById('gtmix_app_screen').style.display = 'none';
						document.getElementById('ifram_app').src= "<?php echo $this->html_template_url  ?>/about.html";
					    document.getElementById('gtmix_min_bar').style.display = 'none';
					   
					    app_in_procc = null;
		                gtmix_app_info = null;
					   
					   
				   }else if(other == 'gtmix_info_app'){
					   
					   // app_in_procc is public loaded throw this file (run)
					    global_ajax_back = null;
						 gtmix_ajax("POST",'<?php echo $this->main_dir_url  ?>/actions.php?name=about_app','app_name='+app_in_procc,true);
					  
					   var info_block = document.getElementById('gtmix_info_content');
					   
					   info_block.innerHTML = 'Loading...';
					   document.getElementById('gtmix_info_dialog').style.display = 'block';
					   
					   var check_req = setInterval(function(){
				  
				           if(global_ajax_back != null){
							   
							   info_block.innerHTML = global_ajax_back;
							   clearInterval(check_req);
						   }
					  
					   },500);
					   
					   
					   
			      
					   
					   
				   }else if(other == 'gtmix_exit_info'){
					   
					   document.getElementById('gtmix_info_dialog').style.display = 'none';
							
				   }
				   
			   }
				
		  
		   };
         //});
		  
		  
		  function maxmize(){
			  document.getElementById('gtmix_min_bar').style.display = 'none';
			  document.getElementById('gtmix_app_screen').style.display = 'block';
		  }
		  
		  function gtmix_array_data(data){
			  
			  var GetDataKey = new RegExp(/%_keys:.+_% /);
			  var GetKeys = new String (GetDataKey.exec(data));
			  
			  var GetDataValues = new RegExp(/%_values:.+_%/);
			  var GetValues = new String (GetDataValues.exec(data));
			  
			  
			  GetKeys = GetKeys.replace('%_keys:','');
			  GetKeys = GetKeys.replace('_%','');
			  
			  GetValues  = GetValues.replace('%_values:','');
			  GetValues  = GetValues.replace('_%','');
			  
			  
			  
			  var AllKeys = GetKeys.split('_,_');
			  var Allvalues = GetValues.split('_,_');
			  
			  var FinalArr = new Array;
			  var SetKey = new String;
			  
			  for(l=0;l<=(AllKeys.length - 1);l++){
				  
				  SetKey = AllKeys[l];
				  
				  
				 switch(SetKey.trim()){
						 
					 case 'name':
						 
						 FinalArr.name = Allvalues[l];
						 
					 break;
					 
				     case 'version':
						 
						 FinalArr.version = Allvalues[l];
						 
					 break;
						 
					case 'developer':
						 
						  FinalArr.developer = Allvalues[l];
						 
					 break;
						 
					case 'desc':
						 
						 FinalArr.desc = Allvalues[l];
						 
					 break;
						 
					case 'site':
						 FinalArr.site = Allvalues[l];
						 
					 break;
						 
					case 'icon':
						 FinalArr.icon = Allvalues[l];
						 
					 break;
						 
				    case 'home':
						 FinalArr.home = Allvalues[l];
						 
					 break;
				 }
			  }
			  
			  return FinalArr;
			
			  
		  }
		  
		  
		  function gtmix_run_app(dir_name){
			  
			 
			  
			  
			  global_ajax_back = null;
			  gtmix_ajax("POST",'<?php echo $this->main_dir_url  ?>/actions.php?name=run_app','app_name='+dir_name,true);
			  
			  
			  var check_req = setInterval(function(){
				  
				  if(global_ajax_back != null){
					  
					  if(global_ajax_back == 'false'){
						   alert('can not run this App!');
					  }else{
						   
						  app_in_procc = dir_name;
						    gtmix_app_info = gtmix_array_data(global_ajax_back);
						    
						    global_ajax_back = null;
						  
						   document.getElementById('ifram_app').src = gtmix_app_info.home;
						   document.getElementById('gtmix_app_title').innerHTML = gtmix_app_info.name;
						   document.getElementById('gtmix_app_screen').style.display = 'block';
					  }
					  
					  clearInterval(check_req);
				  }
				  
				  
			  },500);
			  
		  }
		  
		  
		  
		
      //</script>


       <?php
	}
	
	
	private function design_form(){
		?>
       //<script>
		   form_loaded = null;
		   window.addEventListener('load',function(){
			  
			   
			     document.getElementById('gtmix_go').onclick = function(){
			  var form = document.getElementById('gtmix_sel_forms') ;
			   
			   if(form.selectedIndex  == 0){
				   alert('please select form first!');
			   }else{
				   var form_title = document.getElementById('form_name');
				    
				   global_ajax_back = null;
				   
				    gtmix_ajax("POST",'<?php echo $this->main_dir_url  ?>/actions.php?name=load_form','form_name='+form.value,true);
				   
				   form_title.innerHTML = 'Loading '+form.value+'...';
				    
				   var check = setInterval(function(){
					   
					   if(global_ajax_back != null){
						   
						   
						   if(global_ajax_back == 'false'){
							  
							   alert('Error: can not load this file now please check your connection!');
							   form_title.innerHTML = '';
						   }else{
							   form_title.innerHTML = form.value;
							   document.getElementById('gtmix_codes_area').value = global_ajax_back;
							   
							   form_loaded = form.value;
						   }
						   
						   clearInterval(check);
					   }
					   
					   
				   },500);
				   
				   
				   
			   }
			   
			   
			  
			   
		   }
		   
		   
		   document.getElementById('gtmix_save').onclick = function(){
			   
			   
			   
			   var form_title = document.getElementById('form_name');
			   var code_content = document.getElementById('gtmix_codes_area');
			   
				    if(form_loaded==null){
					       
					    alert('select from first!');
					   
					}else if (code_content.value.trim() == ''){
						alert('the form is empty!');
						
					}else{
						
						 global_ajax_back = null;
						gtmix_ajax("POST",'<?php echo $this->main_dir_url  ?>/actions.php?name=save_form','form_name='+form_loaded+'&set_content='+code_content.value,true);
						
						
						form_title.innerHTML = 'Saving to '+form_loaded+'...';
				    
				   var check = setInterval(function(){
					   
					   if(global_ajax_back != null){
						   
						   if(global_ajax_back == 'false'){
							  
							   alert('Error: can not save this file now please check your connection!');
							   form_title.innerHTML = form_loaded;
						   
						   }else{
							   form_title.innerHTML = 'Done';
							   setTimeout(function(){
								   
								   form_title = document.getElementById('form_name').innerHTML = form_loaded;
							   
							   },1000);
							   
		
						   }
						   
						   clearInterval(check);
					   }
					   
					   
				   },500);
						
					}
 
		   }
			   
			//End Window.load   
		   });
		   
		   
		   
	  //</script>
	  <?php
	 
	}
	
	
	 private function reports(){
		  ?>
          //<script>
             report_content = null;
			 document.getElementById('today').onchange = function(){
				 
				 if( this.checked == true){
				   
				   document.getElementById('sel_year').style.display = 'none';
				   document.getElementById('sel_month').style.display = 'none';
				   document.getElementById('sel_day').style.display = 'none';
				   document.getElementById('ip_num').style.display = 'none';	 
				 }
				 
			  	 
			 }
			 
			 document.getElementById('date').onchange = function(){
				 
				 if( this.checked == true){
				   
				   document.getElementById('sel_year').style.display = 'block';
				   document.getElementById('sel_month').style.display = 'block';
				   document.getElementById('sel_day').style.display = 'block';
				   document.getElementById('ip_num').style.display = 'none';	 
				 }
				 
			  	 
			 }
			 
			 document.getElementById('year').onchange = function(){
				 
				 if( this.checked == true){
				   
				   document.getElementById('sel_year').style.display = 'block';
				   document.getElementById('sel_month').style.display = 'none';
				   document.getElementById('sel_day').style.display = 'none';
				   document.getElementById('ip_num').style.display = 'none';	 
				 }
				 
			  	 
			 }
			 
			 document.getElementById('month').onchange = function(){
				 
				 if( this.checked == true){
				   
				   document.getElementById('sel_year').style.display = 'block';
				   document.getElementById('sel_month').style.display = 'block';
				   document.getElementById('sel_day').style.display = 'none';
				   document.getElementById('ip_num').style.display = 'none';	 
				 }
				 
			  	 
			 }
			 
			 document.getElementById('ip').onchange = function(){
				 
				 if( this.checked == true){
				   
				   document.getElementById('sel_year').style.display = 'none';
				   document.getElementById('sel_month').style.display = 'none';
				   document.getElementById('sel_day').style.display = 'none';
				   document.getElementById('ip_num').style.display = 'block';	 
				 }
				 
			  	 
			 }
			 
			 document.getElementById('btn_get_report').onclick = function(){
				 
				 var get_sel = document.getElementById('sel_app');
				 
				 if(get_sel.value == "con"){
					 
					 alert('please select app from the list first!');
					 
				 }else{
					 get_app_reports(get_sel.value);
				 }
				 
			 }
			 
			 function get_app_reports(app_name){
				 
			   global_ajax_back = null;
			   gtmix_ajax("GET",'<?php echo $this->apps_dir_url ?>/'+app_name+'/run-c.xml','',true);
				 
			   var report_area = document.getElementById('report_content');
			   report_area.innerHTML = "Loading...";
				 
			   var check = setInterval(function(){
				   	
				   if(global_ajax_back != null){
					   
					   
					   if(global_ajax_back == false){
						  
						   report_area.innerHTML = "The report is not available yet for this app!";
					   }else{
						   
						   
						   var parser = new DOMParser();
						   report_content = parser.parseFromString(global_ajax_back,"text/xml");
						   
						   data_filter_output(report_content);
		 
					   }
					   
					   global_ajax_back = null;
					   clearInterval(check);
				   }
				   
			   },500);
						
			 }
			 
			  
			  function data_filter_output(data){
				  
				  var getlist = false;
				  var sel_year = document.getElementById('sel_year');
				  var sel_month = document.getElementById('sel_month');
				  var sel_day = document.getElementById('sel_day');
				  var ip_num = document.getElementById('ip_num');
				  
				   if (document.getElementById('today').checked == true){
					   
					   var year = "<?php echo date('Y'); ?>";
					   var month = "<?php echo date('n'); ?>";
					   var day = "<?php echo date('j'); ?>";
					   
					   getlist = data.querySelectorAll('log[y_m_d="'+year+'-'+month+'-'+day+'"]');
					   
					   
				   }else if(document.getElementById('date').checked == true){
					   
					   if(sel_day.value == 0 || sel_month.value == 0 || sel_year.value == 0){
						   
						   alert('invalid date!')
					   }else{
						   
						   getlist = data.querySelectorAll('log[y_m_d="'+sel_year.value+'-'+sel_month.value+'-'+sel_day.value+'"]');
					   }
					   
					   
				   }else if(document.getElementById('month').checked == true){
					   
					   if(sel_month.value == 0 || sel_year.value == 0){
						   
						   alert('invalid date!')
					   }else{
						   
						   getlist = data.querySelectorAll('log[y_m="'+sel_year.value+'-'+sel_month.value+'"]');
					   }
					   
				   }else if(document.getElementById('year').checked == true){
					   
					    if(sel_year.value == 0){
						   
						   alert('select year!')
					   }else{
						   
						   getlist = data.querySelectorAll('log[y="'+sel_year.value+'"]');
					   }
					   
					   
				   }else if(document.getElementById('ip').checked == true){
					   
					  
					   
					   var get_ip = new String(ip_num.value);
					   
					   if (get_ip.trim() != ''){
						  
						   var Looking_IP = btoa(btoa(get_ip.trim()));
						   getlist = data.querySelectorAll('log[code="'+Looking_IP+'"]');
						   
					   }else{
						   alert('invalid IP!');
					   }
					   					   
				   }
				  
				  
				  var report_area = document.getElementById('report_content');
				  
				  if(getlist == false || getlist.length <=0){
							   
							   report_area.innerHTML = "no report!";
							   
				  }else{
					  var total =  data.querySelectorAll('log').length;
					  
						  
						var SetReport = 'Run Total: '+total+'<br>Filter Run: '+getlist.length+'<br><ol>';
					  
					    for(l=0;l<=(getlist.length - 1); l++){
							
							//atob(atob(getlist[l].getAttribute('code')))
						    SetReport += '<li>'+getlist[l].innerHTML+' IP: '+atob(atob(getlist[l].getAttribute('code')))+'</li>';
						}
							SetReport += '</ol>';
							   
							report_area.innerHTML = SetReport;
				}
			  }
			 
			 
          //</script>
          <?php
	  }
	
	/*output($script_name)
	$script_name:
	global
	uninstall
	ajax
	*/
	public function output($scipt_name){
         
		switch($scipt_name){
			case 'global':
				
				$this->js_global();
				
				break;
				
			case 'uninstall':
				
				$this->unistall();
				
				break;
				
			case 'ajax':
				
				$this->ajax();
				
				break;
				
			case 'install':
				
				$this->install();
				
				break;
				
			case 'run':
				
				$this->run();
				
				break;
				
			case 'design_form':
				
				$this->design_form();
				
				break;
				
			case 'reports':
				
				$this->reports();
				
				break;
		}
		
	}
	
}





?>
