<?php

namespace Codemanas\Eventplugin;

class PostType {
	public static $instance = null;

	public static function get_instance() {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function __construct() {
		add_action( 'init', [ $this, 'register_post_type' ] );
	}

	/**
	 * Register a custom post type called "events".
	 *
	 * @see get_post_type_labels() for label keys.
	 */
	public function register_post_type() {
		$labels = array(
            'name'               => __( 'Events' ),
            'singular_name'      => __( 'Events' ),
            'all_items'          => __( 'All Eventss' ),
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => __( 'Add New Events' ),
            'edit'               => __( 'Edit Events' ),
            'edit_item'          => __( 'Edit' ),
            'new_item'           => __( 'New Post Events' ),
            'view_item'          => __( 'View Eventss' ),
            'search_items'       => __( 'Search Eventss' ),
            'not_found'          => __( 'Nothing found in the Database.' ),
            'not_found_in_trash' => __( 'Nothing found in Trash' ),
            'parent_item_colon'  => '',
        );

		$args = array(
			'labels'             => $labels,
			'public'              => true,
		    'publicly_queryable'  => true,
		    'exclude_from_search' => false,
		    'show_ui'             => true,
		    'query_var'           => true,
		    'menu_position'       => 27,
		    'has_archive'         => true,
		    'capability_type'     => 'post',
		    'hierarchical'        => false,
		    'supports'            => array( 'title', 'editor', 'thumbnail' ),
		);

		register_post_type( 'events', $args );
	}


}