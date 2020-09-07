<h1 style="padding-left: 10px;">Reports</h1>
<div style="background-color: #fff; width: 94%; border-radius: 10px; margin: auto; padding: 10px;">
Apps List <select id="sel_app"><option value="con">Select App</option>
<?php
require_once('cls.php');

$gtmix = new gtmix_app;
  
	$apps = $gtmix->get_apps_list();
	
	if($apps != false){
		
		foreach($apps as $dir=>$info){
			echo '<option value="'.$dir.'">'.$info['name'].'</option>';
		}
	}

?>
</select>
<br>Report By: <input type="radio" name="by"  checked id="today">today &nbsp;
&nbsp;<input type="radio" name="by" id="date">Date 
&nbsp;<input type="radio" name="by" id="month">Month
 &nbsp;<input type="radio" name="by" id="year">Year
 &nbsp;<input type="radio" name="by" id="ip">ip &nbsp;<button id="btn_get_report">Get Report</button>
 <br>
 
  <select id="sel_year" style="display:none">
 <option value="0">Year</option>
 <?php
 
  if(date('Y') == 2019){
	   echo '<option value="2019">2019</option>';
  }else{
	  
	  $limit = date('Y') - 2019;
	  
	  for($l=0;$l<=$limit; $l++){
	   
	      echo '<option value="'.(date('Y') - $l).'">'.(date('Y') - $l).'</option>';
	   	  
       }
	  
	  
  }
   
   
 ?>
 </select>
 
 <select id="sel_month" style="display:none">
 <option value="0">Month</option>
 <?php
 require_once('applexe_pk/lists.php');
   $mod_list = new applexe_lists;
   
   $getMonthes = $mod_list->months('eng');
   
   for($l=0;$l<=11; $l++){
	   
	   echo '<option value="'.($l+1).'">'.$getMonthes[$l].'</option>';
   }
   
 ?>
 </select>
 
 
 
  <select id="sel_day" style="display:none">
 <option value="0">Day</option>
 <?php
 
   $add_zero;
   for($l=1;$l<=31; $l++){
	   
	   if($l<10) $add_zero = "0"; else $add_zero= '';
	   	   echo '<option value="'.$l.'">'.$add_zero.$l.'</option>';
   }
   
 ?>
 </select>
 
 <input type="text" id="ip_num" placeholder="IP Number" style="display:none">
 
<br>
<hr>
<div id="report_content" style="font-size: 15px;">Select App</div>
</div>

<script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=global' ?>"></script>
<script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=ajax' ?>"></script>
<script type="application/javascript" src="<?php echo $gtmix->main_dir_url.'/load_script.php?name=reports' ?>"></script>


