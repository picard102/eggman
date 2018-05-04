<?php





/**
 * Ajax Function Call
 */
function menu_item() {
  $pid = $_POST['id'];
  $result  = get_item($pid);
  echo json_encode( $result );
  die();
}

add_action('wp_ajax_nopriv_menu_item', 'menu_item');
add_action('wp_ajax_menu_item', 'menu_item');

function get_item($pid) {


    // // query_posts('p='.$pid.'&post_type=items');
    // // if (have_posts()) : while (have_posts()) : the_post();


    $posts['title'] = get_the_title($pid);
    $posts['sub'] = get_post_meta( $pid, 'items_sub', 'true' );

    $content_post = get_post($pid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
    $posts['content'] = $content;

    $posts['price_large'] = get_post_meta( $pid, 'items_price_lrg', 'true' );
    $posts['price_small'] = get_post_meta( $pid, 'items_price_reg', 'true' );
    $posts['based'] = get_post_meta( $pid, 'items_base', 'true' );
    $posts['sodium'] = get_post_meta( $pid, 'items_sodium', 'true' );
    $posts['fat'] = get_post_meta( $pid, 'items_fat', 'true' );

    $posts['carb'] = get_post_meta( $pid, 'items_carb', 'true' );
    $posts['cal'] = get_post_meta( $pid, 'items_cal', 'true' );
    $posts['money'] = get_post_meta( $pid, 'items_money', 'true' );
    $image_id = get_post_thumbnail_id($pid);
    $posts['image'] = wp_get_attachment_image_src($image_id,'post_card_large', true)[0];



  $response = $posts;
  return $response;





    // if(($price_lrg !== '0.00') && ($price_reg !== '0.00')){
    //   $price = '<div class="price">
    //   <span><small>Large:</small> <strong>$'.$price_lrg.'</strong></span>
    //   <span><small>Small:</small> <strong>$'.$price_reg.'</strong></span>
    //   </div>';
    // } else {
    //   $price = '<div class="price">
    //   <span><small>Price:</small> <strong>$'.$price_reg.'</strong></span>
    //   </div>';
    // }
    // if(!empty($based)){
    //   $base_string = '<div class="serving"> <small>Serving Size:</small> <strong>'.$based.'</strong> </div>';
    // }
    // if(!empty($cal)){
    //   $cal_string = '<div class="cell"> <strong>'.$cal.'</strong> <small>Calories</small></div>';
    // }
    // if(!empty($carb)){
    //   $carb_string = '<div class="cell"> <strong>'.$carb.'</strong>  <small>Carbs (g)</small> </div>';
    // }
    // if(!empty($fat)){
    //   $fat_string = '<div class="cell"> <strong>'.$fat.'</strong> <small>Total Fat (g)</small> </div>';
    // }
    // if(!empty($sodium)){
    //   $sodium_string = '<div class="cell"> <strong>'.$sodium.'</strong> <small>Sodium (mg)</small> </div>';
    // }

// $data = '
//     <div class="close">
//       <svg><use xlink:href="#icon-close"></use></svg>
//     </div>
//     <div class="wrapper">

//       <div class="col_2">
//         <div class="img-wrap"><img src="'.$url.'"></div>
//       </div>

//       <div class="col_1">
//         <h2>'.get_the_title().'</h2>
//         <div class="content">
//         '.get_the_content_with_formatting().'
//         </div>
//       </div>
//     </div>';
//   //endwhile; endif;
//   wp_reset_postdata();
//   echo '<article class="item_single">'.$data.'</article>';

}

?>
