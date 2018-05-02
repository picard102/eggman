<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */

?>
<footer id="site_footer" class="site-footer">
	<div class="wrapper">

		<div class="line">
			<svg><use xlink:href="#egg-cross"></use></svg>
		</div>

		<div class="meta">
			<svg class='logo'><use xlink:href="#logo-full"></use></svg>
		</div>

		<div class="meta">
		<?php echo '<p>'. $hashtag .'</p>'; ?>
		</div>

		<div class="line">
			<svg><use xlink:href="#bacon-cross"></use></svg>
		</div>

		<small>&copy; <?php echo date("Y"); ?> All rights reserved. Thomas Januszewski </small>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
