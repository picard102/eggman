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
 * Call streetfoodapp API
 */
function get_streetfoodAPI() {

  $url = 'http://data.streetfoodapp.com/1.1/vendors/egg-man';
  $json_data = file_get_contents($url);


  return $json_data;
}

var_dump(get_streetfoodAPI());