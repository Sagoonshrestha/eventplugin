<?php

namespace Codemanas\Eventplugin;

class Bootstrap {
	public static $instance = null;

	public static function get_instance() {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function __construct() {
		require_once CUSTOM_PLUGIN_DIR_PATH . '/vendor/autoload.php';
		add_action( 'plugins_loaded', [ $this, 'load_modules' ] );
	}

	public function load_modules(  ) {
		PostType::get_instance();
		CustomTaxomony::get_instance();
        ShortcodeContent::get_instance();
        EventTable::get_instance();
	}
}

Bootstrap::get_instance();