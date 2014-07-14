<?php
/**
 * @package Dziudek-BigText
 * @version 1.0
 */
/*
Plugin Name: Dziudek BigText
Plugin URI: 
Description: 
Author: Dziudek
Version: 1.0
Author URI: http://wp.dziudek.pl
*/

add_action('admin_head', 'dziudek_add_bigtext_button');
add_action('admin_enqueue_scripts', 'dziudek_bigtext_css');

function dziudek_add_bigtext_button() {
    global $typenow;
    // sprawdzamy czy user ma uprawnienia do edycji postów/podstron
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
      return;
    }
    // weryfikujemy typ wpisu
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
      return;
  // sprawdzamy czy user ma włączony edytor WYSIWYG
  if ( get_user_option('rich_editing') == 'true') {
    add_filter("mce_external_plugins", "dziudek_add_bigtext_plugin");
    add_filter('mce_buttons', 'dziudek_register_bigtext_button');
  }
}

function dziudek_add_bigtext_plugin($plugin_array) {
    $plugin_array['dziudek_bigtext_button'] = plugins_url( '/bigtext.js', __FILE__ );
    
    return $plugin_array;
}

function dziudek_register_bigtext_button($buttons) {
   array_push($buttons, "dziudek_bigtext_button");
   
   return $buttons;
}

function dziudek_bigtext_css() {
  wp_enqueue_style('dziudek-bigtext', plugins_url('/style.css', __FILE__));
}

// EOF