<?php
/**
 * Get Tweets
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

function queryInsta($search) {
  $json_url = 'https://www.instagram.com/explore/tags/'.$search.'/?__a=1';
  $jsonData = json_decode((file_get_contents($json_url)));
  parseInsta($jsonData->graphql->hashtag->edge_hashtag_to_media->edges);
};


function parseInsta($results) {
  foreach ($results as $insta) {
    $json_url = 'https://www.instagram.com/p/'.$insta->node->shortcode.'/?__a=1';
    $jsonData = json_decode((file_get_contents($json_url)));

    $dt = new DateTime('@'.$insta->node->taken_at_timestamp);
    $dt->setTimeZone(new DateTimeZone('America/Toronto'));
    $args = array(
      'id' => $insta->node->id,
      'time' => strtotime($dt->format('Y-m-d H:i:s')),
      'text' => $insta->node->edge_media_to_caption->edges['0']->node->text,
      'shortcode' => $insta->node->shortcode,
      'name' => $jsonData->graphql->shortcode_media->owner->full_name,
      'user' => $jsonData->graphql->shortcode_media->owner->username,
      'avatar' => $jsonData->graphql->shortcode_media->owner->profile_pic_url,
    );
    if (isset($insta->node->display_url)) {
      $args['media_img'] = $insta->node->display_url;
      if ( $insta->node->is_video === false) {
        $args['media_type'] = 'photo';
      } else {
        $args['media_type'] = 'video';
      }
    }
    addSocial('instagram', $args);
  }

}
