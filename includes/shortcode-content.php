<?php 
//  var_dump(get_field('schedule_date'));
    if ( ! empty( $atts['cat'] ) ) {
        $atts = shortcode_atts( array(
            'cat' => '',
            'num_posts' => 10,
        ), $atts, 'cm_event' );
        $query_args = array(
            'post_type' => 'events',
            'posts_per_page' => $atts['num_posts'],
            'meta_key'=>'schedule_date',
            'orderby'   => 'meta_value_num',
            'order' => 'ASC',
        );
        $query_args['tax_query'] = array(array(
            'taxonomy' =>'events_category',
            'field' => 'term_id',
            'terms' =>$atts['cat'],),
        );
    }else{
        $query_args = array(
            'post_type' => 'events',
            'posts_per_page' =>5,
            'order' => 'DESC',
            'meta_key'=>'schedule_date',
            'orderby'   => 'meta_value_num',
            'order' => 'ASC',
        );
    }
    $query = new WP_Query( $query_args);
    if ( $query->have_posts()) :
        echo '<div class="cm-listing">';
        while ( $query->have_posts() ) : $query->the_post();
            
            $event_title = get_the_title();
            $event_banner = get_the_post_thumbnail_url( get_the_ID(), 'large' );
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
            echo '<div class="cm-schedule-date">'.get_field('schedule_date').'</div>';
            echo '<div class="cm-action">Show Detail</div>';
            echo '</div>';
            echo '</div>';            
        endwhile;
        echo '</div>';
    endif;
    wp_reset_postdata();
?>