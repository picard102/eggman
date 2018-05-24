
<section class="catering">

    <div class="cater-header">
      <h1>We Cater</h1>
      <p>The Eggman right outside your door, your office or your wedding.</p>
      <a href='#' id='contact-open-trigger' class="red pill">Contact Us</a>
    </div>


    <?php
      $args=array(
        'posts_per_page'  =>  1,
        'orderby' => 'rand',
        'post_type' =>  'testimonials',
      );
      query_posts($args);
      if (have_posts()) : while (have_posts()) : the_post();
    ?>
    <div class="testimonial-column">
      <?php the_content(); ?>
      <span>- <?php the_title(); ?></span>
    </div>
    <?php endwhile; endif; wp_reset_query(); ?>

</section>
