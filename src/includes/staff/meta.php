<?php
/**
 * Staff Meta
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
 * Metaboxs
 */
function staff_metaboxes() {

    $prefix = 'staff_';

    $cmb = new_cmb2_box( array(
        'id' => 'staff_users_metabox',
        'title' => 'Article Info',
        'object_types' => array('staff'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
    ) );


    $cmb->add_field( array(
              'name' => 'Title',
              'desc' => '',
              'id'   => $prefix.'title',
              'type' => 'text',
    ) );


    $cmb->add_field( array(
              'name' => 'Twitter',
              'desc' => '',
              'id'   => $prefix.'twitter',
              'type' => 'text_url',
    ) );


    $cmb->add_field( array(
              'name' => 'Facebook',
              'desc' => '',
              'id'   => $prefix.'facebook',
              'type' => 'text_url',
    ) );

    $cmb->add_field( array(
              'name' => 'Instagram',
              'desc' => '',
              'id'   => $prefix.'instagram',
              'type' => 'text_url',
    ) );

}

add_action( 'cmb2_init', 'staff_metaboxes' );

