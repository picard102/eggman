<?php
/**
 * Theme styles
 *
 * PHP version 5
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

/**
 * General Theme Styles
 */
function general_styles() {
  wp_enqueue_style( 'theme_reset', $GLOBALS['template_dir_uri'] . '/style.css', false, '@hash@', 'screen' );
  wp_enqueue_style( 'fonts_google', 'http://fonts.googleapis.com/css?family=Oswald:200,300,400,500,700', false, '1.0' );
}
add_action( 'wp_enqueue_scripts', 'general_styles' );

/**
 * Function to call themes admin stylesheet
 */
function admin_styles() {
  wp_enqueue_style( 'theme_reset', $GLOBALS['template_dir_uri'].'/admin.css', false, '@hash@', 'screen' );
}
add_action( 'admin_enqueue_scripts', 'admin_styles' );


