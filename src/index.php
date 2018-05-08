<?php
/**
 * The template for displaying the index
 *
 * Displays the index of the theme
 *
 * PHP version 5
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

/**
 * Header Template
 */
require'templates/header.php';
include'templates/menu.php';
require'templates/status.php';
require'templates/social.php';
//include'templates/about.php';
require'templates/schedule.php';
// require'templates/catering.php';

// require'templates/media.php';
// require'templates/contact.php';
$tag = cmb2_get_option('eggman_options', 'hashtag');
// queryInsta($tag);
//queryInsta('theeggmaninc');

 //queryTwitter('ebgames');
?>

<?php
/**
 * Footer Template
 */
require'templates/footer.php';
