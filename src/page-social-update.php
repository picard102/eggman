<?php
/**
 * The template for Generic Pages
 *
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
?>
<h1>Updating Social Feeds</h1>
<?php
  queryInsta($hashtag);
  queryInsta('theeggmaninc');
  queryTwitter($hashtag);
  queryTwitterUser('TheEggmanCanada');
/**
 * Footer Template
 */
require'templates/footer.php';
