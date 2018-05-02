<?php
/**
 * Staff ajax functions
 *
 * PHP version 5
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */


add_action("wp_ajax_staff_archive", "staff_archive");
add_action("wp_ajax_nopriv_staff_archive", "staff_archive");
function staff_archive(){
  staff_archive_output();
  die();
}

function staff_archive_output() {

 $args = array(
    'post_type' =>  'staff', 
    'posts_per_page'  =>  200,
  ); 

  query_posts($args);
  if (have_posts()) : while (have_posts()) : the_post(); 

  $pid = get_the_ID();
  if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  $image_id = get_post_thumbnail_id($pid);
  $url = wp_get_attachment_image_src($image_id,'post_card_large', true)[0]; }

  $sub = get_post_meta( $pid, 'staff_title', 'true' );
  $twitter = get_post_meta( $pid, 'staff_twitter', 'true' );
  $facebook = get_post_meta( $pid, 'staff_facebook', 'true' );
  $instagram = get_post_meta( $pid, 'staff_instagram', 'true' );

echo '<article class="staff_single">
    <div class="col_1">
      <img src="'. $url .'">.';
      if (!empty($twitter)) {
        echo '<a href="'.$twitter.'"><svg><use xlink:href="#twitter-icon"></use></svg></a>';
      }
      if (!empty($facebook)) {
        echo '<a href="'.$facebook.'"><svg><use xlink:href="#facebook-icon"></use></svg></a>';
      }
      if (!empty($instagram)) {
        echo '<a href="'.$instagram.'"><svg><use xlink:href="#instagram-icon"></use></svg></a>';
      }
    echo '</div>
    <div class="col_2">
      <h1>'.get_the_title().'</h1>
      <h2>'.$sub.'</h2>
      <div class="content">
      '.get_the_content_with_formatting().'
      </div>
    </div>
    ';

        

    echo '</article>';


endwhile; endif;

} ?>