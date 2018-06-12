<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

?>

<div class="footer-gallery">
<?php
$args=array(
  'posts_per_page'  =>  3,
  'post_type' =>  'items',
  'orderby' => 'rand',
  'meta_query' => array(
    array(
      'key'     => 'items_thumb',
      'compare' => 'EXISTS',
    )
  )
);
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post();
$url = wp_get_attachment_image_src( get_post_meta( $post->ID, 'items_money_id', 1 ), 'menu_large' )[0];
?>
  <div class="image"><img src="<?php echo $url ?>"></div>
<?php  endwhile; endif; wp_reset_query(); ?>

<?php
$args=array(
  'posts_per_page'  =>  4,
  'post_type' =>  'social',
  'orderby' => 'rand',
  'meta_query' => array(
      array(
        'key'     => 'media_image',
        'compare' => 'EXISTS',
      )
  )
);
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post();
$media_img = get_post_meta( $post->ID, 'media_image', true );
$media_img = wp_get_attachment_image_src($media_img, 'menu_large', true );
    $media_img = $media_img[0];
?>
  <div class="image"><img src="<?php echo $media_img ?>"></div>
<?php  endwhile; endif; wp_reset_query(); ?>


</div>


<footer id="site_footer" class="site-footer">
<small>© 2018 All rights reserved. Thomas Januszewski </small>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
