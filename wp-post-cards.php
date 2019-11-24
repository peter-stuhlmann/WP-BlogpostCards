<?php
/*
 * Plugin Name: WP Post Cards by Peter R. Stuhlmann
 * Version: 1.0.0
 * Author: Peter R. Stuhlmann
 * Author URI: https://peter-stuhlmann-webentwicklung.de
 * License: MIT
 */


// Stylesheet
function wp_post_cards_enqueue_scripts() {
  wp_enqueue_style( 'wp-post-cards-styles', plugin_dir_url( __FILE__ ) . "/assets/css/style.css", '', '20191119');
}
add_action( 'wp_enqueue_scripts', 'wp_post_cards_enqueue_scripts' );


// Display blogposts
function wppc_display_post_cards($atts, $content = NULL) {
  $atts = shortcode_atts(
    [ 
      'orderby' => 'date', 
      'posts_per_page' => '-1',
      'category_name' => '',
      'tag' => ''
    ], 
    $atts, 
    'wp-post-cards' 
  );
          
  $query = new WP_Query( $atts );
  $output = '<div class="wppc-container">';
  while($query->have_posts()) : $query->the_post();

  $thumbnailUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'full') );
  if ( $thumbnailUrl == '' ) {
    $postCardThumbnail = '<Default image url>';
  } else {
    $postCardThumbnail = $thumbnailUrl;
  }

  if ( esc_attr(get_option('button-text', '')) == '' ) {
    $buttonText = 'Read article';
  } else {
    $buttonText = esc_attr(get_option('button-text', ''));
  }

  $output .= '
    <div class="wppc-card">
      <div class="wppc-card-image" style="background-image: url(' . $postCardThumbnail . ')"></div>
      <div class="wppc-card-content">
        <h3>' . get_the_title() . '</h3>
        <p>' . get_the_excerpt() . '</p>
        <a class="wppc-button" href="' . get_permalink() . '">' . $buttonText . '</a>
      </div>
    </div>
  ';
      
  endwhile;
  wp_reset_query();
  return $output . '</div>';
}
          
add_shortcode('wppc', 'wppc_display_post_cards');

// settings
include (plugin_dir_path( __FILE__ ) . '/includes/settings.php');