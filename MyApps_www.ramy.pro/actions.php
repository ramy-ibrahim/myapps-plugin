<?php

if(isset($_GET['name']) && !empty($_GET['name'])){
	
	require_once('cls.php');
    $gtmix = new gtmix_app;
	
	switch($_GET['name']){
		case'uninstall_app':
			
			if(isset($_POST['app_name'])){
				
				echo $gtmix->delete_app($_POST['app_name'],false);
				
			}else{
				echo 'Error:can not processing this action! - error code: PANNE';
			}
			
			
			break;
			
			
		case 'install_app':
			
			
			 
			$gtmix->install_app(false);
			
			break;
		
		case 'run_app':
			$gtmix->add_run_in_counter();
			$gtmix->send_app_info();
			
			break;
			
			
		case 'about_app':
			$gtmix->display_app_info_form();
			
			break;
		
		case 'load_form':
			$gtmix->forms_design_load();
			
			break;
			
		case 'save_form':
			$gtmix->forms_design_save();
			
			break;
			
		default:
			echo 'Error:can not processing this action! - error code: GNE';
			break;
		
		
	}
	
} else{
	echo 'Error:can not processing this action! - error code: GNE';
}







?>