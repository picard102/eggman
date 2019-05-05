<?php
/**
 * Favicon
 *
 * PHP version 5
 *
 * @category
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */



$upload_dir = wp_upload_dir();
$my_file = $upload_dir['basedir'].'/favicon.json';
if (!file_exists($my_file)) {
  favicon_browserconfig();
  favicon_json();
}
/**
 * Add Favicon to Header
 */
function theme_favicons() {
  $upload_dir = wp_upload_dir();
  $favicon_path = get_template_directory_uri() . '/assets/favicon/';
  $show_name = isset( get_option( 'feed_options' )['feed_title'] ) ? get_option( 'feed_options' )['feed_title'] : get_bloginfo( 'name' );
  $artwork = isset( get_option( 'feed_options' )['feed_cover'] ) ? get_option( 'feed_options' )['feed_cover'] : false;
  $artwork_id = isset( get_option( 'feed_options' )['feed_cover'] ) ? get_option( 'feed_options' )['feed_cover_id'] : false;
  $artwork_small = wp_get_attachment_image_src( $artwork_id, 'small_avatar')[0];
  $artwork_full = wp_get_attachment_image_src( $artwork_id);
  $show_color = isset( get_option( 'podcast_options' )['show_text_color'] ) ? get_option( 'podcast_options' )['show_text_color'] : '#000';


if ($artwork) {

?>
<link rel="apple-touch-icon" sizes="<?php echo $artwork_full[1].'x'.$artwork_full[2] ?>" href="<?php echo esc_url( $artwork_full[0]  );?>">
<link rel="icon" type="image/png" href="<?php echo esc_url( $artwork_small );?>" sizes="48x48">
<link rel="icon" type="image/png" sizes="<?php echo $artwork_full[1].'x'.$artwork_full[2] ?>" href="<?php echo esc_url( $artwork_full[0]  );?>">
<link rel="manifest" href="<?php echo $upload_dir['baseurl'].'/favicon.json';?>">
<link rel="mask-icon" href="<?php echo esc_url( $favicon_path );?>safari-pinned-tab.svg" color="<?php echo $show_color;?>">
<meta name="apple-mobile-web-app-title" content="<?php echo $show_name; ?>">
<meta name="application-name" content="<?php echo $show_name; ?> ">
<meta name="msapplication-config" content="<?php echo $upload_dir['baseurl'].'/browserconfig.xml';?>">
<meta name="theme-color" content="<?php echo $show_color;?>">
<?php } else { ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $favicon_path );?>apple-touch-icon.png">
<link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_path );?>favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_path );?>favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php echo $upload_dir['baseurl'].'/favicon.json';?>">
<link rel="mask-icon" href="<?php echo esc_url( $favicon_path );?>safari-pinned-tab.svg" color="#ff005d">
<meta name="apple-mobile-web-app-title" content="<?php echo $show_name; ?>">
<meta name="application-name" content="<?php echo $show_name; ?> ">
<meta name="msapplication-config" content="<?php echo $upload_dir['baseurl'].'/browserconfig.xml';?>">
<meta name="theme-color" content="#ff005d">
<?php }
}
add_action( 'wp_head', 'theme_favicons' );
add_action( 'admin_head', 'theme_favicons' );

/**
 *Generate Favicon JSON
 */
function favicon_json () {
  $upload_dir = wp_upload_dir();
  $my_file = $upload_dir['basedir'].'/favicon.json';
  $show_name = isset( get_option( 'feed_options' )['feed_title'] ) ? get_option( 'feed_options' )['feed_title'] : get_bloginfo( 'name' );
  $artwork = isset( get_option( 'feed_options' )['feed_cover'] ) ? get_option( 'feed_options' )['feed_cover'] : false;
  $artwork_id = isset( get_option( 'feed_options' )['feed_cover'] ) ? get_option( 'feed_options' )['feed_cover_id'] : false;
  $artwork_thumb = wp_get_attachment_image_src( $artwork_id, 'player_thumb')[0];
  $artwork_full = wp_get_attachment_image_src( $artwork_id);

  $show_color = isset( get_option( 'podcast_options' )['show_text_color'] ) ? get_option( 'podcast_options' )['show_text_color'] : '#000';

  $append = '{
    "name": "'.$show_name.'",
    "icons": [
        {
            "src": "'.get_template_directory_uri().'/assets/favicon/android-chrome-192x192.png",
            "sizes": "192x192",
            "type": "image/png"
        },
        {
            "src": "'.get_template_directory_uri().'/assets/favicon/android-chrome-512x512.png",
            "sizes": "256x256",
            "type": "image/png"
        }
    ],
    "theme_color": "#ff005d",
    "background_color": "#ff005d",
    "display": "standalone"
  }';


  if ($artwork) {
    $append = '{
        "name": "'.$show_name.'",
        "icons": [
            {
                "src": "'.$artwork_full[0].'",
                "sizes": "'.$artwork_full[1].'x'.$artwork_full[2].'",
                "type": "image/png"
            },
            {
                "src": "'.$artwork_thumb.'",
                "sizes": "130x130",
                "type": "image/png"
            }
        ],
        "theme_color": "'.$show_color.'",
        "background_color": "'.$show_color.'",
        "display": "standalone"
    }';
  }

  file_put_contents($my_file, $append );
};


/**
 * Generate Favicon xml
 */
function favicon_browserconfig () {
  $upload_dir = wp_upload_dir();
  $my_file = $upload_dir['basedir'].'/browserconfig.xml';
  $artwork = isset( get_option( 'feed_options' )['feed_cover'] ) ? get_option( 'feed_options' )['feed_cover'] : false;
  $artwork_id = isset( get_option( 'feed_options' )['feed_cover'] ) ? get_option( 'feed_options' )['feed_cover_id'] : false;
  $artwork_full = wp_get_attachment_image_src( $artwork_id, 'full');
  $show_color = isset( get_option( 'podcast_options' )['show_text_color'] ) ? get_option( 'podcast_options' )['show_text_color'] : '#000';

  $append = '<?xml version="1.0" encoding="utf-8"?>
  <browserconfig>
      <msapplication>
          <tile>
              <square150x150logo src="'.get_template_directory_uri().'/assets/favicon/mstile-150x150.png"/>
              <TileColor>#ff005d</TileColor>
          </tile>
      </msapplication>
  </browserconfig>';

  if ($artwork) {
    $append = '<?xml version="1.0" encoding="utf-8"?>
    <browserconfig>
        <msapplication>
            <tile>
                <square150x150logo src="'.$artwork_full[0].'"/>
                <TileColor>'.$show_color.'</TileColor>
            </tile>
        </msapplication>
    </browserconfig>';
  }
    file_put_contents($my_file, $append );
};

/**
 * Generate files on option update
 */
add_action('update_option_blogname', function( $old_value, $value ) {
  favicon_browserconfig();
  favicon_json();
}, 10, 2);

add_action('update_option_feed_cover', function( $old_value, $value ) {
  favicon_browserconfig();
  favicon_json();
}, 10, 2);


/**
 * Generate files on theme activate
 */
add_action('after_switch_theme', 'favicon_setup_options');
function mytheme_setup_options () {
  favicon_browserconfig();
  favicon_json();
}

