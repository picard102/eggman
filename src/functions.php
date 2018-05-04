<?php
/**
 * Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * PHP version 5
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

  $GLOBALS['template_dir_uri'] = get_template_directory_uri();
if ( isset( $_SERVER['SERVER_NAME'] ) ) {
  $GLOBALS['current_url'] = esc_url_raw( wp_unslash( 'http://' . $_SERVER['SERVER_NAME'] ) );
}

  require'includes/vendor/cmb2/init.php';


  require'includes/general_scripts.php';
  require'includes/general_styles.php';
  require'includes/disable_emojis.php';
  require'includes/theme_favicon.php';
  require'includes/disable_core.php';
  require'includes/image_size.php';
  require'includes/upsize.php';

  require'includes/admin/theme-options.php';

  require'includes/staff/cpt_staff.php';
  require'includes/press/cpt_press.php';
  require'includes/testimonials/cpt_testimonial.php';
  require'includes/menu/cpt_items.php';

  require'includes/admin/adminCol.php';


  require'includes/frontend/schedule.php';
  require'includes/frontend/menu.php';
