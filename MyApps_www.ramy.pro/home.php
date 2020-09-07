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

function MyApps_home(){
 require_once("cls.php");
 $app = new gtmix_app;
	
	?>
	<h1 style="padding: 10px;">Quickstart guide</h1>
<div class="contaner">
<h1>Version information</h1>
<p>
<br>Version: 1.0.0.0
<br>Developed by: ramy ibrahim  - <a href="https://ramy.pro" target="_blank">https://ramy.pro</a>	
	
<h2>License</h2>
<p>
MyApps version 1.0
    <br>Copyright (C) 2020  ramy ibrahim - www.ramy.pro - ramy_mix@live.com
<br>
   <br> This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
<br>
  <br>  This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
<br><br>
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <a href="https://www.gnu.org/licenses/" target="_blank">https://www.gnu.org/licenses/</a>.	
</p>
<h2>what's new?</h2>
- install your web application and run it on your website online.
<br>- manage your applications in "Apps List" section.
<br>- check how many times your applications have been run.
<br>- change the layout of the Apps buttons by simple way.
</p>

<h1>Quickstart</h1>
<p>
"My Apps" is a very useful tool that allows you to install and run your online web applications on your website.
<br>Check <a href="https://ramy.pro/#myapps" target="_blank">applications page</a>.
</p>
	

<p>
Simply, in the section you will see "Apps List", you can then install or uninstall your applications in just a few clicks.
</p>
<div style="text-align: center;"><img class="help_image"  src="<?php echo $app->main_dir_url ?>/images/help/001.jpg"  ></div>

<p>Add the shortcode <span style="color: royalblue;">[my_online_apps]</span>  on any page or in the theme template to display the buttons for the installed applications.

<div style="text-align: center;"><img class="help_image"  src="<?php echo $app->main_dir_url ?>/images/help/002.jpg"  ></div>
<p>
By pressing on the application button you will see it running on the window on your site.
</p>

<div style="text-align: center;"><img class="help_image"  src="<?php echo $app->main_dir_url ?>/images/help/003.jpg"  ></div>

<p>
In the section "Reports" you can see the short analysis about how many times your application has been run. Including date and time and the IP number of the user, with the ability to choose a specific date, month, or year. 
</p>

<div style="text-align: center;"><img class="help_image"  src="<?php echo $app->main_dir_url ?>/images/help/004.jpg"  ></div>

<p>You can change a layout of the buttons through "Forms Design" section using a blocks code.</p>
<div style="text-align: center;"><img class="help_image"  src="<?php echo $app->main_dir_url ?>/images/help/005.jpg"  ></div>	
	
<h1>Application Configuration</h1>
<p>
you must configure your application to install and run through "MyApps" by adding a configuration code in the index.php file for your application. 
<br>
The configuration code:
<pre>
&lsaquo;?php
/*
%_app_name: application name _%
%_app_version: 1.0.0.0 _%
%_app_desc: the description _%
%_app_developer: developer name _%
%_app_site: https://exmaple.com _%
%_app_icon: example.icon _%
%_app_home: example.html _%
*/
?&rsaquo;
</pre>	
	
</p>
	
<p>Make sure to comprising the main folder of the application in one "zip" file.</p>
</div>


	<?php
}

MyApps_home();
?>


