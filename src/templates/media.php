<section class='press'>
    <ul>
    <?php
      $args=array(
        'posts_per_page'  =>  6,
        'post_type' =>  'press',
      );
      query_posts($args);
      if (have_posts()) : while (have_posts()) : the_post();
      $article_url = get_post_meta( $post->ID, 'press_url', 'true' );
      $article_source = get_post_meta( $post->ID, 'press_source', 'true' );
    ?>
    <li>
      <a href="<?php echo $article_url; ?>"><?php the_title(); ?>&nbsp;<svg><use xlink:href="#external"></use></svg></a>
      <?php echo $article_source; ?>
    </li>
    <?php endwhile; endif; wp_reset_query();
    ?>
    </ul>
</section>
