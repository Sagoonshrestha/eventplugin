<?php 
namespace Codemanas\Eventplugin;

Class EventTable{
    public static $instance=null;

    public static function get_instance(){
        return is_null(self::$instance)?self::$instance = new self():self::$instance;
    }

    public function __construct(){
        //to add shortcode tag field in event post list.
        add_filter( 'manage_edit-events_columns', array( $this, 'column_head' ) );
        add_action( 'manage_posts_custom_column', array( $this, 'column_content' ), 10, 2 );
    }
    public function column_head( $columns ) {
        $columns = array(
            "cb"                       => "<input type='checkbox' />",
            "title"                    => "Title",
            "taxonomy-events_category" => 'Categories',
            'shortcodes'               => 'shortcode',
            "date"                     => "Date",
        );

        return $columns;
    }

    public function column_content( $column, $post_id ) {
        if ( $column == 'shortcodes' ) {
            $id = get_the_terms( $post_id, 'events_category' ); ?>
            <textarea>
                [cm_event <?php echo ( isset( $id ) && ! empty( $id ) ) ? "cat=" . $id[0]->term_id : ""; ?>]
            </textarea>
            <?php
        }
    }
}