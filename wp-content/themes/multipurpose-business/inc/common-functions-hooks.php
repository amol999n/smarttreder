<?php
if (!function_exists('multipurpose_business_the_custom_logo')):
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Multipurpose Business 1.0.0
 */
function multipurpose_business_the_custom_logo() {
	if (function_exists('the_custom_logo')) {
		the_custom_logo();
	}
}
endif;

if (!function_exists('multipurpose_business_body_class')):

/**
 * body class.
 *
 * @since 1.0.0
 */
function multipurpose_business_body_class($multipurpose_business_body_class) {
	global $post;
	$global_layout       = multipurpose_business_get_option('global_layout');
	$input               = '';
	$home_content_status = multipurpose_business_get_option('home_page_content_status');
	if (1 != $home_content_status) {
		$input = 'home-content-not-enabled';
	}
	// Check if single.
	if ($post && is_singular()) {
		$post_options = get_post_meta($post->ID, 'multipurpose-business-meta-select-layout', true);
		if (empty($post_options)) {
			$global_layout = esc_attr(multipurpose_business_get_option('global_layout'));
		} else {
			$global_layout = esc_attr($post_options);
		}
	}
	if ($global_layout == 'left-sidebar') {
		$multipurpose_business_body_class[] = 'left-sidebar '.esc_attr($input);
	} elseif ($global_layout == 'no-sidebar') {
		$multipurpose_business_body_class[] = 'no-sidebar '.esc_attr($input);
	} else {
		$multipurpose_business_body_class[] = 'right-sidebar '.esc_attr($input);

	}
    // Add class on front page.
    if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
        $multipurpose_business_body_class[] = 'bs-front-page';
    }

    // Add a class if there is a custom header.
    if ( has_header_image() ) {
        $multipurpose_business_body_class[] = 'has-header-image';
    }
    if ( has_header_video() ) {
        $multipurpose_business_body_class[] = 'has-header-video';
    }
	return $multipurpose_business_body_class;
}
endif;

add_action('body_class', 'multipurpose_business_body_class');

add_action('multipurpose_business_action_sidebar', 'multipurpose_business_add_sidebar');

/**
 * Returns word count of the sentences.
 *
 * @since Multipurpose Business 1.0.0
 */
if (!function_exists('multipurpose_business_words_count')):
function multipurpose_business_words_count($length = 25, $multipurpose_business_content = null) {
	$length          = absint($length);
	$source_content  = preg_replace('`\[[^\]]*\]`', '', $multipurpose_business_content);
	$trimmed_content = wp_trim_words($source_content, $length, '');
	return $trimmed_content;
}
endif;

if (!function_exists('multipurpose_business_simple_breadcrumb')):

/**
 * Simple breadcrumb.
 *
 * @since 1.0.0
 */
function multipurpose_business_simple_breadcrumb() {

	if (!function_exists('breadcrumb_trail')) {

		require_once get_template_directory().'/assets/libraries/breadcrumbs/breadcrumbs.php';
	}

	$breadcrumb_args = array(
		'container'   => 'div',
		'show_browse' => false,
	);
	breadcrumb_trail($breadcrumb_args);

}

endif;



if ( ! function_exists( 'multipurpose_business_ajax_pagination' ) ) :
    /**
     * Outputs the required structure for ajax loading posts on scroll and click
     *
     * @since 1.0.0
     * @param $type string Ajax Load Type
     */
    function multipurpose_business_ajax_pagination($type) {
        ?>
        <div class="load-more-posts" data-load-type="<?php echo esc_attr($type);?>">
            <a href="#" class="btn btn-primary">
                <span class="ajax-loader"></span>
                <?php _e('Load More Posts', 'multipurpose-business')?>
                <i class="ion-ios-arrow-right"></i>
            </a>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'multipurpose_business_load_more' ) ) :
    /**
     * Ajax Load posts Callback.
     *
     * @since 1.0.0
     *
     */
    function multipurpose_business_load_more() {
        
        add_filter('excerpt_more', 'multipurpose_business_excerpt_more');

        check_ajax_referer( 'multipurpose-business-load-more-nonce', 'nonce' );

        $output['more_post'] = false;
        $output['content'] = array();

        $args['post_type'] = ( isset( $_GET['post_type']) && !empty($_GET['post_type'] ) ) ? esc_attr( $_GET['post_type'] ) : 'post';
        $args['post_status'] = 'publish';
        $args['paged'] = (int) esc_attr( $_GET['page'] );

        if( isset( $_GET['cat'] ) && isset( $_GET['taxonomy'] ) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => esc_attr($_GET['taxonomy']),
                    'field'    => 'slug',
                    'terms'    => array(esc_attr($_GET['cat'])),
                ),
            );
        }

        if( isset($_GET['search']) ){
            $args['s'] = esc_attr( $_GET['search'] );
        }

        if( isset($_GET['author']) ){
            $args['author_name'] = esc_attr( $_GET['author'] );
        }

        if( isset($_GET['year']) || isset($_GET['month']) || isset($_GET['day']) ){

            $date_arr = array();

            if( !empty($_GET['year']) ){
                $date_arr['year'] = (int) esc_attr($_GET['year']);
            }
            if( !empty($_GET['month']) ){
                $date_arr['month'] = (int) esc_attr($_GET['month']);
            }
            if( !empty($_GET['day']) ){
                $date_arr['day'] = (int) esc_attr($_GET['day']);
            }

            if( !empty($date_arr) ){
                $args['date_query'] = array($date_arr);
            }
        }

        $loop = new WP_Query( $args );
        if($loop->max_num_pages > $args['paged']){
            $output['more_post'] = true;
        }
        if ( $loop->have_posts() ):
            while ( $loop->have_posts() ): $loop->the_post();
                ob_start();
                get_template_part('template-parts/content', get_post_format());
                $output['content'][] = ob_get_clean();
            endwhile;wp_reset_postdata();
            wp_send_json_success($output);
        else:
            $output['more_post'] = false;
            wp_send_json_error($output);
        endif;
        wp_die();
    }
endif;
add_action( 'wp_ajax_multipurpose_business_load_more', 'multipurpose_business_load_more' );
add_action( 'wp_ajax_nopriv_multipurpose_business_load_more', 'multipurpose_business_load_more' );


if (!function_exists('multipurpose_business_custom_posts_navigation')):
/**
 * Posts navigation.
 *
 * @since 1.0.0
 */
function multipurpose_business_custom_posts_navigation() {

	$pagination_type = multipurpose_business_get_option('pagination_type');

	switch ($pagination_type) {

		case 'default':
			the_posts_navigation();
			break;

		case 'numeric':
			the_posts_pagination();
			break;

        case 'infinite_scroll_load':
            multipurpose_business_ajax_pagination('scroll');
            break;
        case 'button_click_load':
                multipurpose_business_ajax_pagination('click');
                break;
		default:
			break;
	}

}
endif;

add_action('multipurpose_business_action_posts_navigation', 'multipurpose_business_custom_posts_navigation');

if (!function_exists('multipurpose_business_excerpt_length') && !is_admin()):

/**
 * Excerpt length
 *
 * @since  Multipurpose Business 1.0.0
 *
 * @param null
 * @return int
 */
function multipurpose_business_excerpt_length($length) {
	$excerpt_length = multipurpose_business_get_option('excerpt_length_global');
	if (empty($excerpt_length)) {
		$excerpt_length = $length;
	}
	return absint($excerpt_length);

}

add_filter('excerpt_length', 'multipurpose_business_excerpt_length', 999);
endif;


if (!function_exists('multipurpose_business_get_link_url')):

/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since 1.0.0
 *
 * @return string The Link format URL.
 */
function multipurpose_business_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content($content);

	return ($has_url)?$has_url:apply_filters('the_permalink', get_permalink());
}

endif;

if (!function_exists('multipurpose_business_fonts_url')):

/**
 * Return fonts URL.
 *
 * @since 1.0.0
 * @return string Fonts URL.
 */
function multipurpose_business_fonts_url() {
	$fonts_url = '';
	$fonts     = array();

	$multipurpose_business_primary_font   = multipurpose_business_get_option('primary_font');
	$multipurpose_business_secondary_font = multipurpose_business_get_option('secondary_font');

	$multipurpose_business_fonts   = array();
	$multipurpose_business_fonts[] = $multipurpose_business_primary_font;
	$multipurpose_business_fonts[] = $multipurpose_business_secondary_font;

	$multipurpose_business_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

	$i = 0;
	for ($i = 0; $i < count($multipurpose_business_fonts); $i++) {

		if ('off' !== sprintf(_x('on', '%s font: on or off', 'multipurpose-business'), $multipurpose_business_fonts[$i])) {
			$fonts[] = $multipurpose_business_fonts[$i];
		}

	}

	if ($fonts) {
		$fonts_url = add_query_arg(array(
				'family' => urldecode(implode('|', $fonts)),
			), 'https://fonts.googleapis.com/css');
	}

	return $fonts_url;
}

endif;



if (!function_exists('multipurpose_business_excerpt_more') && !is_admin()):

/**
 * Implement read more in excerpt.
 *
 * @since 1.0.0
 *
 * @param string $more The string shown within the more link.
 * @return string The excerpt.
 */
function multipurpose_business_excerpt_more($more) {
    $flag_apply_excerpt_read_more = apply_filters('multipurpose_business_filter_excerpt_read_more', true);
    if (true !== $flag_apply_excerpt_read_more) {
        return $more;
    }
    $output         = ' ';
    return $output;
}
add_filter('excerpt_more', 'multipurpose_business_excerpt_more');
endif;


/*related post*/
if (!function_exists('multipurpose_business_get_related_posts')) :
    /*
     * Function to get related posts
     */
    function multipurpose_business_get_related_posts()
    {
        global $post;

        //$options = multipurpose_business_get_theme_options(); // get theme options

        $post_categories = get_the_category($post->ID); // get category object
        $category_ids = array(); // set an empty array

        foreach ($post_categories as $post_category) {
            $category_ids[] = $post_category->term_id;
        }

        if (empty($category_ids)) return;

        $qargs = array(
            'posts_per_page' => 3,
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'order' => 'ASC',
            'orderby' => 'rand'
        );

        $related_posts = get_posts($qargs); // custom posts
        ?>
        <div class="related-articles">
            <header class="related-header">
                <h3 class="related-title widget-block-title">
                    <?php esc_html_e('You May Also Like', 'multipurpose-business'); ?>
                </h3>
            </header>

            <div class="entry-content">
                <?php foreach ($related_posts as $related_post) {
                    $post_title = get_the_title($related_post->ID);
                    $post_url = get_permalink($related_post->ID);
                    $post_date = get_the_date('', $related_post->ID);
                    $post_author = get_the_author_meta( 'display_name', $related_post->ID );
                    $posts_categories = get_the_category($related_post->ID);
                    ?>

                    <div class="suggested-article clear">
                        <?php if (has_post_thumbnail($related_post->ID)) {
                            $img_array = wp_get_attachment_image_src(get_post_thumbnail_id($related_post->ID), 'thumbnail'); ?>
                          <div class="post-image">
                              <a href="<?php echo esc_url($post_url); ?>" class="bg-image bg-image-1">
                                  <img src="<?php echo esc_url($img_array[0]); ?>" alt="<?php echo esc_attr($post_title); ?>">
                              </a>
                          </div>
                        <?php } ?>
                        <div class="related-content">
                            <div class="related-article-title">
                                <h4 class="entry-title entry-title-small">
                                    <a href="<?php echo esc_url($post_url); ?>"><?php echo wp_kses_post($post_title); ?></a>
                                </h4>
                            </div>
                            <div class="entry-meta small-font primary-font">
                                <?php echo esc_html('Posted On : ','multipurpose-business').$post_date; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
endif;
add_action('multipurpose_business_related_posts', 'multipurpose_business_get_related_posts');



/*Recomended plugin*/
if (!function_exists('multipurpose_business_recommended_plugins')):

/**
 * Recommended plugins
 *
 */
function multipurpose_business_recommended_plugins() {
	$multipurpose_business_plugins = array(
        array(
            'name'     => __('Contact Form by WPForms', 'multipurpose-business'),
            'slug'     => 'wpforms-lite',
            'required' => false,
        ),
        array(
          'name'     => __( 'WP Google Maps', 'multipurpose-business' ),
          'slug'     => 'wp-google-maps',
          'required' => false,
        ),
        array(
          'name'     => __( 'Elementor Page Builder', 'multipurpose-business' ),
          'slug'     => 'elementor',
          'required' => false,
        ),
	);
	$multipurpose_business_plugins_config = array(
		'dismissable' => true,
	);

	tgmpa($multipurpose_business_plugins, $multipurpose_business_plugins_config);
}
endif;
add_action('tgmpa_register', 'multipurpose_business_recommended_plugins');


function multipurpose_business_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'multipurpose_business_archive_title' );


function multipurpose_business_check_other_plugin() {
    // check for plugin using plugin name
    if (is_plugin_active('one-click-demo-import/one-click-demo-import.php')) {
        // Disable PT branding.
        add_filter('pt-ocdi/disable_pt_branding', '__return_true');
        //plugin is activated
        function ocdi_after_import_setup() {
            // Assign menus to their locations.
            $main_menu   = get_term_by('name', 'Primary Menu', 'nav_menu');
            $social_menu = get_term_by('name', 'Social Menu', 'nav_menu');

            set_theme_mod('nav_menu_locations', array(
                    'primary' => $main_menu->term_id,
                    'social'  => $social_menu->term_id,
                )
            );

            // Assign front page and posts page (blog page).
            $front_page_id = get_page_by_title('Homepage');
            $blog_page_id  = get_page_by_title('Blog');

            update_option('show_on_front', 'page');
            update_option('page_on_front', $front_page_id->ID);
            update_option('page_for_posts', $blog_page_id->ID);

        }
        add_action('pt-ocdi/after_import', 'ocdi_after_import_setup');
    }
}
add_action('admin_init', 'multipurpose_business_check_other_plugin');

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','multipurpose_business_after_content_pagination');

}

if( !function_exists('multipurpose_business_after_content_pagination') ):

    function multipurpose_business_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'multipurpose-business' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;