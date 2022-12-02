<?php
/**
 * Template part for displaying single posts.
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
                    <div class="inner-meta-info">
                        <?php multipurpose_business_posted_details(); ?>
                    </div>
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
<div class="entry-content">
    <div class="twp-article-wrapper clearfix">
        <?php if (!is_single()) { ?>
            <header class="entry-header">
                <div class="entry-meta entry-inner">
                    <?php multipurpose_business_posted_details(); ?>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->
        <?php } ?>
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

        if( !class_exists( 'Booster_Extension_Class' ) ){

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'multipurpose-business' ),
                'after'  => '</div>',
            ) );

        }
        ?>
    </div>
</div><!-- .entry-content -->
<?php if (is_single()) { ?>
    <div class="single-meta">
        <?php if (has_category('', $post->ID)) { ?>
            <footer class="entry-footer">
                <?php multipurpose_business_entry_category(); ?>
            </footer><!-- .entry-footer -->
        <?php } ?>
        <?php if (has_tag()) { ?>
            <div class="post-tags">
                <?php multipurpose_business_entry_tags(); ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
</article><!-- #post-## -->
<?php 
if (1 == multipurpose_business_get_option('enable_author_info_in_single')) {

    $user_display_name = get_the_author_meta( 'display_name' );
    $user_user_description = get_the_author_meta( 'user_description' );
    $user_email = get_the_author_meta( 'user_email' ); ?>
    <div class="author-description">
        <div class="author-description-wrapper clear">
            <div class="author-avatar">
                <img src="<?php echo get_avatar_url($user_email,  'size = 200'); ?>">
            </div>
            <div class="author-details">
                
                <div class="author-info author-name-title">
                    <?php echo esc_html($user_display_name); ?>
                </div>
                <div class="author-info author-email">
                    <?php echo esc_attr($user_email); ?>
                </div>
                <div class="author-info author-description-content">
                    <?php echo esc_html($user_user_description); ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php
if (1 == multipurpose_business_get_option('enable_related_post_in_single')) {
    /**
     * Hook multipurpose_business_related_posts
     *
     * @hooked multipurpose_business_get_related_posts
     */
    do_action('multipurpose_business_related_posts');
}