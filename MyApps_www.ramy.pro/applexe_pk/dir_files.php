<?php
class applexe_fd{
	
	/*remove_dir($Path)*/
	public function remove_dir($Path){
		
	foreach(glob("{$Path}/*") as $file)
    {
        if(is_dir($file)) { 
           $this->remove_dir($file);
			
        } else {
			chmod($file, 0750);
            unlink($file);
        }
    }
    if(rmdir($Path)){
		return true;
	}else{
		return false;
	}
	
	
	
   }
	

	
	
	/*Convert_Size(Number,$From="",$To="")
	
	From  > Choos one("bit","byt","kb","mb","gb","tb","pb")
	To  > Choos one("all","bit","byt","kb","mb","gb","tb","pb")
	
	if To > all - return Array
	if To > ("bit","byt","kb","mb","gb","tb","pb") - return result number
	
	*/
	public function convert_size($Number,$From="",$ConvertTo=""){
				
		
		$Num = (float) $Number;
		
		$To = strtolower($ConvertTo);
		$From = strtolower($From);
		
		$ArrKey = array("bit","byt","kb","mb","gb","tb","pb");
		
		if(array_search($From,$ArrKey) === false){
			return false;
			
		}else if(array_search($To,$ArrKey) === false  && $To !="all"){
			return false;
		
		}else{
		
		if($From == "bit"){
		    
			$Arr = array();
			$Arr["bit"] = $Num;
			$Arr["byt"] = $Arr["bit"]/8;
			$Arr["kb"] = $Arr["byt"]/1024;
			$Arr["mb"] = $Arr["kb"]/1024;
			$Arr["gb"] = $Arr["mb"]/1024;
			$Arr["tb"] = $Arr["gb"]/1024;
			$Arr["pb"] = $Arr["tb"]/1024;
			
			
			
		}else if($From == "byt"){
			
			$Arr = array();
			$Arr["bit"] = $Num*8;
			$Arr["byt"] = $Num;
			$Arr["kb"] = $Arr["byt"]/1024;
			$Arr["mb"] = $Arr["kb"]/1024;
			$Arr["gb"] = $Arr["mb"]/1024;
			$Arr["tb"] = $Arr["gb"]/1024;
			$Arr["pb"] = $Arr["tb"]/1024;
			
			
			
		}else if($From == "kb"){
			
			$Arr = array();
			
			$Arr["byt"] = $Num*1024;
			$Arr["bit"] = $Arr["byt"]*8;
			
			$Arr["kb"] = $Num;
			$Arr["mb"] = $Arr["kb"]/1024;
			$Arr["gb"] = $Arr["mb"]/1024;
			$Arr["tb"] = $Arr["gb"]/1024;
			$Arr["pb"] = $Arr["tb"]/1024;
		
		
		}else if($From == "mb"){
			
			
			$Arr = array();

			$Arr["kb"] = $Num*1024;
			$Arr["byt"] = $Arr["kb"]*1024;
			$Arr["bit"] = $Arr["byt"]*8;
			
			$Arr["mb"] = $Num;
			$Arr["gb"] = $Arr["mb"]/1024;
			$Arr["tb"] = $Arr["gb"]/1024;
			$Arr["pb"] = $Arr["tb"]/1024;
			
		
		
		}else if($From == "gb"){
			
			$Arr = array();
	
			$Arr["mb"] = $Num*1024;
			$Arr["kb"] = $Arr["mb"]*1024;
			$Arr["byt"] = $Arr["kb"]*1024;
			$Arr["bit"] = $Arr["byt"]*8;
			
			$Arr["gb"] = $Num;
			$Arr["tb"] = $Arr["gb"]/1024;
			$Arr["pb"] = $Arr["tb"]/1024;
		
		
		}else if($From == "tb"){
			
			$Arr = array();

			$Arr["gb"] = $Num*1024;
			$Arr["mb"] = $Arr["gb"]*1024;
			$Arr["kb"] = $Arr["mb"]*1024;
		    $Arr["byt"] = $Arr["kb"]*1024;
			$Arr["bit"] = $Arr["byt"]*8; 
			 
			$Arr["tb"] = $Num;
			$Arr["pb"] = $Arr["tb"]/1024;
		
		
		
		
		}else  if($From == "pb"){
			
			
			$Arr = array();
 
			$Arr["pb"] = $Num; 
			$Arr["tb"] = $Num*1024;
			$Arr["gb"] = $Arr["tb"]*1024;
			$Arr["mb"] = $Arr["gb"]*1024;
			$Arr["kb"] = $Arr["mb"]*1024;
		    $Arr["byt"] = $Arr["kb"]*1024;
			$Arr["bit"] = $Arr["byt"]*8; 
		
		   	
		}
		
		    if($To == "all"){
			
			   return $Arr;
		    
			}else{
				
				return $Arr[$To];
				
			}
		
	 }
		
		
  }
	
  
	
  public function file_write($file_path,$content,$update = false){
	  
	  if($update === true) $mood = 'w+';else $mood = 'w';
	  
	  $getfile = fopen($file_path, $mood);
      
	  if($getfile){
		    
		   if(fwrite($getfile, $content)) $state = true;else $state = false;
	   
		  fclose($getfile);
		  
		  return $state;
		  
	  }else{
		  return false;
	  }
    
  }
}
?>