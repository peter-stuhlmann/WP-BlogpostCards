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