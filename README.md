# myapps-Wordpress plugin
MyApps Version 1.0.0.0
"My Apps" is a very useful tool that allows you to install and run your online web applications on your website.
Check applications page https://ramy.pro/#myapps

Simply, in the section you will see "Apps List", you can then install or uninstall your applications in just a few clicks.


Add the shortcode [my_online_apps] on any page or in the theme template to display the buttons for the installed applications.


By pressing on the application button you will see it running on the window on your site.


In the section "Reports" you can see the short analysis about how many times your application has been run. Including date and time and the IP number of the user, with the ability to choose a specific date, month, or year.


You can change a layout of the buttons through "Forms Design" section using a blocks code.


Application Configuration
you must configure your application to install and run through "MyApps" by adding a configuration code in the index.php file for your application.
The configuration code:

‹?php
/*
%_app_name: application name _%
%_app_version: 1.0.0.0 _%
%_app_desc: the description _%
%_app_developer: developer name _%
%_app_site: https://exmaple.com _%
%_app_icon: example.icon _%
%_app_home: example.html _%
*/
?›
Make sure to comprising the main folder of the application in one "zip" file.
