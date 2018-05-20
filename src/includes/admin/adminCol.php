<?php
/**
 * Admin Columns
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
 * Admin Column Addtions
 */
function set_edit_items_columns( $columns ) {
    unset( $columns[ 'author' ] );
    unset( $columns[ 'date' ] );
    return array_merge( $columns, array(
        'image' => __( 'Hero Image' ),
        'image2' => __( 'Secondary Image' ),
        'active' => __( 'Active' ),
        'special' => __( 'Special' )
    ) );
}

add_filter( 'manage_edit-items_columns', 'set_edit_items_columns' );
add_action( 'manage_posts_custom_column', 'custom_columns' );

function custom_columns( $column ) {
global $post;
switch ( $column ) {

  case 'image':
    $custom_image = isset( get_post_meta( $post->ID, 'items_thumb')[0] ) ?  get_post_meta( $post->ID, 'items_thumb_id') : false ;
    if ($custom_image) {
      $custom_image = wp_get_attachment_image_src( $custom_image[0], 'menu_thumb')[0];
      echo '<img src="'.$custom_image.'"/>';
    }
  break;

  case 'image2':
    $custom_image = isset( get_post_meta( $post->ID, 'items_money')[0] ) ?  get_post_meta( $post->ID, 'items_money_id') : false ;
    if ($custom_image) {
      $custom_image = wp_get_attachment_image_src( $custom_image[0], 'menu_thumb')[0];
      echo '<img src="'.$custom_image.'"/>';
    }
  break;

  case 'active':
    $active = isset( get_post_meta( $post->ID , 'items_show')[0] ) ?  get_post_meta( $post->ID , 'items_show')[0] : false ;
    if ($active == 'on') {
      echo "&#10004;";
    }
  break;

  case 'special':
    $active = isset( get_post_meta( $post->ID , 'items_special')[0] ) ?  get_post_meta( $post->ID , 'items_special')[0] : false ;
    if ($active == 'on') {
      echo "&#10004;";
    }
  break;

} //$column
}










/**
* Admin Column Addtions
*/
function set_edit_social_columns( $columns ) {
unset( $columns[ 'date' ] );
unset( $columns[ 'author' ] );
return array_merge( $columns, array(
'images' => __( 'Image' ),
'service' => __( 'Service' )
) );
}

add_filter( 'manage_edit-social_columns', 'set_edit_social_columns' );
add_action( 'manage_posts_custom_column', 'custom_social_columns' );

function custom_social_columns( $column ) {
  global $post;
  switch ( $column ) {
    case 'images':
      $custom_image =  isset( get_post_meta( $post->ID, 'media_image', false)[0]) ? get_post_meta( $post->ID, 'media_image') : false;
      if ($custom_image) {
        $custom_image = wp_get_attachment_image_src( $custom_image[0], 'thumbnail')[0];
        echo '<img src="'.$custom_image.'"/>';
      }
    break;
    case 'service':
      $active = isset( get_post_meta( $post->ID , 'type')[0] ) ?  get_post_meta( $post->ID , 'type')[0] : false ;
       include( get_stylesheet_directory() . '/assets/svg/icons/icon-'.$active.'.svg' );
    break;
  }
}
