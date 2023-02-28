<?php 

namespace Codemanas\Eventplugin;

Class ShortcodeContent{
    public static $instance = null;

    public static function get_instance(){
        return is_null(self::$instance)?self::$instance = new self():self::$instance;
    }

    public function __construct(){
        add_shortcode( 'cm_event', [$this, 'event_shortcode'] );
        add_action( 'wp_enqueue_scripts', [$this, 'script_enqueue'], 100 );
    }

    public function script_enqueue(){
        wp_register_script('custom-script', CUSTOM_PLUGIN_ASSETS_URL. 'js/custom.js', array('jquery'),'1.0.0',true);
        wp_enqueue_script( 'custom-script');
        wp_register_script('lightbox-script', CUSTOM_PLUGIN_ASSETS_URL.'js/glightbox.min.js');
        wp_enqueue_script( 'lightbox-script');
        wp_register_style('lightbox-style', CUSTOM_PLUGIN_ASSETS_URL.'css/glightbox.min.css');
        wp_enqueue_style( 'lightbox-style');
        wp_register_style('custom-style', CUSTOM_PLUGIN_ASSETS_URL.'css/custom.css');
        wp_enqueue_style('custom-style');
    }
    /*create a date picker from advance custom field with id Schedule_date to arrange post according
    to schedule date.    
    */
    public function event_shortcode(){
        ob_start();
        $query_args = [
            'post_type'      => 'events',
            'posts_per_page' => 4,
            'meta_key'       => 'schedule_date',
            'orderby'        => 'meta_value_num',
            'order'          => 'ASC',
        ];
        
        //  var_dump(get_field('schedule_date'));
        if ( ! empty( $atts['cat'] ) ) {
            $atts                    = shortcode_atts( array(
                'cat'       => '',
                'num_posts' => 10,
            ), $atts, 'cm_event' );
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'events_category',
                    'field'    => 'term_id',
                    'terms'    => $atts['cat'],
                ),
            );
        }
        
        $query = new \WP_Query($query_args);
        if ( $query->have_posts() ) :
            echo '<div class="cm-listing">';
            while ( $query->have_posts() ) : $query->the_post();
                $event_title       = get_the_title();
                $event_banner      = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                $event_description = get_the_excerpt();
        
                echo '<div class="cm-item">';
                if ( $event_banner ) {
                    echo '<div class="cm-image">';
                    echo '<img src="' . esc_url( $event_banner ) . '" alt="' . esc_attr( $event_title ) . '">';
                    echo '</div>';
                }
                echo '<div class="cm-details ">';
                echo '<h3 class="cm-title">' . esc_html( $event_title ) . '</h3>';
                echo '<div class="cm-description">' . esc_html( $event_description ) . '</div>';
                echo '<div class="cm-schedule-date">' . get_field( 'schedule_date' ) . '</div>';
                echo '<div class="cm-action">Show Detail</div>';
                echo '</div>';
                echo '</div>';
            endwhile;
            echo '</div>';
        endif;
        wp_reset_postdata();
        return ob_get_clean();
    }
}
