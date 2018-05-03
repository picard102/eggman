<section class="menu-section">
<h1>Today's Menu</h1>

  <div class="menu">
    <div class="products" id="scroll">
      <ul>
  <?php 
    $args=array(
      'posts_per_page'  =>  100, 
      'post_type' =>  'items',
      'orderby' => 'title', 
      'order' => 'DESC',
      'meta_query' => array(
        array(
          'key'     => 'items_show',
          'value'   => 'on',
          'compare' => '=',
        )
      )
    ); 
    query_posts($args);
    if (have_posts()) : while (have_posts()) : the_post(); 
    if ( has_post_thumbnail() ) { 
      $image_id = get_post_thumbnail_id($post->ID);
      $url = wp_get_attachment_image_src($image_id,'menu_thumb', true)[0];
      $special = isset( get_post_meta( $post->ID, 'items_special')[0] ) ?  ' special' : false ;
    ?>
    <li <?php post_class('item'.$special); ?> id="post-<?php the_ID(); ?>" data-postid="<?php the_ID(); ?>">
      <div class="image"><img src="<?php echo $url ?>"></div>
      <h1><?php if ($special) {
        echo '<small>Today\'s Special</small>';
      }?><?php the_title();?></h1>
    </li>
    <?php } endwhile; endif; wp_reset_query(); ?>
  </ul>
  </div>
</div>
</section>

<div id="menu-target">

</div>

