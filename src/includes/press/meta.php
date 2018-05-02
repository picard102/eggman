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
 * Metaboxs
 */
function press_metaboxes() {

    $prefix = 'press_';

    $cmb = new_cmb2_box( array(
        'id' => 'press_users_metabox',
        'title' => 'Article Info',
        'object_types' => array('press'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
    ) );

    $cmb->add_field( array(
        'name' => 'Article URL',
        'desc' => '',
        'id'   => $prefix.'url',
        'type' => 'text_url',
    ) );

    $cmb->add_field( array(
        'name' => 'Article Source',
        'desc' => '',
        'id'   => $prefix.'source',
        'type' => 'text',
    ) );

}

add_action( 'cmb2_init', 'press_metaboxes' );
