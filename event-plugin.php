<?php

/*
  Plugin Name: event-plugin
  Plugin URI:  http://localhost
  Description: A plugin to build any type of forms
  Version:     1.0.0
  Author:     Me
  Author URI:  http://localhost
  License:     GPL2
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages
  Text Domain: event-plugin
 */


defined( 'ABSPATH' ) || exit; // Exit if accessed directly
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

require_once plugin_dir_path(__FILE__).'includes/class-event.php';