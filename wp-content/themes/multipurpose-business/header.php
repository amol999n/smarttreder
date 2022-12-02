<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Multipurpose Business
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
<?php if (multipurpose_business_get_option('homepage_layout_version') == 'light-scheme') {
    $multipurpose_business_homepage_version = 'light-scheme';
} elseif (multipurpose_business_get_option('homepage_layout_version') == 'dark-scheme') {
    $multipurpose_business_homepage_version = 'dark-scheme';
}?>

<div id="page" class="site site-bg <?php echo esc_attr($multipurpose_business_homepage_version); ?>">

    <?php if ((multipurpose_business_get_option('enable_preloader')) == 1) { ?>
        <div class="preloader">
            <div class="loader">
                <div class="dot dot-1"></div>
                <div class="dot dot-2"></div>
                <div class="dot dot-3"></div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                <defs>
                    <filter id="flubber">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
                        <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"></feColorMatrix>
                    </filter>
                </defs>
            </svg>
        </div>
    <?php } ?>


    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'multipurpose-business'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <div id="nav-affix" class="top-header header--fixed">
            <div class="wrapper-fluid">
                <div class="site-branding primary-bgcolor">
                    <?php if (has_custom_logo()) { ?>
                        <div class="brand-image alt-bg">
                            <?php multipurpose_business_the_custom_logo(); ?>
                        </div>
                    <?php } ?>
                    <div class="brand-details">
                        <?php
                        if (is_front_page() && is_home()) : ?>
                            <span class="site-title primary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                        <?php else : ?>
                            <span class="site-title primary-font">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                        <?php
                        endif;
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <span class="site-description">
                                <?php echo esc_html($description); ?>
                            </span>
                        <?php
                        endif; ?>
                    </div>
                </div>
                <?php if ((multipurpose_business_get_option('enable_contact_on_side_panel') == 1) || (multipurpose_business_get_option('enable_search_on_header') == 1)) { ?>
                    <div class="data-bind-mneu-icons">
                        <?php if (multipurpose_business_get_option('enable_contact_on_side_panel') == 1) { ?>
                            <div class="icon-contact">
                                <button id="contact-reveal">
                                    <?php esc_html_e('Contact us', 'multipurpose-business'); ?>
                                </button>
                            </div>
                        <?php } ?>

                        <?php if (multipurpose_business_get_option('enable_search_on_header') == 1) { ?>
                            <a href="javascript:void(0)" class="icon-search">
                                <i class="ion-ios-search-strong"></i>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>

                <nav class="main-navigation" role="navigation">
                    <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                    <a href="javascript:void(0)" class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                         <span class="screen-reader-text">
                            <?php esc_html_e('Primary Menu', 'multipurpose-business'); ?>
                        </span>
                        <i class="ham"></i>
                    </a>

                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu'
                    )); ?>
                    <a href="javascript:void(0)" class="skip-link-menu-end"></a>
                </nav>
            </div>
        </div>
        <?php if(is_front_page()){ ?>
            <?php do_action('multipurpose_business_action_banner_section'); ?>
        <?php } ?>
    </header>

    <div class="popup-search">
        <div class="table-align">
            <a href="javascript:void(0)" class="skip-link-search-start"></a>
            
            <div class="table-align-cell v-align-middle">
                <?php get_search_form(); ?>
            </div>
            <a href="javascript:void(0)" class="close-popup-1"></a>
        </div>
        
        <a href="javascript:void(0)" class="skip-link-search-end"></a>
    </div>

    <div class="popup-contact">
        <div class="table-align">
            <div class="table-align-cell v-align-middle">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-half hidden-mobile">
                            <div class="popup-contact-details">
                                <?php
                                $multipurpose_business_contact_page = array();
                                $multipurpose_business_contact_page[] = absint(multipurpose_business_get_option('select_contact_page'));
                                if (!empty($multipurpose_business_contact_page)) {
                                    $multipurpose_business_contact_page_args = array(
                                        'post_type' => 'page',
                                        'post__in' => $multipurpose_business_contact_page,
                                        'orderby' => 'post__in'
                                    );
                                }
                                if (!empty($multipurpose_business_contact_page_args)) {
                                $multipurpose_business_contact_page_query = new WP_Query($multipurpose_business_contact_page_args);
                                while ($multipurpose_business_contact_page_query->have_posts()):
                                $multipurpose_business_contact_page_query->the_post();
                                $multipurpose_business_contact_excerpt_number = absint(multipurpose_business_get_option('excerpt_length_contact'));
                                ?>
                                    <h2>
                                        <?php the_title(); ?>
                                    </h2>
                                    <?php if (has_excerpt()) {
                                       the_excerpt();
                                    }else{
                                        $multipurpose_business_slider_content = multipurpose_business_words_count($multipurpose_business_contact_excerpt_number, get_the_content());
                                        echo esc_html($multipurpose_business_slider_content);
                                    } ?>

                                    <?php if (multipurpose_business_get_option('enable_social_menu_on_contact') == 1) { ?>
                                        <div class="social-icons popup-social-icons">
                                            <?php
                                            wp_nav_menu(
                                                array('theme_location' => 'social',
                                                    'link_before' => '<span>',
                                                    'link_after' => '</span>',
                                                    'menu_id' => 'social-menu',
                                                    'fallback_cb' => false,
                                                    'menu_class' => false
                                                )); ?>
                                        </div>
                                    <?php } ?>

                                <?php endwhile;
                                wp_reset_postdata();
                                } ?>
                            </div>
                        </div>
                        <div class="col col-half">
                            <div id="contact-form">
                                <?php
                                $multipurpose_business_contact_form_code = wp_kses_post(multipurpose_business_get_option('contact_form_shortcode'));
                                if (!empty($multipurpose_business_contact_form_code)) {
                                    echo do_shortcode($multipurpose_business_contact_form_code);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="close-popup-2"></div>
    </div>


    <!--    Searchbar Ends-->
    <div class="site-content-bg">
        <div id="content" class="site-content">