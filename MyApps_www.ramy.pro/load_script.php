<?php
require_once('js_cls.php');

if(isset($_GET['name'])){
	
	$gtmix = new gtmix_js;
	$gtmix->output($_GET['name']);
}else{
	echo '//are you trying to hack me?! :D';
}
	


?>