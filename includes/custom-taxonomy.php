<?php 
register_taxonomy( 'events_category', 
        array('events'),
                array(
                    'hierarchical' => true,
                    'labels' => array(
                        'name' => __( 'Events Categories' ), 
                        'singular_name' => __( 'Events Category' ), 
                        'search_items' =>  __( 'Search Events Category' ), 
                        'all_items' => __( 'All Events Category' ),
                        'parent_item' => __( 'Parent Events Category' ), 
                        'parent_item_colon' => __( 'Parent Events Category' ), 
                        'edit_item' => __( 'Edit Events Category' ), 
                        'update_item' => __( 'Update Events Category' ), 
                        'add_new_item' => __( 'Add New Events Category' ),
                        )
                    )
                );