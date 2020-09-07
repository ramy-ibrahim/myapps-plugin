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

/**
         * Plugin Name: MyApps
         * Plugin URI: https://ramy.pro
         * Description: manage your online apps
         * Version: 1.0.0.0
         *
         * Author: ramy ibrahim. <ramy_mix@live.com>
         * Author URI: https://ramy.pro/#myapps
         */

    //----------------startup



add_action('admin_menu', 'gtmix_app_create_menu');
     function gtmix_app_create_menu(){
       
		
            add_menu_page(
                'MyApps',
                'MyApps',
                'administrator',
                __FILE__,
                'gtmix_app_home',
                '../wp-content/plugins/MyApps_www.ramy.pro/icon.png'
            );
         
    
         /*
         add_dashboard_page( 'gtmix App',
                'gtmix App',
                'administrator',
                __FILE__,
                'welcome');
                
        */
       
         add_submenu_page(
         plugin_dir_path( __FILE__).'\gtmix_app.php',
        'MyApps - Apps List',
        'Apps List',
        'manage_options',
        'MyApps-app-list',
        'gtmix_app_section' 
         );
		 
		 add_submenu_page(
         plugin_dir_path( __FILE__).'\gtmix_app.php',
        'MyApps - Reports',
        'Reports',
        'manage_options',
        'MyApps-reports',
        'gtmix_app_reports' 
         );
         
         
         add_submenu_page(
         plugin_dir_path( __FILE__).'\gtmix_app.php',
        'MyApps - Forms Designer',
        'Forms Designer',
        'manage_options',
        'MyApps-forms-design',
        'gtmix_app_forms_design' 
         );
		 
         
        }

        


function gtmix_screen_form(){
	require_once('screen_form.php');
	return Get_Screen_Form();
}
add_shortcode( 'my_online_apps','gtmix_screen_form' );
add_filter('widget_text','do_shortcode');
 


//------------end startup

//---- Home Section
function gtmix_app_home(){
  require_once('head_section.php');
  require_once('home.php'); 
  require_once('foot_section.php');

}

//---- Applications List
function gtmix_app_section(){
	require_once('head_section.php');
    require_once('apps.php');
	require_once('foot_section.php');
	
	
}

//----- Reports
function gtmix_app_reports(){
	require_once('head_section.php');
    require_once('reports.php');
	require_once('foot_section.php');
}

//------ Help Sectionn
function gtmix_app_help(){
	require_once('head_section.php');
    require_once('help.php');
	require_once('foot_section.php');
}

function gtmix_app_forms_design(){
	require_once('head_section.php');
	require_once('forms_design.php');
	require_once('foot_section.php');
}

?>