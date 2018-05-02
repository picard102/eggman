<?php
/**
 * Menu post type and inclusion of supports
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
 * Declare custom post type
 */
function register_cpt_menu(){

$singularname = 'Item';
$pluralname = 'Items';
$slug = 'items';

  $labels = array(
    'name'          => __( $pluralname ),
    'singular_name' => __( $singularname ),
    'add_new'       => __( 'Add New '.$singularname ),
    'add_new_item'  => __( 'Add New '. $singularname ),
    'edit_item'     => __( 'Edit '. $singularname ),
    'new_item'      => __( 'New '.$singularname ),
    'view_item'     => __( 'View '.$singularname ),
    'search_items'  => __( 'Search '.$pluralname ),
  );
    
  $args = array(
    'labels'        => $labels,
    'description'   => 'profile',
    'public'        => true,
    'hierarchical' => false,
    'menu_icon'   => 'dashicons-carrot',
    'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
    'has_archive'   => false
  );
  register_post_type( 'items', $args ); 
}
add_action( 'init', 'register_cpt_menu' );

require 'meta.php';
