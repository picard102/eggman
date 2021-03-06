<?php
/**
 * Press Meta
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
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function cmb2_set_checkbox_default_for_new_post( $default ) {
    return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}


/**
 * Metaboxs
 */
function items_metaboxes() {

    $prefix = 'items_';

    $cmb = new_cmb2_box( array(
        'id' => 'items_users_metabox',
        'title' => 'Product Info',
        'object_types' => array('items'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
    ) );

    $cmb->add_field( array(
          'name' => 'Visable',
          'desc' => 'Show in Menu',
          'id'   => $prefix.'show',
          'type' => 'checkbox',
          'default' => cmb2_set_checkbox_default_for_new_post( true )
    ) );

    $cmb->add_field( array(
          'name' => 'Special',
          'desc' => 'Special',
          'id'   => $prefix.'special',
          'type' => 'checkbox',
    ) );

    $cmb->add_field( array(
          'name'    => 'Price Regular',
          'desc'    => '',
          'id'      => $prefix.'price_reg',
          'type'    => 'text_money'
    ) );
    $cmb->add_field( array(
          'name'    => 'Price Large',
          'desc'    => '',
          'id'      => $prefix.'price_lrg',
          'type'    => 'text_money'
    ) );

    $cmb->add_field( array(
      'name'    => 'Menu Thumbnail',
          'desc'    => 'Upload an image or enter an URL.',
          'id'      => $prefix.'thumb',
          'type'    => 'file',
          // Optionally hide the text input for the url:
          'options' => array(
              'url' => false,
          ),
    ) );

    $cmb->add_field( array(
 'name'    => 'Money Shot',
          'desc'    => 'Upload an image or enter an URL.',
          'id'      => $prefix.'money',
          'type'    => 'file',
          // Optionally hide the text input for the url:
          'options' => array(
              'url' => false,
          ),
    ) );


}

add_action( 'cmb2_init', 'items_metaboxes' );
