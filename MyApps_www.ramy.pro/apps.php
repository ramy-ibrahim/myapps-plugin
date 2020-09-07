<?php

require_once('cls.php');
$gtmix = new gtmix_app;
         
       ///--- get log id
		if($getLog = $gtmix->get_log_id()){
			echo '<script> gtmix_global_log="'.$getLog.'";</script>';
		}else{
			echo '<script> gtmix_global_log="false";</script>';
		}
   

if($getlist = $gtmix->get_forms('applist_dashboard')){
	   
	echo $getlist;   
	?>
    <script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=global' ?>"></script>
    <script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=ajax' ?>"></script>
    <script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=uninstall' ?>"></script>
    <script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=install' ?>"></script>
    <?php
	
}else{
	echo 'no apps';
}
?>
