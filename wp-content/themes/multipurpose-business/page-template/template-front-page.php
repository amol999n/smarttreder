<?php
/**
* Template Name:Front Page Template
*
* @package themeinwp
* @subpackage Multipurpose Business
* @since Multipurpose Business 1.0.1
*/   

get_header();
?>
	<div id="homepage-widget-area" class="widget-content-area">
	<?php if (is_active_sidebar( 'sidebar-home') ) { ?>
	    <?php dynamic_sidebar('sidebar-home'); ?>
	<?php } ?>
	</div>

<?php 
get_footer();
