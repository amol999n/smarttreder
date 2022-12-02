<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function multipurpose_business_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'multipurpose-business'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'multipurpose-business'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title center-widget-title">',
        'after_title' => '</h5>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Home Page Widget Area', 'multipurpose-business'),
        'id' => 'sidebar-home',
        'description' => esc_html__('Add widgets here which will apear on your home page.', 'multipurpose-business'),
        'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    $multipurpose_business_footer_widgets_number = multipurpose_business_get_option('number_of_footer_widget');

    if ($multipurpose_business_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer Column One', 'multipurpose-business'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'multipurpose-business'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="widget-title">',
            'after_title' => '</h5>',
        ));
        if ($multipurpose_business_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Two', 'multipurpose-business'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'multipurpose-business'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="widget-title">',
                'after_title' => '</h5>',
            ));
        }
        if ($multipurpose_business_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Three', 'multipurpose-business'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'multipurpose-business'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="widget-title">',
                'after_title' => '</h5>',
            ));
        }
        if ($multipurpose_business_footer_widgets_number > 3) {
            register_sidebar(array(
                'name' => esc_html__('Footer Column Four', 'multipurpose-business'),
                'id' => 'footer-col-four',
                'description' => esc_html__('Displays items on footer section.', 'multipurpose-business'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h5 class="widget-title">',
                'after_title' => '</h5>',
            ));
        }
    }
}

add_action('widgets_init', 'multipurpose_business_widgets_init');
