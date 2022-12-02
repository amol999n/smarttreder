<?php
/**
 * Multipurpose Business functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Multipurpose Business
 */

if (!function_exists('multipurpose_business_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function multipurpose_business_setup()
    {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Multipurpose Business, use a find and replace
         * to change 'multipurpose-business' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'multipurpose-business', get_template_directory() . '/languages' );



        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         */
        add_theme_support('custom-logo', array(
            'header-text' => array('site-title', 'site-description'),
        ));
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('multipurpose-business-slider-img', 720, 576, true);
        add_image_size('multipurpose-business-normal-post', 560, 560, true);

        add_theme_support('custom-header', apply_filters(
                'multipurpose_business_custom_header_args', array(
                    'default-image'    => get_template_directory_uri(). '/assets/images/header-banner.jpg',
                    'flex-height' => true,
                    'header-text' => true,
                    'default-text-color' => '000',
                    'width'            => 1600,
                    'height'           => 900,
                    'video'            => true,
                )
            )
        );

        register_default_headers(
            array(
                'default-image' => array(
                    'url'           => get_template_directory_uri().'/assets/images/header-banner.jpg',
                    'thumbnail_url' => get_template_directory_uri().'/assets/images/header-banner.jpg',
                    'description'   => __( 'Default Header Image', 'multipurpose-business' ),
                ),
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );
        // Adding support for core block visual styles.
        add_theme_support( 'wp-block-styles' );
        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );
        
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'multipurpose-business'),
            'social' => esc_html__('Social Menu', 'multipurpose-business'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('multipurpose_business_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'image',
            'video',
            'gallery',
            'audio',
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, and column width.
         */
        add_editor_style( 'assets/twp/css/editor-style.css' );

        /**
         * Load Init for Hook files.
         */
        require get_template_directory() . '/inc/hooks/hooks-init.php';

    }
endif;
add_action('after_setup_theme', 'multipurpose_business_setup');

function multipurpose_business_attachment_display_settings() {
    update_option( 'image_default_align', 'none' );
    update_option( 'image_default_link_type', 'none' );
    update_option( 'image_default_size', 'full' );
}
add_action( 'after_setup_theme', 'multipurpose_business_attachment_display_settings' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function multipurpose_business_content_width()
{
    $GLOBALS['content_width'] = apply_filters('multipurpose_business_content_width', 640);
}

add_action('after_setup_theme', 'multipurpose_business_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
function multipurpose_business_scripts()
{
    wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/assets/libraries/owlcarousel/css/owl.carousel.css');
    wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/libraries/ionicons/css/ionicons.min.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/libraries/magnific-popup/magnific-popup.css');
    wp_enqueue_style('multipurpose-business-style', get_stylesheet_uri());
    /*inline style*/
    wp_add_inline_style('multipurpose-business-style', multipurpose_business_trigger_custom_css_action());

    $fonts_url = multipurpose_business_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('multipurpose-business-google-fonts', $fonts_url, array(), null);
    }

    wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script('multipurpose-business-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('headroom', get_template_directory_uri() . '/assets/libraries/headroom/headroom.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-headroom', get_template_directory_uri() . '/assets/libraries/headroom/jQuery.headroom.js', array('jquery'), '', true);
    wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/assets/libraries/owlcarousel/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/libraries/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-match-height', get_template_directory_uri() . '/assets/libraries/jquery-match-height/js/jquery.matchHeight.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-stellar', get_template_directory_uri().'/assets/libraries/stellar/jquery.stellar.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-scroll', get_template_directory_uri() . '/assets/twp/js/twp-scroll.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-isotope', get_template_directory_uri() . '/assets/libraries/isotope/isotope.pkgd.min.js', array('jquery'), '', true);
    wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', true);
    /*For Ajax Load Posts*/
    $args = array(
        'nonce' => wp_create_nonce( 'multipurpose-business-load-more-nonce' ),
        'ajaxurl'   => admin_url( 'admin-ajax.php' ),
    );
    if( is_front_page() ){
        $args['post_type'] = 'post';
    }

    /*Support for custom post types*/
    if( is_post_type_archive() ){
        $args['post_type'] = get_queried_object()->name;
    }
    /**/

    /*Support for categories and taxonomies*/
    if( is_category() || is_tag() || is_tax() ){
        $args['cat'] = get_queried_object()->slug;
        $args['taxonomy'] = get_queried_object()->taxonomy;
        /*Get the associated post type for custom taxonomy*/
        if( is_tax() ){
            global $wp_taxonomies;
            $tax_object = isset( $wp_taxonomies[$args['taxonomy']] ) ? $wp_taxonomies[$args['taxonomy']]->object_type : array();
            $args['post_type'] = array_pop($tax_object);
        }
        /**/
    }
    /**/

    /*Support for search*/
    if( is_search() ){
        $args['search'] = get_search_query();
    }
    /**/

    /*Support for author*/
    if( is_author() ){
        $args['author'] = get_the_author_meta( 'user_nicename' ) ;
    }
    /**/

    /*Support for date archive*/
    if( is_date() ){
        $args['year'] = get_query_var('year');
        $args['month'] = get_query_var('monthnum');
        $args['day'] = get_query_var('day');
    }
    /**/

    wp_enqueue_script('multipurpose-business-script', get_template_directory_uri() . '/assets/twp/js/custom-script.js', array( 'jquery', 'wp-mediaelement'), '', true);
    wp_localize_script( 'multipurpose-business-script', 'businessStartupVal', $args );


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'multipurpose_business_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function multipurpose_business_admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('multipurpose-business-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array('jquery'), '1.0.0', true);
    }

    wp_enqueue_style('multipurpose-business-custom-admin-style', get_template_directory_uri() . '/assets/twp/css/admin.css', array(), '1.0.0');

}

add_action('admin_enqueue_scripts', 'multipurpose_business_admin_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


//* Add description to menu items
add_filter( 'walker_nav_menu_start_el', 'multipurpose_business_add_description', 10, 2 );
function multipurpose_business_add_description( $item_output, $item ) {
    $description = $item->post_content;
    if (('' !== $description) && (' ' !== $description) ) {
        return preg_replace( '/(<a.*)</', '$1' . '<span class="menu-description">' . $description . '</span><', $item_output) ;
    }
    else {
        return $item_output;
    };
}