<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multipurpose Business
 */
global $post;
if (!is_active_sidebar('sidebar-1')) {
    return;
}
if (is_archive()) {
	$global_layout = esc_attr(multipurpose_business_get_option('global_layout'));
	if ($global_layout == 'no-sidebar') {
	    return;
	}
}
if (is_single()) {
	$post_options = get_post_meta($post->ID, 'multipurpose-business-meta-select-layout', true);
	if ($post_options == 'no-sidebar') {
	    return;
	}
}
if (is_front_page()){
	$global_layout = esc_attr(multipurpose_business_get_option('global_layout'));
	if ($global_layout == 'no-sidebar') {
	    return;
	}
} 
?>

<aside id="secondary" class="widget-area" role="complementary">
    <div class="theiaStickySidebar">
    	<?php dynamic_sidebar('sidebar-1'); ?>
	</div>
</aside><!-- #secondary -->