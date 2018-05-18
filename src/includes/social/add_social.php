<?php
/**
 * Add Social Streams
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */






function addSocial ($type, $args) {
  require_once(ABSPATH . 'wp-admin/includes/media.php');
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $checkarg = array(
    'post_type' => 'social',
    'meta_query' => array(
       array(
           'key' => 'id',
           'value' => $args['id'],
           'compare' => '=',
       )
     )
  );
  $query = new WP_Query($checkarg);
  $count = $query->post_count;
  if ($count === 0) {
    // echo "<pre>";
    // var_dump($args);
    // echo "</pre><hr>";
    $my_post = array(
      'post_type' => 'social',
      'post_title'    => wp_strip_all_tags(  substr($args['text'], 0, 63) ),
      'post_content'  => $args['text'],
      'post_status'   => 'publish',
      'post_author'   => 1,
      'post_date' => date("Y-m-d  H:i:s", $args['time']),
      'meta_input' => array(
        'user' => $args['user'],
        'name' => $args['name'],
        'id' => $args['id'],
        'type' => $type,
      ),
    );
    $post = wp_insert_post( $my_post );

    // if (!empty($args['avatar'])) {
    //   $image = media_sideload_image($args['avatar'], $post, $desc = '', $return = 'id');
    //   update_post_meta($post, 'avatar', $image );
    // }

    if (!empty($args['shortcode'])) {
      update_post_meta($post, 'shortcode', $args['shortcode'] );
    }

    if (!empty($args['media_img'])) {
      $image = media_sideload_image($args['media_img'], $post, $desc = '', $return = 'id');
      update_post_meta($post, 'media_image', $image );
      update_post_meta($post, 'media_type', $args['media_type']);
    }

    if (!empty($args['quote'])) {
      $quote = array(
        'text' => $args['quote']['text'],
        'name' => $args['quote']['name'],
        'user' => $args['quote']['user'],
      );
      if (!empty($args['quote']['media_img'])) {
        $image = media_sideload_image($args['quote']['media_img'], $post, $desc = '', $return = 'id');
        $quote['media_img'] = $image;
        $quote['media_type'] = $args['quote']['media_type'];
      }
      update_post_meta($post, 'quote', $quote );
    }
  }
}
