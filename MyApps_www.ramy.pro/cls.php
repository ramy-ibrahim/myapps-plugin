<?php
/*
    MyApps version 1.0
    Copyright (C) 2020  ramy ibrahim - www.ramy.pro - ramy_mix@live.com

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/


class gtmix_app{
	
	function __construct() {
       
		$this->wp_main_url = $this->get_wp_main_url();
        $this->main_dir_url = $this->wp_main_url.'/wp-content/plugins/'.$this->main_dir_name;
		
		$this->apps_dir_url = $this->main_dir_url.'/apps' ;
        
		$this->html_template_url = $this->main_dir_url.'/html_templates' ;
		
		


    }
	
	public $wp_main_url;
	public $main_dir_name = 'MyApps_www.ramy.pro';
	public $main_dir_url; 
	
	private $app_info_patt = '/%_app_(name|version|desc|developer|site|icon|home):.+_%/m';
    public $apps_dir_name = 'apps';
	private $apps_dir =__DIR__.'/apps';
	public $apps_dir_url;
	public $html_template_url;
	
	public $html_apps_items_dashboard = __DIR__.'/html_templates/apps_items_dashboard.html';
	public $html_apps_items_site = __DIR__.'/html_templates/apps_items_site.html';
	
	public $html_templates_dir =__DIR__.'/html_templates' ;
	
	private $html_template_items_dashboard = '
	   <div id="%_id_%">
	   <div>
	 
	   <img src="%_icon_%" style="width:30px; padding-right:5px;" align="left">
	   <h3>%_name_%</h3>
	   </div>
	   
	   <div>
	      Version: %_version_%
		  <br>Developed By: %_developer_%
		  <br>Home Page: %_site_%
		   <br><br> %_desc_%
		   
		   <br><br>%_delete_%
		   
	   </div>
	   <hr/>
	   </div>
	
	';
	
	
	private $html_template_items_site = '
	   
	   <div style="text-align:center;">
	      %_icon_button_%
	     <h3>%_name_%</h3>
	   <div>

	';
	
	
	private function get_wp_main_dir(){
	       
			return str_ireplace('\wp-content\plugins\\'.$this->main_dir_name  ,'',__DIR__);
	}
	
	public function get_wp_main_url(){
	
		
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') $protocol = 'https://';else $protocol = 'http://';
        
		if($wp_admin = strpos($_SERVER['PHP_SELF'],'wp-admin')){
			$pos = $wp_admin;
		
		}elseif($wp_content = strpos($_SERVER['PHP_SELF'],'wp-content')){
			$pos = $wp_content;
			
		}elseif($wp_inc = strpos($_SERVER['PHP_SELF'],'wp-includes')){
			$pos = $wp_inc;
			
		}elseif($wp_index = strpos($_SERVER['PHP_SELF'],'index.php')){
			$pos = $wp_index;	
			
		}else{
			$pos = false;
		}
	
		if($pos != false){
			
			if($pos ==1){
				
				$main_dir = $protocol.$_SERVER['HTTP_HOST'];
				
			}else{
				$extra = substr($_SERVER['PHP_SELF'],0,$pos-1);
				
				$main_dir = $protocol.$_SERVER['HTTP_HOST'].$extra;
			}
		}else{
			$main_dir = $protocol.$_SERVER['HTTP_HOST'];
		}
		

         return $main_dir;
		

		
	}
	
	
	private function extract_app_info($data){
		// retrun false or array contan a element name as key and the value
        
            
		   if(preg_match_all($this->app_info_patt, $data, $matches)){
			   
			  
			   $arrback = array();
			   
			   for($l=0; $l<=(count($matches[0])-1);$l++){
				   
				   $code = $matches[0][$l];
				   $elem = $matches[1][$l];
				   
				   $arrback[$elem] = str_ireplace(array('%_app_'.$elem.':','_%'),'',$code);
			   }
		       
			   return $arrback;
		   }else{
			   return false;
		
		   }       
     
    }
	
	
	
	public function get_app_info($dir_name){
		//return false if error in data or index.php not exists
		
		//**check dir
		if(is_dir($this->apps_dir.'/'.$dir_name)){
			
			//**check index file
			if(is_file($this->apps_dir.'/'.$dir_name.'/index.php')){
				
				//**read data and get info
				$data =  file_get_contents($this->apps_dir.'/'.$dir_name.'/index.php');
				$app_info = $this->extract_app_info($data);
				
				if(is_array($app_info)){
					
					if(!isset($app_info['home'])){
						
						return false;
					}else{
						
						//--- set home link
						$app_info['home'] = $this->apps_dir_url.'/'.$dir_name.'/'.$app_info['home'] ;
						
						//---- Set Icon link
						  if(isset($app_info['icon'])){
							  $app_info['icon'] = $this->apps_dir_url.'/'.$dir_name.'/'.$app_info['icon'];
						  }else{
							   $app_info['icon'] = $this->main_dir_url .'/images/icon.png';
						  }
						
						//set not exist values
						if(!isset($app_info['name'])) $app_info['name'] = $dir_name;
						if(!isset($app_info['version'])) $app_info['version'] = '';
						if(!isset($app_info['developer'])) $app_info['developer'] = '';
						if(!isset($app_info['site'])) $app_info['site'] = '';
						
						return $app_info;
					}
					
				}else{
					
					return false;
				}
				//**************************
				
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
	
	
	
	public function get_apps_list(){
		
		$dirsList = scandir($this->apps_dir);
		
		if(!$dirsList){
			return false;
		
		}else{
			unset($dirsList[0]);
		    unset($dirsList[1]);
		    $Apps_List = array_values($dirsList);
			
			$arr_list = array();
			
			foreach($Apps_List as $dir_name){
				
				$dir_inf = $this->get_app_info($dir_name);
				
				if($dir_inf){
					$arr_list[$dir_name] = $dir_inf ;
				}
				
				
			}
			//end for
			return $arr_list;
			
		}
		
		
		
	}
    
    
	
	
    public function print_apps_list($template_full_dir = '' ,$location = 'site'){
		
		if($template_full_dir=='') $template_full_dir = $this->html_apps_items_site;
		
		$apps_list = $this->get_apps_list();

		if(!$apps_list){
			return false;
			
		}else{
		   
			// Get Items Templates
		  if(is_file($template_full_dir)) $template = file_get_contents($template_full_dir);
			if(!isset($template) || !$template || empty(trim($template)) ){
				
				
				if($location == 'dashboard'){
					  $template = $this->html_template_items_dashboard;
				}else{
					$template = $this->html_template_items_site;
				}
				
			} 
			
			$items_page='';
			
			
			
			
			
			//this will loop in the dirs
			foreach($apps_list as $dir=>$info){
				
				$reset_template = $template ;
				
				if($location == 'dashboard'){
				$delete_button = '<button id="del_'.$dir.'" >Uninstall</button>';
				$div_id = 'block_'.$dir;
					
				}else{
					$delete_button='';
					$div_id = '';
				}
				
				$icon_button = '<button id="run_'.$dir.'" title="Run '.$dir.'" style = "background-color:transparent;border:0px;"><img style="width:100%;" src="'.$info['icon'].'"  ></button>';
				
				  //this will loop in a values to do replace
				  foreach($info as $key=>$value){
		
					  $reset_template = str_ireplace('%_'.$key.'_%',$value,$reset_template);
				  }
				
				//replace delete button
				$reset_template = str_ireplace('%_delete_%',$delete_button ,$reset_template);
				
				$reset_template = str_ireplace('%_id_%',$div_id,$reset_template);
				$reset_template = str_ireplace('%_templates_path_%',$this->html_template_url,$reset_template);
				$reset_template = str_ireplace('%_icon_button_%',$icon_button,$reset_template);
				
				
				$items_page .= $reset_template;
			}
			
			
			return $items_page;
		}
	}
	
	
	
	private function html_templates_arr(){
		
		//Set Codes
		$code_apps_items_dashboard = '
		<div id="%_id_%">
	   <div>
	 
	   <img src="%_icon_%" style="width:30px; padding-right:5px;" align="left">
	   <h3>%_name_%</h3>
	   </div>
	   
	   <div>
	      Version: %_version_%
		  <br>Developed By: %_developer_%
		  <br>Home Page: %_site_%
		   <br><br> %_desc_%
		   
		   <br><br>%_delete_%
		   
	   </div>
	   <hr/>
	   </div>
		';
		
		$code_apps_items_site = '
		<div style="text-align:center;">
	      %_icon_button_%
	     <h3>%_name_%</h3>
	   <div>
		';
		//End Set Codes
		
		return array(
		    'apps_list_items_dashboard' =>array('file'=>__DIR__.'/html_templates/apps_items_dashboard.html',
											    'code' => $code_apps_items_dashboard  
											   ),
			
			 'apps_list_items_site' 	=>array('file'=>__DIR__.'/html_templates/apps_items_site.html',
												'code' => $code_apps_items_site  
				 
			 									),
			'apps_list_dashboard_form' 	=>array('file'=>__DIR__.'/html_templates/apps_list_page_dashboard.html',
												'code' => '%_apps_list_%'  
				 
			 									),
			
			'apps_list_site_form' 	=>array('file'=>__DIR__.'/html_templates/apps_list_page_site.html',
												'code' => '%_apps_list_%'  
				 
			 									)
		);
		
	}
	/*get_forms($form_name,$arr=null)
	$form_name:
	applist_dashboard
	applist_site
	
	$arr:
	array('full path dir to the template file')
	
	return string or false
	*/
	public function get_forms($form_name,$arr=null){
		
		$get_templates = $this->html_templates_arr();
		
			
			
		switch (strtolower($form_name)){
				
			case 'applist_dashboard':
				
				//get applications list and save it in $list variable
				if($arr !=null){
					$list = $this->print_apps_list($arr[0],'dashboard');
					
					if($list === false){
						$list = '<h3>no applications!</h3>';
					}
					
				}else{
					$list = $this->print_apps_list($get_templates['apps_list_items_dashboard']['file'],'dashboard');
					
					if($list === false){
						$list = '<h3>no applications!</h3>';
					}
				}
				//end get applications list
				
				//set install application form
				
				$install_form = '
				<div id="gtmix_install">
				
				<section id="gtmix_upload_form">
				<input type="file" id="myfile" name="myfile" accept="application/zip"><input type="button" value="install" id="do_upload">
				</section>
				
				<section style="display:none;" id="gtmix_installing_form">
				 installing...
				</section>
				
				</div>
				
				';
				
				//end install application form
				
				
				$codelist = array();
				$codelist['code'][]='%_install_%';
				$codelist['value'][]=$install_form ;
				
				$codelist['code'][]='%_main_path_url_%';
				$codelist['value'][]=$this->main_dir_url ;
				
				$codelist['code'][]='%_apps_list_%';
				$codelist['value'][]=$list ;
				
				//--- set page template
				$readFile = file_get_contents($get_templates['apps_list_dashboard_form']['file']);
				if(!$readFile){
					$page_template = $get_templates['apps_list_dashboard_form']['file'];
				}else{
					$page_template =$readFile;
				}
				  
				return str_ireplace($codelist['code'],$codelist['value'],$page_template);
				break;
				
				
				
			case 'applist_site':
				
				//get parama for print_apps_list
				if($arr !=null){
					$list = $this->print_apps_list($arr[0],'site');
					
				}else{
					$list = $this->print_apps_list($get_templates['apps_list_items_site']['file'],'site');
				}
				
				$codelist = array();
				$codelist['code'][]='%_main_path_url_%';
				$codelist['value'][]=$this->main_dir_url ;
				
				$codelist['code'][]='%_apps_list_%';
				$codelist['value'][]=$list ;
				
				
				//--- set page template
				$readFile = file_get_contents($get_templates['apps_list_site_form']['file']);
				if(!$readFile){
					$page_template = $get_templates['apps_list_site_form']['file'];
				}else{
					$page_template =$readFile;
				}
				  
				return str_ireplace($codelist['code'],$codelist['value'],$page_template);
				
				
				break;
				
			default:
				return false;
				
				break;
				
		}
		
		
	}
    
	
	private function get_max_upload_size(){
		
		require_once('applexe_pk/dir_files.php');
		    $applexe = new applexe_fd;
			
			
			if ($max_size = ini_get('upload_max_filesize')){
		
				$getsizetype =  preg_replace('/[^a-zA-Z]/','',$max_size);
				
				if( strtoupper($getsizetype ) == 'M'){
					$sizeTypeFrom = 'mb';
				}elseif(strtoupper($getsizetype ) == 'G'){
					$sizeTypeFrom = 'gb';
				}
				
				
				if(!isset($sizeTypeFrom)){
					return false;
				}else{
					
					$getsize =  preg_replace('/[^0-9.]/','',$max_size);
					
					return $applexe->convert_size($getsize,'mb',$ConvertTo="byt");
					
				}
				
				
			}
		
		
	}
	
	
	//*********** Delete App 
	public function delete_app($app_name,$return = true){
		
		
		
 
		
		if( isset($_POST['log']) && $this->get_log_id() == $_POST['log'] ) { 
				
			require_once('applexe_pk/dir_files.php');
		    $applexe = new applexe_fd;
			
			if ($applexe->remove_dir($this->apps_dir.'/'.$app_name) !==false){
				
				if($return)return true ;else echo 'app uninstalled successfully';
				
			}else{
				if($return)return false ;else echo 'app has not uninstalled';
			}
			
			
		}else{
			
			if($return)return false ;else echo 'not allowed to do this action!';
		}
		
	}
	
	
	
	
	
	/*Install App*/
	public function install_app($return=true){
		
		$state = array();
		
		if( isset($_FILES['myfile']) ) { 
			
			if($_FILES['myfile']['size'] < $this->get_max_upload_size() && $_FILES['myfile']['type'] == 'application/x-zip-compressed'){
				
				$generatName = date('dmyGi').rand(1000,10000).'.zip';
				if(!is_dir(__DIR__.'/tmp')){
					mkdir(__DIR__.'/tmp');
				}
				
				$upload = move_uploaded_file($_FILES['myfile']['tmp_name'],__DIR__.'/tmp/'.$generatName);
				
				if(!$upload){
					
					$state = array('state'=>false,'msg'=> 'Error: can not upload this file!' );	
				    if($return)return $state  ;else echo $state['msg'] ;
					
				}else{
					
					require_once('applexe_pk/dir_files.php');
					require_once('applexe_pk/zip.php');
					
		            $applexe_file = new applexe_fd;
					$applexe_zip = new applexe_zip;
					
					
					if(is_file(__DIR__.'/tmp/'.$generatName)){
					    /// check files
						
					
						
						$getMainFolder = $applexe_zip->get_dirs(__DIR__.'/tmp/'.$generatName);
						
				
						if (count($getMainFolder) != 1){
						 	
							 $state = array('state'=>false,'msg'=> 'Error: Unable to install this file there are many folders in a main dir!' );	
							if($return)return $state  ;else echo $state['msg'] ;
						
							
						}elseif($getMainFolder === false){
							
							$state = array('state'=>false,'msg'=> 'Error: Unable to install this file!' );	
							if($return)return $state  ;else echo $state['msg'] ;
							
						}else{
							
						  $findIndex = $applexe_zip->find_item(__DIR__.'/tmp/'.$generatName,$getMainFolder[0].'index.php');
							if($findIndex  == null){
								
								 $state = array('state'=>false,'msg'=> 'Error: Unable to install this file! - the info file not exists!' );	
								 if($return)return $state  ;else echo $state['msg'] ;
								 
							}elseif(!$findIndex){
								 
								 $state = array('state'=>false,'msg'=> 'Error: Unable to install this file! - Error in a get info!' );	
								 if($return)return $state  ;else echo $state['msg'] ;
							 	 
							 }else{
								
								     
								$getIndex = $applexe_zip->get_file_content(__DIR__.'/tmp/'.$generatName,$getMainFolder[0].'index.php');
								$datainfo  = $this->extract_app_info($getIndex);
					
								if (!$datainfo){
										
									   $state = array('state'=>false,'msg'=> 'Error: Unable to install this file! - index.php does not include an application info!' );	
								       if($return)return $state  ;else echo $state['msg'] ;
								}else{
									
								  $installFile = $applexe_zip->extract_file(__DIR__.'/tmp/'.$generatName,$this->apps_dir.'/' );
							
									
								  if($installFile === true){
									  
									  echo 'Application Installed Successfully';
								  
								  }else{
									  echo $installFile[0]; 
									  
								  }
									
								}
								
								 
							 }
							
							
						}						
						
						unlink(__DIR__.'/tmp/'.$generatName);
						
					
						
					}else{
						$state = array('state'=>false,'msg'=> 'Error: Unable to install this file!' );	
				       if($return)return $state  ;else echo $state['msg'] ;
					}
					
					
				}
				
				
				
			}else{
				$state = array('state'=>false,'msg'=> 'the file size larg than the max limit: '.ini_get('upload_max_filesize') .' or not ZIP file!');	
				if($return)return $state  ;else echo $state['msg'] ;
				
			}
			
			
		}else{
			
			$state = array('state'=>false,'msg'=> 'not allowed to do this action!');	
			
			if($return)return $state  ;else echo $state['msg'] ;
			
		}
		
		
	}
	
	
	
	/**Get Log in id*/
	public function get_log_id(){
		
		if(isset($_COOKIE)){
			
			foreach($_COOKIE as $key=>$value){
				
				  
				
				if(preg_match('/wordpress_logged_in_+/',$key)){
					
					return  $key;
					break;
				}
			}
			
			
		}else{
			return false;
		}
	}
	
	
	public function send_app_info(){
		
		if(isset($_POST['app_name'])){
			
			$info = $this->get_app_info($_POST['app_name']);
			
			if(!$info){
				echo 'false';
			}else{
				echo '%_keys: '.implode('_,_',array_keys($info)).' _% %_values: '.implode("_,_",$info).' _%';
				
				
			}
		}else{
			echo 'false';
		}
		
	}
	
	
	public function display_app_info_form(){
		
		if(isset($_POST['app_name'])){
			
			$info = $this->get_app_info($_POST['app_name']);
			
			if(!$info){
				echo 'cannot display an information for this application!';
			}else{
				echo '
				     <img src="'.$info['icon'].'" style="width:75px;" title="'.$info['name'].'" alt="'.$info['name'].'"  >
				    <h2>'.$info['name'].'</h2>
				      <h3>
					  Version: '.$info['version'].'
					  <br>Developer: '.$info['developer'].'
					  <br>Home Page: <a href="'.$info['site'].'" target="_blank">'.$info['site'].'</a>
					  <br>
					  '.$info['desc'].'
					  </h3>
				
				
				';
				
			}
		}else{
			echo 'Error: cannot do this requist!';
		}
		
		
	}
	
	
	public function forms_design_load(){
		
		if(isset($_POST['form_name'])){
			
			switch($_POST['form_name']){
				
				case 'app_form':
					$file_path = $this->html_templates_dir.'/apps_list_page_site.html';
					break;
					
				case 'app_items':
					$file_path = $this->html_templates_dir.'/apps_items_site.html';
					break;
					
			}
			
			$form_content = file_get_contents($file_path);
			
			if($form_content){
				echo $form_content;
				
			}else{
				echo 'false';
			}
			
		}else{
			echo 'false';
		}
		
	}
	
	
	public function forms_design_save(){
		
		if(isset($_POST['form_name']) && isset($_POST['set_content'])){
			
			switch($_POST['form_name']){
				
				case 'app_form':
					$file_path = $this->html_templates_dir.'/apps_list_page_site.html';
					break;
					
				case 'app_items':
					$file_path = $this->html_templates_dir.'/apps_items_site.html';
					break;
					
			}
			
			require_once('applexe_pk/dir_files.php');
			
			$applexe = new applexe_fd;
			
			if($applexe->file_write($file_path,$_POST['set_content'])){

				echo 'true';
				
			}else{
				echo 'false';
			}
			
			
		}else{
			echo 'false';
		}
	}
	
	
	public function add_run_in_counter(){
		
		if (isset($_POST['app_name'])){
			
			
			    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        			
					$ip = $_SERVER['HTTP_CLIENT_IP']; //get ip
					
				}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];//ip from share internet 
				
				}else{
					$ip = $_SERVER['REMOTE_ADDR'];//ip pass from proxy
				}
				
				$ip = base64_encode ( $ip );
				$ip = base64_encode ( $ip );
			  
			
			
			if(is_file($this->apps_dir.'/'.$_POST['app_name'].'/run-c.xml')){
				
				$xml = new DOMDocument();
				$xml->load($this->apps_dir.'/'.$_POST['app_name'].'/run-c.xml');
				$root = $xml->getElementsByTagName('app')->item(0);
				
			}else{
				$xml = new DOMDocument('1.0');
				$root = $xml->createElement('app');
				
				$attr_app_name = $xml->createAttribute('app_name');
				$attr_app_name->appendChild($xml->createTextNode($_POST['app_name']));
				
				$root->appendChild($attr_app_name);
				
				$xml->appendChild($root);
			}
			
			$info = 'run in '.date('M/d/Y - h:i:s A');
				$new_log = $xml->createElement('log',$info);
				
				$attr_y = $xml->createAttribute('y');
				$attr_y->appendChild($xml->createTextNode(date('Y')));
				
				$attr_m = $xml->createAttribute('m');
				$attr_m->appendChild($xml->createTextNode(date('n')));
				
				$attr_d = $xml->createAttribute('d');
				$attr_d->appendChild($xml->createTextNode(date('j')));
				
				$attr_y_m = $xml->createAttribute('y_m');
				$attr_y_m->appendChild($xml->createTextNode(date('Y-n')));
				
				$attr_y_m_d = $xml->createAttribute('y_m_d');
				$attr_y_m_d->appendChild($xml->createTextNode(date('Y-n-j')));
				
				$attr_h = $xml->createAttribute('h');
				$attr_h->appendChild($xml->createTextNode(date('g')));
				
				$attr_min = $xml->createAttribute('min');
				$attr_min->appendChild($xml->createTextNode(date('i')));
				
				$attr_c = $xml->createAttribute('code');
				$attr_c->appendChild($xml->createTextNode($ip));
				
				$new_log->appendChild($attr_d);
				$new_log->appendChild($attr_m);
				$new_log->appendChild($attr_y);
				$new_log->appendChild($attr_y_m);
				$new_log->appendChild($attr_y_m_d);
			
			
				$new_log->appendChild($attr_h);
				$new_log->appendChild($attr_min);
				$new_log->appendChild($attr_c);
				
				$root->appendChild($new_log);
			
			$xml->formatOutput = true;
			$xml->save($this->apps_dir.'/'.$_POST['app_name'].'/run-c.xml');
				return true;
			
		}else{
			return false;
		}
		
	}
	
	
    
}

?>