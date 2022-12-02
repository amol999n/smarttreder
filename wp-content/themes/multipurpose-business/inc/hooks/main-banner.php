<?php
if (!function_exists('multipurpose_business_banner_section')) :
    /**
     * Tab callback Details
     *
     * @since multipurpose_business 1.0.0
     *
     */
    function multipurpose_business_banner_section()
    {
        $multipurpose_business_banner_button_enable = multipurpose_business_get_option('show_page_link_button');
        $multipurpose_business_banner_button_text = multipurpose_business_get_option('banner_additional_button_text');
        $multipurpose_business_banner_button_url = multipurpose_business_get_option('additional_button_link');
        $multipurpose_business_banner_excerpt_number = absint(multipurpose_business_get_option('number_of_banner_content'));
        $multipurpose_business_banner_page = array();
        $multipurpose_business_banner_page[] = esc_attr(multipurpose_business_get_option('select_banner_page')); ?>

        <?php if (!empty($multipurpose_business_banner_page)) {
            $multipurpose_business_banner_page_args = array(
                'post_type' => 'page',
                'post__in' => $multipurpose_business_banner_page,
                'orderby' => 'post__in'
            );
        }
        if (!empty($multipurpose_business_banner_page_args)) {
            $multipurpose_business_banner_page_query = new WP_Query($multipurpose_business_banner_page_args);
            while ($multipurpose_business_banner_page_query->have_posts()): $multipurpose_business_banner_page_query->the_post();
                if (has_excerpt()) {
                    $multipurpose_business_banner_main_content = get_the_excerpt();
                } else {
                    $multipurpose_business_banner_main_content = multipurpose_business_words_count($multipurpose_business_banner_excerpt_number , get_the_content());
                }
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = $thumb['0'];
                ?>
                <div class="custom-header">
                    <?php if ( multipurpose_business_get_option('show_page_featured_image') == 1) { ?>
                        <div class="custom-header-media">
                            <img src="<?php echo esc_url($url); ?>">
                        </div>
                    <?php } else { ?>
                        <div class="custom-header-media">
                            <?php the_custom_header_markup(); ?>
                        </div>
                    <?php } ?>
                    <div class="custom-header-content">
                        <div class="custom-header-details">
                            <div class="wrapper">
                                <div class="col-row">
                                    <div class="col col-full">
                                        <h2 class="entry-title entry-title-large">
                                            <?php the_title(); ?>
                                        </h2>
                                        <div class="custom-header-excerpt hidden-mobile">
                                            <?php echo esc_html($multipurpose_business_banner_main_content); ?>
                                        </div>
                                        <div class="cta-btns-group">
                                            <?php if (!empty($multipurpose_business_banner_button_text)) { ?>
                                                <a href="<?php echo esc_url($multipurpose_business_banner_button_url ); ?>" class="btn btn-secondary"><?php echo esc_html($multipurpose_business_banner_button_text); ?></a>
                                            <?php } ?>
                                            <?php if ($multipurpose_business_banner_button_enable == 1) { ?>
                                                <a href="<?php the_permalink();?>" class="btn btn-secondary"><?php _e( 'View More', 'multipurpose-business' ); ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile;
            wp_reset_postdata();
        } ?>
        <?php
    }
endif;
add_action('multipurpose_business_action_banner_section', 'multipurpose_business_banner_section', 10);