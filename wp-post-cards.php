<?php
/*
 * Plugin Name: WP Post Cards by Peter R. Stuhlmann
 * Version: 1.0.0
 * Author: Peter R. Stuhlmann
 * Author URI: https://peter-stuhlmann-webentwicklung.de
 */


// Stylesheet
function wp_post_cards_enqueue_scripts() {
  wp_enqueue_style( 'wp-post-cards-styles', plugin_dir_url( __FILE__ ) . "/assets/css/style.css", '', '20191119');
}
add_action( 'wp_enqueue_scripts', 'wp_post_cards_enqueue_scripts' );


// Display recent blogposts
function wppc_display_post_cards($atts, $content = NULL) {
  $atts = shortcode_atts(
    [ 'orderby' => 'date' ], 
    $atts, 
    'wp-post-cards' 
  );
          
  $query = new WP_Query( $atts );
  $output = '<div class="wppc-container">';
  while($query->have_posts()) : $query->the_post();
  $postCardThumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'full') );
      
  $output .= '
    <div class="wppc-card">
      <div class="wppc-card-image" style="background-image: url(' . $postCardThumbnail . ')"></div>
      <div class="wppc-card-content">
        <h3>' . get_the_title() . '</h3>
        <p>' . get_the_excerpt() . '</p>
        <a class="wppc-button" href="' . get_permalink() . '">Read Article</a>
      </div>
    </div>
  ';
      
  endwhile;
  wp_reset_query();
  return $output . '</div>';
}
          
add_shortcode('wppc', 'wppc_display_post_cards');