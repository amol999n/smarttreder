<?php
/**
 * Theme widgets.
 *
 * @package Multipurpose Business
 */

// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';

if (!function_exists('multipurpose_business_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function multipurpose_business_load_widgets()
    {
        // Multipurpose_Business_Service_widget.
        register_widget('Multipurpose_Business_Service_widget');

        // Multipurpose_Business_Intro_widget.
        register_widget('Multipurpose_Business_Intro_widget');

        // Multipurpose_Business_Call_To_Action_widget.
        register_widget('Multipurpose_Business_Call_To_Action_widget');

        // Multipurpose_Business_Testimonial.
        register_widget('Multipurpose_Business_Testimonial');

        // Multipurpose_Business_Blog_Widget widget.
        register_widget('Multipurpose_Business_Blog_Widget');

        // Multipurpose_Business_Client_Widget widget.
        register_widget('Multipurpose_Business_Client_Widget');

        // Recent Post widget.
        register_widget('Multipurpose_Business_sidebar_widget');

        // Auther widget.
        register_widget('Multipurpose_Business_Author_Post_widget');

        // Social widget.
        register_widget('Multipurpose_Business_Social_widget');

        // Business_startup_Portfolio.
        register_widget('Business_startup_Portfolio');

        // Business_startup_Contact.
        register_widget('Business_startup_Contact');

    }
endif;
add_action('widgets_init', 'multipurpose_business_load_widgets');


/*Multipurpose_Business_Service_widget widget*/
if (!class_exists('Multipurpose_Business_Service_widget')) :

    /**
     * Multipurpose Business Widget
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Service_widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_service_widget',
                'description' => __('Displays post form selected pages as service page', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_url' => array(
                    'label' => esc_html__('Section Featured Image:', 'multipurpose-business'),
                    'type' => 'image',
                ),
                'image_side' => array(
                    'label' => __('Move Image to Right', 'multipurpose-business'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'multipurpose-business'),
                    'description' => __('Number of words', 'multipurpose-business'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'enable_featured_image' => array(
                    'label' => __('Switch to Feature Image', 'multipurpose-business'),
                    'description' => __('Font Icon will be replaced by featured image of particular pages', 'multipurpose-business'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'service_page_1' => array(
                    'label' => __('Select Page 1:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'service_icon_1' => array(
                    'label' => __('Service Icon 1:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
                'service_page_2' => array(
                    'label' => __('Select Page 2:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'service_icon_2' => array(
                    'label' => __('Service Icon 2:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
                'service_page_3' => array(
                    'label' => __('Select Page 3:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'service_icon_3' => array(
                    'label' => __('Service Icon 3:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
                'service_page_4' => array(
                    'label' => __('Select Page 4:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'service_icon_4' => array(
                    'label' => __('Service Icon 4:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
            );

            parent::__construct('multipurpose-business-service-layout', __('MB :- Service Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            ?>

            <div class="widget-block widget-feature widget-bg widget-bg-2">
                <?php $bs_service_class = "col-full"; ?>

                <?php if (true === $params['image_side']) {
                    $bs_image_side = 'align-wrapper-rtl';
                } else {
                    $bs_image_side = 'align-wrapper-ltr';
                } ?>
                <div class="align-wrapper <?php echo esc_attr($bs_image_side); ?>">
                    <?php if (!empty($params['image_url'])) { ?>
                        <div class="col col-four col-sm-full" data-mh="feature-group">
                            <div data-mh="feature-group" class="feature-featured data-bg"
                                 data-background="<?php echo esc_url($params['image_url']); ?>"
                                 data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"></div>
                        </div>
                    <?php } ?>
                    <div class="col col-six col-sm-full" data-mh="feature-group">
                        <div class="col-row">
                            <?php if (!empty($params['title'])) { ?>
                                <div class="feature-grid-title clear">
                                    <div class="col col-full">
                                        <h2 class="widget-title widget-title-medium widget-title-1 widget-title-2">
                                            <?php echo esc_html($params['title']); ?>
                                        </h2>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="feature-grid">
                                <?php
                                // ID validation.
                                $service_page_ids = '';
                                for ($i = 1; $i <= 4; $i++) {
                                    if (absint($params['service_page_' . $i]) > 0) {
                                        $service_page_ids = absint($params['service_page_' . $i]);
                                    }
                                    if (absint($service_page_ids) > 0) {
                                        $qargs = array(
                                            'p' => absint($service_page_ids),
                                            'post_type' => 'any',
                                            'no_found_rows' => true,
                                        );

                                        $the_query = new WP_Query($qargs);
                                        if ($the_query->have_posts()) {
                                            while ($the_query->have_posts()) {
                                                $the_query->the_post();
                                                ?>
                                                <div class="col col-half">
                                                    <div class="feature-block">
                                                        <?php if (true === $params['enable_featured_image']) { ?>
                                                            <?php if (has_post_thumbnail()) {
                                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                                                $url = $thumb['0']; ?>
                                                                <div class="feature-icon">
                                                                    <img src="<?php echo esc_url($url); ?>">
                                                                </div>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <div class="feature-icon">
                                                                <i class="twp-design-icon <?php echo esc_attr($params['service_icon_' . $i]); ?>"></i>
                                                            </div>
                                                        <?php } ?>

                                                        <div class="feature-details">
                                                            <h3 class="block-title">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                            <p>
                                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                                    <?php
                                                                    $excerpt = multipurpose_business_words_count(absint($params['excerpt_length']), get_the_content());
                                                                    echo wp_kses_post($excerpt);
                                                                    ?>
                                                                <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $service_page_ids = '';
                                            wp_reset_postdata();
                                        }
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Multipurpose_Business_Intro_widget widget*/
if (!class_exists('Multipurpose_Business_Intro_widget')) :

    /**
     * Multipurpose Business Widget
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Intro_widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_intro_widget',
                'description' => __('Displays post form selected pages as intro page', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_url' => array(
                    'label' => esc_html__('Section Background Image:', 'multipurpose-business'),
                    'type' => 'image',
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'multipurpose-business'),
                    'description' => __('Number of words', 'multipurpose-business'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'enable_featured_image' => array(
                    'label' => __('Switch to Feature Image', 'multipurpose-business'),
                    'description' => __('Font Icon will be replaced by featured image of particular pages', 'multipurpose-business'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'intro_page_1' => array(
                    'label' => __('Select Page 1:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'intro_icon_1' => array(
                    'label' => __('Intro Icon 1:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
                'intro_page_2' => array(
                    'label' => __('Select Page 2:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'intro_icon_2' => array(
                    'label' => __('Intro Icon 2:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
                'intro_page_3' => array(
                    'label' => __('Select Page 3:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'intro_icon_3' => array(
                    'label' => __('Intro Icon 3:', 'multipurpose-business'),
                    'description' => __('please get icon form https://ionicons.com/v2/cheatsheet.html', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                    'default' => 'ion-images',
                ),
            );

            parent::__construct('multipurpose-business-intro-layout', __('MB :- Intro Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            ?>


            <div class="widget-block widget-intro widget-data-bg data-bg"
                 data-background="<?php echo esc_url($params['image_url']); ?>" data-stellar-background-ratio="0.5">
                <div class="widget-content">
                    <div class="wrapper">
                        <div class="col-row">
                            <div class="col col-full">
                                <h2 class="entry-title widget-title widget-title-medium">
                                    <?php echo esc_html($params['title']); ?>
                                </h2>
                                <div class="divider v-divider"></div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="col-row">

                            <?php
                            // ID validation.
                            $intro_page_ids = '';
                            for ($i = 1; $i <= 3; $i++) {
                                if (absint($params['intro_page_' . $i]) > 0) {
                                    $intro_page_ids = absint($params['intro_page_' . $i]);
                                }
                                if (absint($intro_page_ids) > 0) {
                                    $qargs = array(
                                        'p' => absint($intro_page_ids),
                                        'post_type' => 'any',
                                        'no_found_rows' => true,
                                    );

                                    $the_query = new WP_Query($qargs);
                                    if ($the_query->have_posts()) {
                                        while ($the_query->have_posts()) {
                                            $the_query->the_post();
                                            ?>

                                            <div class="col col-three col-sm-full">
                                                <div class="feature-block">
                                                    <?php if (true === $params['enable_featured_image']) { ?>
                                                        <?php if (has_post_thumbnail()) {
                                                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                                            $url = $thumb['0']; ?>
                                                            <div class="feature-icon">
                                                                <img src="<?php echo esc_url($url); ?>">
                                                            </div>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <div class="feature-icon">
                                                            <i class="twp-design-icon <?php echo esc_attr($params['intro_icon_' . $i]); ?>"></i>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="feature-details">
                                                        <h3 class="block-title">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <p>
                                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                                <?php
                                                                $excerpt = multipurpose_business_words_count(absint($params['excerpt_length']), get_the_content());
                                                                echo wp_kses_post($excerpt);
                                                                ?>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        $intro_page_ids = '';
                                        wp_reset_postdata();
                                    }
                                }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>

            <?php echo $args['after_widget'];
        }
    }
endif;


/*Multipurpose_Business_Testimonial widget*/
if (!class_exists('Multipurpose_Business_Testimonial')) :

    /**
     * Multipurpose Business Widget
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Testimonial extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_testimonial_widget',
                'description' => __('Displays page as testimonial form selected pages', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'default' => __('Testimonial', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'multipurpose-business'),
                    'description' => __('Number of words', 'multipurpose-business'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 30,
                    'min' => 0,
                    'max' => 200,
                ),
                'testimonial_page_1' => array(
                    'label' => __('Select Page 1:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'testimonial_page_2' => array(
                    'label' => __('Select Page 2:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
                'testimonial_page_3' => array(
                    'label' => __('Select Page 3:', 'multipurpose-business'),
                    'type' => 'dropdown-pages',
                    'class' => 'widefat',
                    'show_option_none' => __('&mdash; Select &mdash;', 'multipurpose-business'),
                ),
            );

            parent::__construct('multipurpose-business-testimonial-widget', __("MB :- Testimonial Widget", 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            ?>
            <div class="widget-block widget-testmonial">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-full">
                            <h2 class="entry-title widget-title widget-title-medium">
                                <?php echo esc_html($params['title']) ?>
                        </div>
                    </div>
                </div>


                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-full">
                            <div class="testmonial-slider">
                                <?php
                                // ID validation.
                                $testimonial_page_ids = '';
                                for ($i = 1; $i <= 3; $i++) {
                                    if (absint($params['testimonial_page_' . $i]) > 0) {
                                        $testimonial_page_ids = absint($params['testimonial_page_' . $i]);
                                    }
                                    if (absint($testimonial_page_ids) > 0) {
                                        $qargs = array(
                                            'p' => absint($testimonial_page_ids),
                                            'post_type' => 'any',
                                            'no_found_rows' => true,
                                        );

                                        $the_query = new WP_Query($qargs);
                                        if ($the_query->have_posts()) {
                                            while ($the_query->have_posts()) {
                                                $the_query->the_post(); ?>
                                                <div class="testmonial-item">
                                                    <div class="testimonial-block">
                                                        <div class="inner-box">
                                                            <div class="text">
                                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                                    <?php
                                                                    $excerpt = multipurpose_business_words_count(absint($params['excerpt_length']), get_the_content());
                                                                    echo wp_kses_post(wpautop($excerpt));
                                                                    ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="info">
                                                                <h4>
                                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                                </h4>
                                                                <?php if (has_post_thumbnail()) {
                                                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                                                    $url = $thumb['0']; ?>
                                                                    <div class="info-avatar">
                                                                        <img src="<?php echo esc_url($url); ?>">
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $testimonial_page_ids = '';
                                            wp_reset_postdata();
                                        }
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;


/*Multipurpose_Business_Call_To_Action_widget widget*/
if (!class_exists('Multipurpose_Business_Call_To_Action_widget')) :

    /**
     * Multipurpose Business Widget
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Call_To_Action_widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_call_to_action_widget',
                'description' => __('Displays call-to-action section on the basis of information listed here', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_urls' => array(
                    'label' => __('Background Image:', 'multipurpose-business'),
                    'type' => 'image',
                ),
                'button_text' => array(
                    'label' => __('Button Text:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'button_url' => array(
                    'label' => __('Button URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('multipurpose-business-call-to-action-widget', __('MB :- Call To Action Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            if (!empty($params['image_urls'])) {
                $image_url = esc_url($params['image_urls']);
            } else {
                $image_url = '';
            }
            ?>

            <div class="widget-block widget-cta widget-data-bg data-bg"
                 data-background="<?php echo esc_url($params['image_urls']) ?>" data-stellar-background-ratio="0.5">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-six">
                            <div class="cta-wrapper">
                                <?php if (!empty($params['title'])) { ?>
                                    <h2 class="widget-title widget-title-medium widget-title-2">
                                        <?php echo $params['title']; ?>
                                    </h2>
                                <?php } ?>
                            </div>
                            <div class="cta-wrapper">
                                <?php if ((!empty($params['button_url'])) || (!empty($params['button_text']))) { ?>
                                    <div class="cta-btns-group">
                                        <a href="<?php echo esc_url($params['button_url']); ?>"
                                           class="btn btn-secondary"><?php echo esc_html($params['button_text']); ?></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo $args['after_widget'];
        }
    }
endif;


/*Multipurpose_Business_Blog_Widget widget*/
if (!class_exists('Multipurpose_Business_Blog_Widget')) :

    /**
     * Multipurpose Business Widget
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Blog_Widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_blog_widgets',
                'description' => __('Displays post form selected category As Blog Post', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'short_description' => array(
                    'label' => __('Short Discription:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widget-content widefat'
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'multipurpose-business'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 12,
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'multipurpose-business'),
                    'description' => __('Number of words', 'multipurpose-business'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
            );

            parent::__construct('multipurpose-business-blog-layout', __('MB :- Blog Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            global $post;
            $all_posts = get_posts($qargs);
            ?>

            <?php if (!empty($all_posts)) : ?>
            <div class="widget-block widget-blog">

                    <div class="wrapper">
                        <div class="col-row">
                            <div class="col col-full">
                                <h2 class="entry-title widget-title">
                                    <?php echo esc_html($params['title']) ?>

                                </h2>
                                <?php if (!empty($params['short_description'])) { ?>
                                    <p class="entry-subtext">
                                        <?php echo esc_html($params['short_description']) ?>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                <div class="wrapper-fluid">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <div class="col col-quarter col-sm-full" data-mh="blog-post">
                            <div class="blog-wrapper">
                                <?php if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                                    $url = $thumb['0']; ?>
                                    <div class="blog-image-wrapper">
                                        <div class="blog-image bg-image">
                                            <img src="<?php echo esc_url($url); ?>">

                                        </div>
                                        <div class="entry-meta bg-overlay-meta">
                                           <span class="posted-on">
                                               <?php multipurpose_business_posted_date_only(); ?>
                                           </span>
                                            <span class="author">
                                            <?php multipurpose_business_posted_by(); ?>
                                           </span>
                                        </div><!-- .entry-meta -->
                                    </div>
                                <?php } ?>
                                <div class="blog-image-overlay"></div>
                                <div class="blog-details">
                                    <header class="article-header">
                                        <div class="entry-meta">
                                                <span class="post-category">
                                                    <?php multipurpose_business_entry_category(); ?>
                                                </span>
                                        </div>

                                        <h4 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a>
                                        </h4>


                                    </header>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;


/*Multipurpose_Business_Client_Widget widget*/
if (!class_exists('Multipurpose_Business_Client_Widget')) :

    /**
     * Multipurpose Business Widget
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Client_Widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_client_widgets',
                'description' => __('Displays post form selected category As Client Post', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category For Client:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'short_description' => array(
                    'label' => __('Short Discription:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widget-content widefat'
                ),
                'post_number' => array(
                    'label' => __('Number of Clients:', 'multipurpose-business'),
                    'type' => 'number',
                    'default' => 6,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 12,
                ),
            );

            parent::__construct('multipurpose-business-client-layout', __('MB :- Client Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            global $post;
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>

            <div class="widget-block widget-clients">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-full">
                            <h2 class="entry-title widget-title">
                                <?php echo esc_html($params['title']) ?>
                            </h2>
                            <?php if (!empty($params['short_description'])) { ?>
                                <p class="entry-subtext"><?php echo esc_html($params['short_description']) ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="wrapper">
                    <div class="col-row">
                        <?php foreach ($all_posts as $key => $post) : ?>
                            <?php setup_postdata($post); ?>
                            <div class="col col-6-6">
                                <div class="clients-logo">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                        $url = $thumb['0']; ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo esc_url($url); ?>">
                                        </a>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Panel widget*/
if (!class_exists('Multipurpose_Business_sidebar_widget')) :

    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_sidebar_widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_popular_post_widget',
                'description' => esc_html__('Displays post form selected category specific for popular post in sidebars.', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'multipurpose-business'),
                ),
                'post_number' => array(
                    'label' => esc_html__('Number of Posts:', 'multipurpose-business'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
            );

            parent::__construct('multipurpose-business-popular-sidebar-layout', esc_html__('MB :- Recent Post', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            }

            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php global $post;
            $count = 1;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget">
                <ul class="recent-widget-list">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <li>
                            <article class="article-list">
                                <div class="article-image">
                                    <?php if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'multipurpose-business-related-post');
                                        $url = $thumb['0']; ?>
                                        <a href="<?php the_permalink(); ?>" class="bg-image bg-image-1">
                                            <img src="<?php echo esc_url($url); ?>"
                                                 alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php } ?>
                                    <div class="trend-item">
                                        <span class="number"> <?php echo $count; ?></span>
                                    </div>
                                </div>
                                <div class="article-body">
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <?php echo esc_attr(get_post_time('j M Y')); ?>
                                        </span>
                                    </div>
                                    <h4 class="entry-title entry-title-small primary-font">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                </div>
                            </article>
                        </li>
                        <?php
                        $count++;
                    endforeach; ?>
                </ul>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*author widget*/
if (!class_exists('Multipurpose_Business_Author_Post_widget')) :

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Author_Post_widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_author_widget',
                'description' => esc_html__('Displays authors details in post.', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label' => esc_html__('Name:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => esc_html__('Discription:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widget-content widefat'
                ),
                'image_url' => array(
                    'label' => esc_html__('Author Image:', 'multipurpose-business'),
                    'type' => 'image',
                ),
                'url-fb' => array(
                    'label' => esc_html__('Facebook URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => esc_html__('Twitter URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gp' => array(
                    'label' => esc_html__('Googleplus URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-ins' => array(
                    'label' => esc_html__('Instagram URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-pin' => array(
                    'label' => esc_html__('Pinterest URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('multipurpose-business-author-layout', esc_html__('MB :- Author Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            } ?>

            <!--cut from here-->
            <div class="author-info">
                <div class="author-image">
                    <?php if (!empty($params['image_url'])) { ?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url($params['image_url']); ?>">
                        </div>
                    <?php } ?>
                </div> <!-- /#author-image -->
                <div class="author-social">
                    <?php if (!empty($params['url-fb'])) { ?>
                        <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                            <i class="social-icon ion-social-facebook"></i>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                            <i class="social-icon ion-social-twitter"></i>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-gp'])) { ?>
                        <a href="<?php echo esc_url($params['url-gp']); ?>" target="_blank">
                            <i class="social-icon ion-social-googleplus"></i>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-ins'])) { ?>
                        <a href="<?php echo esc_url($params['url-ins']); ?>" target="_blank">
                            <i class="social-icon ion-social-instagram"></i>
                        </a>
                    <?php } ?>
                    <?php if (!empty($params['url-pin'])) { ?>
                        <a href="<?php echo esc_url($params['url-pin']); ?>" target="_blank">
                            <i class="social-icon ion-social-pinterest"></i>
                        </a>
                    <?php } ?>
                </div><!-- /#author-social -->
                <div class="author-details">
                    <?php if (!empty($params['author-name'])) { ?>
                        <h3 class="author-name primary-font"><?php echo esc_html($params['author-name']); ?></h3>
                    <?php } ?>
                    <?php if (!empty($params['description'])) { ?>
                        <p><?php echo wp_kses_post($params['description']); ?></p>
                    <?php } ?>
                </div> <!-- /#author-details -->
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Social widget*/
if (!class_exists('Multipurpose_Business_Social_widget')) :

    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Multipurpose_Business_Social_widget extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_social_widget',
                'description' => esc_html__('Displays Social share.', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                    'label' => esc_html__('Facebook URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => esc_html__('Twitter URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gp' => array(
                    'label' => esc_html__('Googleplus URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-lt' => array(
                    'label' => esc_html__('Linkedin URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-ig' => array(
                    'label' => esc_html__('Instagram URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-pt' => array(
                    'label' => esc_html__('Pinterest URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-rt' => array(
                    'label' => esc_html__('Reddit URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sk' => array(
                    'label' => esc_html__('Skype URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sc' => array(
                    'label' => esc_html__('Snapchat URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-tr' => array(
                    'label' => esc_html__('Tumblr URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-th' => array(
                    'label' => esc_html__('Twitch URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-yt' => array(
                    'label' => esc_html__('Youtube URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-vo' => array(
                    'label' => esc_html__('Vimeo URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wa' => array(
                    'label' => esc_html__('Whatsapp URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-wp' => array(
                    'label' => esc_html__('WordPress URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-gh' => array(
                    'label' => esc_html__('Github URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-fs' => array(
                    'label' => esc_html__('FourSquare URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-db' => array(
                    'label' => esc_html__('Dribbble URL:', 'multipurpose-business'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('multipurpose-business-social-layout', esc_html__('MB :- Social Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            } ?>

            <div class="twp-social-widget">
                <ul class="social-widget-wrapper">
                    <?php if (!empty($params['url-fb'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                                <i class="social-icon ion-social-facebook"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tw'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                                <i class="social-icon ion-social-twitter"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-gp'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-gp']); ?>" target="_blank">
                                <i class="social-icon ion-social-googleplus"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-lt'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank">
                                <i class="social-icon ion-social-linkedin"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-ig'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank">
                                <i class="social-icon ion-social-instagram"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-pt'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank">
                                <i class="social-icon ion-social-pinterest"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-rt'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank">
                                <i class="social-icon ion-social-reddit"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sk'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank">
                                <i class="social-icon ion-social-skype"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-sc'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank">
                                <i class="social-icon ion-social-snapchat"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-tr'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank">
                                <i class="social-icon ion-social-tumblr"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-th'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank">
                                <i class="social-icon ion-social-twitch"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-yt'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank">
                                <i class="social-icon ion-social-youtube"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-vo'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank">
                                <i class="social-icon ion-social-vimeo"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wa'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank">
                                <i class="social-icon ion-social-whatsapp"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-wp'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank">
                                <i class="social-icon ion-social-wordpress"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-gh'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank">
                                <i class="social-icon ion-social-github"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-fs'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank">
                                <i class="social-icon ion-social-foursquare"></i>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-db'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank">
                                <i class="social-icon ion-social-dribbble"></i>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*Business_startup_Portfolio widget*/
if (!class_exists('Business_startup_Portfolio')) :

    /**
     * Multipurpose_Business Widget
     *
     * @since 1.0.0
     */
    class Business_startup_Portfolio extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_portfolio_widgets',
                'description' => __('Displays post form selected category As Project', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => esc_html__('Discription:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widget-content widefat'
                ),
                'post_category_1' => array(
                    'label' => __('Select Category 1:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_category_2' => array(
                    'label' => __('Select Category 2:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_category_3' => array(
                    'label' => __('Select Category 3:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_category_4' => array(
                    'label' => __('Select Category 4:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_category_5' => array(
                    'label' => __('Select Category 5:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_category_6' => array(
                    'label' => __('Select Category 6:', 'multipurpose-business'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'multipurpose-business'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts from each:', 'multipurpose-business'),
                    'type' => 'number',
                    'default' => 9,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 12,
                ),
            );

            parent::__construct('multipurpose-business-portfolio-layout', __('MB :- Portfolio Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {

            $params = $this->get_params($instance);

            echo $args['before_widget'];

            global $post;
            ?>

            <div class="widget-block widget-portfolio">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-full">
                            <h2 class="entry-title widget-title">
                                <?php if (!empty($params['title'])) {
                                    echo esc_html($params['title']);
                                } ?>
                            </h2>

                            <?php if (!empty($params['description'])) { ?>
                                <p class="entry-subtext"><?php echo wp_kses_post($params['description']); ?></p>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <?php $multipurpose_business_portfolio_category_list_array = array();
                for ($i = 1; $i <= 6; $i++) {
                    $multipurpose_business_portfolio_category_list = $params['post_category_' . $i];
                    if (!empty($multipurpose_business_portfolio_category_list)) {
                        $multipurpose_business_portfolio_category_list_array[] = absint($multipurpose_business_portfolio_category_list);
                    }
                }
                $multipurpose_business_portfolio_args = array();
                $multipurpose_business_portfolio_no = $params['post_number'];
                if (!empty($multipurpose_business_portfolio_category_list_array)) {
                    $multipurpose_business_portfolio_args = array(
                        'post_type' => 'post',
                        'cat' => $multipurpose_business_portfolio_category_list_array,
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => $multipurpose_business_portfolio_no,
                    );
                } ?>
                <div class="twp-portfolio portfolio-masonry">
                    <div class="wrapper">
                        <div class="col-row">
                            <div class="col col-full">
                                <ul class="filter-group">
                                    <li><span class="filter"
                                              data-filter="*"> <?php esc_html_e('show all', 'multipurpose-business') ?></span>
                                    </li>
                                    <?php for ($j = 0; $j < count($multipurpose_business_portfolio_category_list_array); $j++) {
                                        $multipurpose_business_category = get_cat_name($multipurpose_business_portfolio_category_list_array[$j]);
                                        $multipurpose_business_category_id = get_cat_id($multipurpose_business_category);
                                        if (!empty($multipurpose_business_category)) { ?>
                                            <li><span class="filter"
                                                      data-filter=".<?php echo esc_attr('cat-' . $multipurpose_business_category_id) ?>"><?php echo esc_html($multipurpose_business_category, 'multipurpose-business') ?></span>
                                            </li>
                                        <?php }
                                    } ?>
                                </ul>
                            </div>

                            <div class="col col-full">
                                <div id="portfolio-grid" class="masonry">
                                    <?php
                                    $multipurpose_business_portfolio_post_query = new WP_Query($multipurpose_business_portfolio_args);
                                    if ($multipurpose_business_portfolio_post_query->have_posts()) :
                                        while ($multipurpose_business_portfolio_post_query->have_posts()) : $multipurpose_business_portfolio_post_query->the_post();
                                            $multipurpose_business_cat_id = array();
                                            if (has_post_thumbnail()) {
                                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                                $url = $thumb['0'];
                                            } else {
                                                $url = '';
                                            }
                                            $multipurpose_business_categories = get_the_category();
                                            foreach ($multipurpose_business_categories as $multipurpose_business_cat) {
                                                $multipurpose_business_cat_id[] = $multipurpose_business_cat->term_id;
                                            }
                                            $cat_ids = implode(' cat-', $multipurpose_business_cat_id);
                                            $multipurpose_business_single_cat_name = get_cat_name($cat_ids);
                                            ?>
                                            <div class="portfolio-masonry-entry masonry-item cat-<?php echo esc_html($cat_ids); ?>">
                                                <div class="portfolio-wrapper">
                                                    <a href="<?php the_permalink(); ?>" class="img-hover">
                                                        <img src="<?php echo esc_url($url); ?>" alt="">
                                                        <div class="hover-caption">
                                                            <header class="article-header">
                                                                <div class="entry-meta">
                                                                        <span class="post-category">
                                                                            <?php echo esc_html($multipurpose_business_single_cat_name); ?>
                                                                        </span>
                                                                </div>
                                                                <h2 class="entry-title entry-title-small"><?php the_title(); ?></h2>
                                                            </header>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div> <!-- END #portfolio-grid -->
                        </div><!-- END .portfolio-masonry -->
                    </div>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;


/*Business_startup_Contact widget*/
if (!class_exists('Business_startup_Contact')) :

    /**
     * TMultipurpose_Business Widget
     *
     * @since 1.0.0
     */
    class Business_startup_Contact extends Multipurpose_Business_Widget_Base
    {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'multipurpose_business_Contact_widgets',
                'description' => __('Displays post form selected category As Project', 'multipurpose-business'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'multipurpose-business'),
                    'type' => 'textarea',
                    'class' => 'widefat',
                ),

                'contact_form_shortcode' => array(
                    'label' => __('Contact Form Shortcodes:', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'google_map_shortcode' => array(
                    'label' => __('Google Map Shortcodes:', 'multipurpose-business'),
                    'description' => __('Leave this field empty if you do not want to use mag feature', 'multipurpose-business'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );

            parent::__construct('multipurpose_business-contact-layout', __('MB :- Contact Widget', 'multipurpose-business'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);

            echo $args['before_widget']; ?>
            <div class="widget-block widget-contact widget-bg-3">
                <div class="wrapper">
                <div class="col-row">
                    <div class="col col-full">
                        <h2 class="entry-title widget-title">
                            <?php if (!empty($params['title'])) {
                                echo esc_html($params['title']);
                            } ?>
                        </h2>

                        <?php if (!empty($params['description'])) { ?>
                            <p class="entry-subtext">
                                <?php echo wp_kses_post($params['description']); ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
                <?php if (!empty($params['contact_form_shortcode'])) { ?>
                    <div class="wrapper-fluid">
                        <div class="col-row">
                            <div class="col col-full">
                                <div class="contact-form-wrapper">
                                    <?php echo do_shortcode(wp_kses_post($params['contact_form_shortcode'])); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- Google Map -->
                <?php if (!empty($params['google_map_shortcode'])) { ?>
                <div class="widget-block map-widget">
                    <div class="google-map">
                        <div id="map" class="map">
                            <?php echo do_shortcode(wp_kses_post($params['google_map_shortcode'])); ?>
                        </div>
                        <div class="map-container">
                            <div class="map-toggle">
                                <div class="map-toggle-icon">
                                    <i class="icon ion-ios-location"></i>
                                </div>
                                <div class="map-toggle-info font-alt">
                                    <div class="map-toggle-open">
                                        <?php _e('Open the map', 'multipurpose-business'); ?> <i class="icon twp-icon ion-ios-arrow-down"></i>
                                    </div>
                                    <div class="map-toggle-close">
                                        <?php _e('Close the map', 'multipurpose-business'); ?> <i class="icon twp-icon ion-ios-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
            <!-- End Google Map -->
            <?php echo $args['after_widget'];
        }
    }
endif;
