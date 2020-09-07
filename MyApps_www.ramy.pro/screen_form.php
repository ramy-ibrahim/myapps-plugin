<?php

function Get_Screen_Form(){
	require_once('cls.php');
	
	$gtmix = new gtmix_app;
    
	
	
	$form = $gtmix->get_forms('applist_site');
	
	
 
    
	
	$form .='<link rel="stylesheet" type="text/css" href="'.$gtmix->main_dir_url.'/screen.css">
	
	';
	
	
	$form .='
	<div id="gtmix_app_screen">
	
	 <div id="gtmix_info_dialog">
	    <div style="background-color:#000; color:#fff; font-size:20px; padding:3px;">About</div>
	    <div id="gtmix_info_content"></div>
		<center>
		<button id="gtmix_exit_info" style="width:50px; padding:10px; text-align:center;">OK</button>
		</center>
	 </div>
	 
 <div class="gtmix_app_content">
   <div id="gtmix_app_title"></div>
   
	<div class="title_bar">
	
	<button id="gtmix_exit_app"  title="Exit" style="width:40px; height: 40px; background-color:transparent; "><img style="width:100%;" src="'.$gtmix->main_dir_url.'/images/close.png"></button>
	
	<button id="gtmix_min_app"  title="Minmize" style="width:40px; height: 40px; background-color:transparent;"><img style="width:100%;" src="'.$gtmix->main_dir_url.'/images/min.png"></button>
	
	<button id="gtmix_info_app" title="App Information" style="width:40px; height: 40px; background-color:transparent;"><img style="width:100%;" src="'.$gtmix->main_dir_url.'/images/info.png"></button>
	
	</div>
	
	<iframe id="ifram_app"  src="'.$gtmix->html_template_url.'/about.html" style="width:100%; height: 90%; border:0px; "></iframe>
 </div>
 

  
 
</div>
<div id="gtmix_min_bar" onclick="maxmize()"></div>

	';

	$form .='
	 <script type="application/javascript" src="'.$gtmix->main_dir_url.'/load_script.php?name=global"></script>
     <script type="application/javascript" src="'.$gtmix->main_dir_url.'/load_script.php?name=ajax"></script>
     <script type="application/javascript" src="'.$gtmix->main_dir_url.'/load_script.php?name=run"></script>
	';
	
	return $form;
	
}
  
 
 
  
?>




