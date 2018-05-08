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





















<?php





echo '<ul class="social-stream" id="social-stream">';
$args = array(
  'post_type' => 'social',
  'posts_per_page'  =>  -1,
);
$social = get_posts( $args );
foreach ( $social as $post ) : setup_postdata( $post );
$type = get_post_meta( $post->ID, 'type', true );
$user = get_post_meta( $post->ID, 'user', true );
$name = get_post_meta( $post->ID, 'name', true );
$avatar = get_post_meta( $post->ID, 'avatar', true );
$id = get_post_meta( $post->ID, 'id', true );
$avatar = wp_get_attachment_image_src($avatar, 'thumbnail', true );
$avatar = $avatar[0];

echo '<li class="social-item social-'.$type.' ">';
switch ($type) {



  case 'twitter':
  $content = get_the_content();
  $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
  $content = preg_replace($url, '<a href="$1://$2" target="_blank" title="$0">$0</a>', $content);
  $content = preg_replace('/(?<=^|\s)@([a-z0-9_]+)/i', '<a href="http://www.twitter.com/$1" target="_blank">@$1</a>',  $content);
  $content = preg_replace('/(?<=^|\s)#([a-z0-9_]+)/i', '<a href="https://twitter.com/search?q=%23$1" target="_blank">#$1</a>',  $content);
  $content = apply_filters('the_content', $content);
  echo $content;
  $media_img = get_post_meta( $post->ID, 'media_image', true );
  $media_type = get_post_meta( $post->ID, 'media_type', true );
  if (isset($media_type) && !empty($media_type)) {
  $button = '';
  if (isset($media_type) && !empty($media_type)) {
    if ($media_type == 'video') {
      $button = '<svg><use xlink:href="#icon-video"></use></svg>';
    }
  }
  if (isset($media_img) && !empty($media_img)) {
    $media_img = wp_get_attachment_image_src($media_img, 'full', true );
    $media_img = $media_img[0];
    echo '<a href="https://twitter.com/statuses/'.$id.'" class="img_wrap"  target="_blank">'.$button.'<img class="media" src="'.$media_img.'"/></a>';
  }
}

  $quote = get_post_meta( $post->ID, 'quote', true );
  if (isset($quote) && !empty($quote)) {
      echo '<div class="tweet-quote">';
      if (isset($quote['media_img'])) {
        $media_img = wp_get_attachment_image_src($quote['media_img'], 'thumbnail', true );
        $media_img = $media_img[0];
        echo '<div class="image"><img class="media" src="'.$media_img.'"/></div>';
      }
      echo '<span><div class="quote-user">@'.$quote['name'].'</div>';
      $content = apply_filters('the_content', $quote['text']);
      echo $content;
      echo '</span></div>';
  }
  $icon = '<div class="network"><a href="https://twitter.com/statuses/'.$id.'"  target="_blank"><svg><use xlink:href="#icon-twitter"></use></svg></a></div>';

      break;







  case 'instagram':
  $shortcode = get_post_meta( $post->ID, 'shortcode', true );
  $media_img = get_post_meta( $post->ID, 'media_image', true );
  $media_type = get_post_meta( $post->ID, 'media_type', true );
  $button = '';
  if (isset($media_type) && !empty($media_type)) {
    if ($media_type == 'video') {
      $button = '<svg><use xlink:href="#icon-video"></use></svg>';
    }
  }
  if (isset($media_img) && !empty($media_img)) {
    $media_img = wp_get_attachment_image_src($media_img, 'full', true );
    $media_img = $media_img[0];
    echo '<a href="https://instagram.com/p/'.$shortcode.'" class="img_wrap"  target="_blank">'.$button.'<img class="media" src="'.$media_img.'"/></a>';
  }
  $content = get_the_content();
  $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';
  $content = preg_replace($url, '<a href="$1://$2" target="_blank" title="$0">$0</a>', $content);
  $content = preg_replace('/(?<=^|\s)@([a-z0-9_]+)/i', '<a href="http://www.instagram.com/$1" target="_blank">@$1</a>',  $content);
  $content = preg_replace('/(?<=^|\s)#([a-z0-9_]+)/i', '<a href="https://instagram.com/explore/tags/$1" target="_blank">#$1</a>',  $content);
  $content = apply_filters('the_content', $content);
  //echo $content;
  $icon = '<div class="network"><a href="https://instagram.com/p/'.$shortcode.'" target="_blank"><svg><use xlink:href="#icon-instagram"></use></svg></a></div>';
      break;
}

echo '<div class="user-info">';
echo '<img src="'.$avatar.'"/>';
echo '<span><strong>@'.$user.'</strong>';
echo '<small>'.$name.'</small></span>';
echo $icon;
echo '</div>';
echo '';
echo '</li>';
endforeach;
wp_reset_postdata();
echo '</ul>';

?>







  <div class='wrapper'>


<div class="twitter-wrapper">
<?php //include( "social_twitter.php"); ?>
</div>

<div class="instagram-wrapper">
  <?php //include( "social_insta.php"); ?>
</div>

<div class="twitter-wrapper post">
</div>

  </div>

  <div class="share">
    <div class="wrapper">
      <?php if (!empty($hashtag)) { echo '<span class="hashtag">#'.$hashtag.'</span>'; } ?>
      <div class="accounts">
        <span>Follow the EggMan</span>
        <?php
          if (!empty($twitter)) {
            echo '<a href="https://twitter.com/'.$twitter.'"><svg><use xlink:href="#twitter-icon"></use></svg></a>';
          }
          if (!empty($facebook)) {
            echo '<a href="https://www.facebook.com/'.$facebook.'"><svg><use xlink:href="#facebook-icon"></use></svg></a>';
          }
          if (!empty($instagram)) {
            echo '<a href="https://www.instagram.com/'.$instagram.'"><svg><use xlink:href="#instagram-icon"></use></svg></a>';
          }
        ?>
    </div>
  </div>

</section>
