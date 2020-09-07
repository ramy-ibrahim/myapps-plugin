<?php
class applexe_zip{
	public function extract_file($from_file,$to_dir){
	   
		
		$err = array();
	   
	   if(!is_file($from_file)){
		   $err[] = 'file not exists';
	   
	   }elseif(!is_dir($to_dir)){
		    $err[] = 'dir not exists';
	   }else{
		   
		    $zip = new ZipArchive();
		    
		    if ($zip->open($from_file)){
				 
				if($zip->extractTo($to_dir)){
					$zip->close();
				
				}else{
					$err[]='unable to extracting this file!';
				}
				
				
			}else{
				 $err[] = 'can not open this file!';
			}
	   }
	   
	  
	   if(count($err)==0){
		   return true;
	   }else{
		   return $err;
	   }
	   
	         
   }
	
	
   public function get_item_name($file_path,$item_num){
	     $zip = new ZipArchive();
	   
	     if ($zip->open($file_path) == TRUE) {
			 
             $name =  $zip->getNameIndex($item_num);
			 $zip->close();
			 
         }else{
			 $name =  false;
		 }
	   
	   return $name;
	   
   }
	
   
   public function get_item_content($file_path,$item_num){
	   
	   $zip = new ZipArchive;
      if ($zip->open($file_path) === TRUE) {
		  
		  $content =  $zip->getFromIndex($item_num);
		  $zip->close();
		  
	  } else {
		  $content = false;
	  }
	   
	  return $content;
   }
	
	
	
	public function get_file_content($zip_file_path,$file_name){
		
		return file_get_contents('zip://'.$zip_file_path.'#'.$file_name);
		
	}
	
	
	public function find_item($zip_file_path,$item_name){
		
		$zip = new ZipArchive();
	    
		
	     if ($zip->open($zip_file_path) == true) {
		
			  $result = null;
			 
			 
			 for($l=0;$l<= ($zip->numFiles - 1);$l++){

				 
				  if ($zip->getNameIndex($l) == $item_name){
					  $result = $l;
					  break;
				  }
				 
			 }

			 $zip->close();
			 
			 return $result;
			 
         }else{
			 return false;
		 }
		
	}
	
	public function count($zip_file_path){
		
		$zip = new ZipArchive();
		if ($zip->open($zip_file_path) == TRUE) {
			
			$count = $zip->numFiles ;
			
			$zip->close();
			
			return $count;
		}else{
			 return false;
			
		}
	}
	
	
	public function get_dirs($file_path,$dir=''){
		
		$zip = new ZipArchive();
		if ($zip->open($file_path) == TRUE) {
			
			$count = $zip->numFiles ;
			$dirs_list = array();
			
			   for($l=0;$l<=($count-1); $l++){
				   
			
				  if(preg_match('/'.$dir.'.[^\/]+\//',$zip->getNameIndex($l),$match)){
					    
					  if(!in_array($match[0],$dirs_list)){
						  $dirs_list[] = $match[0];
					  }
					  
				   }
				   
				   
			   }
			
			
			$zip->close();
			
			
			return $dirs_list ;
			
			
			
		}else{
			 return false;
			
		}
		
	}
}

?>