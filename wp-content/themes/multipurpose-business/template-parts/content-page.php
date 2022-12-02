<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Multipurpose Business
 */

?>
<header class="entry-header">
    <div class="wrapper">
        <div class="col-row">
            <div class="col col-full">
                    <h1 class="entry-title entry-title-big">
                        <?php the_title(); ?>
                    </h1>
                <?php
                /**
                 * Hook - multipurpose_business_add_breadcrumb.
                 */
                do_action('multipurpose_business_action_breadcrumb');
                ?>
            </div>
        </div>
    </div>
</header><!-- .entry-header -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <div class="twp-article-wrapper clearfix">
            <?php
            $image_values = get_post_meta($post->ID, 'multipurpose-business-meta-image-layout', true);
            if (empty($image_values)) {
                $values = esc_attr(multipurpose_business_get_option('single_post_image_layout'));
            } else {
                $values = esc_attr($image_values);
            }
            if ('no-image' != $values) {
                if ('left' == $values) {
                    echo "<div class='image-left'>";
                    the_post_thumbnail('medium');
                } elseif ('right' == $values) {
                    echo "<div class='image-right'>";
                    the_post_thumbnail('medium');
                } else {
                    echo "<div class='image-full'>";
                    the_post_thumbnail('full');
                }
                echo "</div>";/*div end */
            }
            the_content();
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'multipurpose-business'),
                'after' => '</div>',
            ));
            ?>
        </div>
    </div><!-- .entry-content -->
    <?php if (current_user_can('edit_theme_options')) { ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                /* translators: %s: Name of current post */
                    esc_html__('Edit %s', 'multipurpose-business'),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ),
                '<span class="edit-link">',
                '</span>'
            );

            ?>
        </footer><!-- .entry-footer -->
    <?php } ?>
</article><!-- #post-## -->
