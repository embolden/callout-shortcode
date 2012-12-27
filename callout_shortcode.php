<?php
/**
 * @package Callout_Shortcode
 */
/*
Plugin Name: Callout Shortcode
Plugin URI:
Description: Adds a [callout] shortcode.
Version: 0.1
Author: The Net Impact
Author URI: http://www.thenetimpact.com
License: GPLv2 or later
*/

function tnics_callout_shortcode( $atts ) {
  $defaults = array(
    'caption' => '',
    'cta' => '',
    'button' => '',
    'buttoncolor' => '',
    'link' => '',
    'class' => ''
  );
  $attr = shortcode_atts( $defaults, $atts );

  $output = '<div class="callout ' . esc_attr( $attr['class'] ) . '">';
  $output .= '<div class="callout-caption"><span>' . esc_attr( $attr['caption'] ) . '</span></div>';
  $output .= '<div class="callout-cta"><span>' . esc_attr( $attr['cta'] ) . '</span></div>';
  $output .= '<div class="button-' . esc_attr( $attr['buttoncolor'] ) . '"><a href="' . esc_attr( $attr['link'] ) . '">' . esc_attr( $attr['button'] ) . '</a></div>';
  $output .= '</div>';

  return $output;
}
add_shortcode( 'callout', 'tnics_callout_shortcode' );


/*
 * http://wordpress.stackexchange.com/questions/72394/how-to-add-a-shortcode-button-to-the-tinymce-editor
 */

 // init process for registering our button
function tnics_shortcode_button_init() {

  //Abort early if the user will never see TinyMCE
  if ( ! current_user_can( 'edit_posts' )
    && ! current_user_can( 'edit_pages' )
    && get_user_option( 'rich_editing' ) == 'true' ) {
    return;
  }

  //Add a callback to regiser our tinymce plugin
  add_filter( 'mce_external_plugins', 'tnics_register_tinymce_plugin' );

  // Add a callback to add our button to the TinyMCE toolbar
  add_filter( 'mce_buttons', 'tnics_add_tinymce_button' );
}
add_action('init', 'tnics_shortcode_button_init');


//This callback registers our plug-in
function tnics_register_tinymce_plugin( $plugin_array ) {
  $plugin_array['tnics_button'] = plugin_dir_url( __FILE__ ) . 'js/callout_shortcode.js';
  return $plugin_array;
}


//This callback adds our button to the toolbar
function tnics_add_tinymce_button( $buttons ) {
  //Add the button ID to the $button array
  $buttons[] = "tnics_button";
  return $buttons;
}

?>