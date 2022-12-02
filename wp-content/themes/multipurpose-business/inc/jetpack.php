<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Multipurpose Business
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/responsive-videos/
 */
function multipurpose_business_jetpack_setup()
{
    // Add theme support for Responsive Videos.
    add_theme_support('jetpack-responsive-videos');
}

add_action('after_setup_theme', 'multipurpose_business_jetpack_setup');
