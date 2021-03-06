<?php
/**
 * The template for displaying the contact section
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @category PHP
 * @package  @theme_folder@
 * @author   @author_name@  <@author_email@>
 * @version  Release: @package_version@
 * @link     @git_link@
 */
?>

<section class="contact">
	<div class="wrapper">

	<div class="col_1">
		<h1>Contact</h1>
	</div>

	<div class="cols">
		<span>
			<h2>Catering</h2>
			<?php if (!empty($cateringContact)) {
            echo '<a href="mailto:'.$cateringContact.'">'.$cateringContact.'</a>';
          	}?>
		</span>
		<span>
			<h2>General</h2>
			<?php if (!empty($generalContact)) {
            echo '<a href="mailto:'.$generalContact.'">'.$generalContact.'</a>';
          	}?>
		</span>
		<span>
			<h2>Social</h2>
			  <?php
          if (!empty($twitter)) {
            echo '<a href="https://twitter.com/'.$twitter.'"><svg><use xlink:href="#twitter-icon"></use></svg> Twitter</a>';
          }
          if (!empty($facebook)) {
            echo '<a href="https://www.facebook.com/'.$facebook.'"><svg><use xlink:href="#facebook-icon"></use></svg> Facebook</a>';
          }
          if (!empty($instagram)) {
            echo '<a href="https://www.instagram.com/'.$instagram.'"><svg><use xlink:href="#instagram-icon"></use></svg> Instagram</a>';
          }
        ?>
		</span>
	</div><!-- cols -->

	</div>
</section>
