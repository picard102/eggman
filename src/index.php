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
?>

<div class="cta-nav">

<div class="about-grid">
  <div class="about-cta">
    <span> <svg><use xlink:href="#egg-cross"></use></svg> About</span>
  </div>
  <div class="about-content">Hi</div>
</div>

<div class="schedule-grid">
  <div class="schedule-cta">
    <span> <svg><use xlink:href="#calendar-icon"></use></svg> Schedule</span>
  </div>
  <div class="schedule-content"><?php require'templates/schedule.php'; ?></div>
</div>


</div>



<?php

require'templates/social.php';


//include'templates/about.php';
//require'templates/schedule.php';
// require'templates/catering.php';

?>

<?php

/**
 * Footer Template
 */
require'templates/footer.php';
