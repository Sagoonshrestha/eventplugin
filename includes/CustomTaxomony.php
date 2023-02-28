<?php

namespace Codemanas\Eventplugin;

class CustomTaxomony{
	public static $instance = null;

	public static function get_instance() {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function __construct() {
		add_action( 'init', [ $this, 'register_custom_taxomony' ] );
	}

	/**
	 * Register a custom post type called "book".
	 *
	 * @see get_post_type_labels() for label keys.
	 */
	public function register_custom_taxomony() {
		$labels = array(
            'name'              => __( 'Events Categories' ),
			'singular_name'     => __( 'Events Category' ),
			'search_items'      => __( 'Search Events Category' ),
			'all_items'         => __( 'All Events Category' ),
			'parent_item'       => __( 'Parent Events Category' ),
			'parent_item_colon' => __( 'Parent Events Category' ),
			'edit_item'         => __( 'Edit Events Category' ),
			'update_item'       => __( 'Update Events Category' ),
			'add_new_item'      => __( 'Add New Events Category' ),
        );
        $args = array(
            'labels'=>$labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,  
        );

		register_taxonomy( 'events_category', array( 'events' ), $args );
	}


}