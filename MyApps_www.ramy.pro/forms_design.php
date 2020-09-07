<?php require_once('cls.php');

$gtmix = new gtmix_app;
?>

<style>
	.contaner button{
		padding: 5px 10px 5px 10px; font-size: 15px;
	}
</style>

<h1 style="padding: 15px;">Forms Designer</h1>

	
	<div class="contaner">
<button id="gtmix_go">Load</button> <select id="gtmix_sel_forms">
  <option value="0">Select Form</option>
  <option value="app_form">Apps Form</option>
  <option value="app_items">Apps Items</option>
</select>
	

 <button id="gtmix_save">Save</button>
<br><br>
<div id="form_name" style="font-size: 20px;padding: 10px;"></div>
<textarea placeholder="select form" id="gtmix_codes_area" style="width: 99%; height: 400px;"></textarea>
		
<h3>Help</h3>
<h4>you can change in design and the layout of the "Apps List form" using the following codes. </h3>		
	
		<table width="99%">
		<tr><th colspan="2"  style="text-align:left;">Apps Form</th></tr>
			
		 <tr>
		  <td width="120px">Code</td>
		  <td>Description</td>
		</tr>
			
		<tr>
		  <td >%_apps_list_%</td>
		  <td>Print installed applications items (depends on Apps Items Form).</td>
		</tr>
		
		<tr><th colspan="2" style="text-align:left;">Apps Items</th></tr>
		
		
		<tr>
		  <td>%_name_%</td>
		  <td>Print application's name.</td>
		</tr>
			
		<tr>
		  <td>%_version_%</td>
		  <td>Print application's version.</td>
		</tr>
			
		<tr>
		  <td>%_developer_%</td>
		  <td>Print application's developer's information.</td>
		</tr>
			
		<tr>
		  <td>%_desc_% </td>
		  <td>Print application's description.</td>
		</tr>
			
		<tr>
		  <td>%_site_%</td>
		  <td>Print Application's home page url.</td>
		</tr>
			
		<tr>
		  <td>%_icon_button_%</td>
		  <td>Print Application'a run button with the icon.</td>
		</tr>
		
		</table>
</div>

<script type="application/javascript" src="<?php echo $gtmix->main_dir_url ?>/load_script.php?name=ajax"></script>
<script type="application/javascript" src="<?php echo $gtmix->main_dir_url ?>/load_script.php?name=design_form"></script>