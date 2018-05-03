<?php
/**
 * Schedule
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
 * Ajax Function Call
 */
function get_schedule() {
  $result = get_streetfoodAPI();
  echo json_encode( $result );
  die();
}
add_action( 'wp_ajax_get_schedule', 'get_schedule' );
add_action( 'wp_ajax_nopriv_get_schedule', 'get_schedule' );


/**
 * Call streetfoodapp API
 */
function get_streetfoodAPI() {
  $url = 'http://data.streetfoodapp.com/1.1/vendors/egg-man';
  $cache_key = md5( 'remote_request|' . $url );
  $stored = get_transient( $cache_key );
  if ( false === $stored ) {
    $request = wp_remote_get( $url );
    if ( is_wp_error( $request ) ) {
      set_transient( $cache_key, $stored, MINUTE_IN_SECONDS * 50 );
    } else {
      $request = wp_remote_retrieve_body( $request );
      set_transient( $cache_key, $request, MINUTE_IN_SECONDS * 30 );
    }
  }

  if ( is_wp_error( $stored ) ) {
    return false;
  }

  $stored = get_transient( $cache_key );
  $data = json_decode( $stored );
  return $data;
}
