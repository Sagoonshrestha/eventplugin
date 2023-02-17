<?php
     $post_detail=get_the_terms($atts['cat'], 'events_category');
     $atts = shortcode_atts( array(
        'cat' => '',
        'num_posts' => 4,
    ), $atts, 'cm_event' );

    $query_args = array(
        'post_type' => 'events',
        'posts_per_page' => $atts['num_posts'],
        'order' => 'DESC',
    );
    if ( ! empty( $atts['cat'] ) ) {
        $query_args['tax_query'] = array(
            'taxonomy' => $post_detail[0]->name,
            'field' => 'term_id',
            'terms' => $post_detail[0]->term_id,
        );
    }
    
    $query = new WP_Query( $query_args);
    
    //ob_start();
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
            echo '<div class="cm-action">Show Detail</div>';
            echo '</div>';
            echo '</div>';            
        endwhile;
        echo '</div>';
    endif;
    //wp_reset_postdata();

    //return ob_get_clean();
?>