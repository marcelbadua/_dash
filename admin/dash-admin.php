<?php
/*
Plugin Name: Dash Admin
Plugin URI:
Description: Dash Admin
Version: 1.0
Author: Marcel Badua
Author URI: https://github.com/marcelbadua
License: GPL2
*/
/*
Copyright 2016  Marcel Badua  (email : bitterdash@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('DASH_ADMIN'))
{
	class DASH_ADMIN
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{

			foreach (scandir(dirname(__FILE__). '/inc') as $filename) {
			    $path = dirname(__FILE__) . '/inc/' . $filename;
			    if (is_file($path)) {
			        require $path;
			    }
			}

		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			// $settings_link = '<a href="options-general.php?page=wp_plugin_CONSTRUCT">Settings</a>';
			// array_unshift($links, $settings_link);
			// return $links;
		}


	} // END class DASH_ADMIN
} // END if(!class_exists('DASH_ADMIN'))

if(class_exists('DASH_ADMIN'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('DASH_ADMIN', 'activate'));
	register_deactivation_hook(__FILE__, array('DASH_ADMIN', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_CONSTRUCT = new DASH_ADMIN();

}
