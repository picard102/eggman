<?php
/**
 * The template for displaying the Social section
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */
?>

<section class='social'>


  <div class="social-follow">
    <svg><use xlink:href="#bacon-cross"></use></svg>
    <span>
      <h1>Follow <br>the EggMan</h1>
      <?php if (!empty($hashtag)) { echo '<span class="hashtag">#'.$hashtag.'</span>'; } ?>
    </span>
    <div class="accounts">
    <?php
      if (!empty($twitter)) {
        echo '<a href="https://twitter.com/'.$twitter.'"><svg><use xlink:href="#icon-twitter"></use></svg></a>';
      }
      if (!empty($facebook)) {
        echo '<a href="https://www.facebook.com/'.$facebook.'"><svg><use xlink:href="#icon-facebook"></use></svg></a>';
      }
      if (!empty($instagram)) {
        echo '<a href="https://www.instagram.com/'.$instagram.'"><svg><use xlink:href="#icon-instagram"></use></svg></a>';
      }
    ?>
    </div>
  </div>













<div class="social-posts">
<ul class="social-stream" id="social-stream">
<?php
$args = array(
  'post_type' => 'social',
  'posts_per_page'  =>  5,
   'meta_query' => array(
      array(
        'key'     => 'media_image',
        'compare' => 'EXISTS',
      )
    )
);
$social = get_posts( $args );
foreach ( $social as $post ) : setup_postdata( $post );


  $type = get_post_meta( $post->ID, 'type', true );
  $id = get_post_meta( $post->ID, 'id', true );
  $shortcode = get_post_meta( $post->ID, 'shortcode', true );
  $media_img = get_post_meta( $post->ID, 'media_image', true );
  $media_type = get_post_meta( $post->ID, 'media_type', true );

  switch ($type) {
  case 'twitter':
   $link = 'https://twitter.com/statuses/'.$id;
  break;
  case 'instagram':
   $link = 'https://instagram.com/p/'.$shortcode;
  break;
  }
  $button = '';
  echo '<li class="social-item social-'.$type.' ">';
  if (isset($media_type) && !empty($media_type)) {
    if ($media_type == 'video') {
      $button = '<svg><use xlink:href="#icon-video"></use></svg>';
    }
  }
  if (isset($media_img) && !empty($media_img)) {
    $media_img = wp_get_attachment_image_src($media_img, 'menu_large', true );
    $media_img = $media_img[0];
    echo '<a href="'.$link.'" class="img_wrap"  target="_blank">'.$button.'<img class="media" src="'.$media_img.'"/></a>';
  }
  $icon = '<div class="network"><a href="'.$link.'" target="_blank"><svg><use xlink:href="#icon-'.$type.'"></use></svg></a></div>';
echo $icon;
echo '</li>';
endforeach;
wp_reset_postdata();




$args = array(
  'post_type' => 'social',
  'posts_per_page'  =>  1,
  'meta_query' => array(
      array(
        'key'     => 'type',
        'compare' => '=',
        'value' => 'twitter',
      )
    )
);
$social = get_posts( $args );
foreach ( $social as $post ) : setup_postdata( $post );
    $type = get_post_meta( $post->ID, 'type', true );
  $id = get_post_meta( $post->ID, 'id', true );
  $shortcode = get_post_meta( $post->ID, 'shortcode', true );
  $media_img = get_post_meta( $post->ID, 'media_image', true );
  $media_type = get_post_meta( $post->ID, 'media_type', true );
  $media_class = '';

if (isset($media_img) && !empty($media_img)) {
  $media_class = 'media';
}
echo '<li class="social-item social-'.$type.'-large '.$media_class.'">';

$content = get_the_content();
  $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
  $content = preg_replace($url, '<a href="$1://$2" target="_blank" title="$0">$0</a>', $content);
  $content = preg_replace('/(?<=^|\s)@([a-z0-9_]+)/i', '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>',  $content);
  $content = preg_replace('/(?<=^|\s)#([a-z0-9_]+)/i', '<a href="https://twitter.com/search?q=%23$1" target="_blank">#$1</a>',  $content);
  $content = apply_filters('the_content', $content);


  if (isset($media_type) && !empty($media_type)) {
  $button = '';

  if (isset($media_type) && !empty($media_type)) {
    if ($media_type == 'video') {
      $button = '<svg><use xlink:href="#icon-video"></use></svg>';
    }
  }
  if (isset($media_img) && !empty($media_img)) {
    $media_img = wp_get_attachment_image_src($media_img, 'menu_large', true );
    $media_img = $media_img[0];
    echo '<a href="https://twitter.com/statuses/'.$id.'" class="img_wrap"  target="_blank">'.$button.'<img class="media" src="'.$media_img.'"/></a>';
  }
}  echo $content;


  $icon = '<div class="network"><a href="https://twitter.com/statuses/'.$id.'"  target="_blank"><svg><use xlink:href="#icon-twitter"></use></svg></a></div>';
echo $icon;


endforeach;
wp_reset_postdata();


echo '</ul>';
?>



</div>




</section>
