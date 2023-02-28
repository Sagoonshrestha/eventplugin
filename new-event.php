<?php 
    /**
 * Plugin Name:       New Event Plugin
 * Plugin URI:        https://example.com/plugin-name
 * Description:       Description of the plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Your Name
 * Author URI:        https://example.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://example.com/my-plugin/
 */

 //DIRECTORY PATH
! defined( 'CUSTOM_PLUGIN_DIR_PATH' ) && define( 'CUSTOM_PLUGIN_DIR_PATH', dirname( __FILE__ ) );

//URL PATH
! defined( 'CUSTOM_PLUGIN_ASSETS_URL' ) && define( 'CUSTOM_PLUGIN_ASSETS_URL', plugin_dir_url( __FILE__).'assets/' );

require_once 'includes/Bootstrap.php';