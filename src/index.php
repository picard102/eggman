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
include'templates/about.php';
include'templates/media.php';
require'templates/social.php';
require'templates/schedule.php';


?>

<?php

/**
 * Footer Template
 */
require'templates/footer.php';
