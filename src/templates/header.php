<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php endif; ?>
  <?php wp_head(); ?>
  <title><?php wp_title( '|', true, 'right' ); ?></title>
</head>
<?php
$hashtag = isset( get_option( 'eggman_options' )['footer'] ) ? get_option( 'eggman_options' )['footer'] : false;
$generalContact = isset( get_option( 'eggman_options' )['general'] ) ? get_option( 'eggman_options' )['general'] : false;
$cateringContact = isset( get_option( 'eggman_options' )['catering'] ) ? get_option( 'eggman_options' )['catering'] : false;
$twitter = isset( get_option( 'eggman_options' )['twitter'] ) ? get_option( 'eggman_options' )['twitter'] : false;
$facebook = isset( get_option( 'eggman_options' )['facebook'] ) ? get_option( 'eggman_options' )['facebook'] : false;
$instagram = isset( get_option( 'eggman_options' )['instagram'] ) ? get_option( 'eggman_options' )['instagram'] : false;
?>

<body <?php body_class(); ?>>

<div class="sprite-hide">
  <?php include( get_stylesheet_directory() . '/assets/svg/svg-sprite.svg' ); ?>
</div>

<header class="site-header">
  <div class="logo">
	 <svg><use xlink:href="#logo-type"></use></svg>
  </div>
</header>

