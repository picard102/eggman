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
        'active' => __( 'Active' ) 
    ) );
}

add_filter( 'manage_edit-items_columns', 'set_edit_items_columns' );
add_action( 'manage_posts_custom_column', 'custom_columns' );
function custom_columns( $column ) {
    global $post;
    switch ( $column ) {
        case 'image':
            $post_meta_data = get_post_custom( $post->ID );
            $custom_image   = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size = 'thumbnail', $icon = false )[0];
            echo '<img src="'.$custom_image.'"/>';
            break;

    case 'image2':
            $post_meta_data = get_post_custom( $post->ID );
            $custom_image   = $post_meta_data[ 'items_money' ][0];
            echo '<img src="'.$custom_image.'"/>';
            break;

    case 'active':
            $post_meta_data = get_post_custom( $post->ID );
            $custom_image   = $post_meta_data[ 'items_show' ];
            if ($custom_image) {
              if (in_array("on", $custom_image)) {
                echo "&#10004;";
              }
            }
            break;


    } //$column
}
