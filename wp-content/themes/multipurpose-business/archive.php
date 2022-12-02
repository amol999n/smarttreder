<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Multipurpose Business
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <header class="entry-header">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-full">
                            <?php the_archive_title('<h1 class="entry-title entry-title-large">', '</h1>'); ?>
                            <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
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
            <?php
            if (have_posts()) : ?>

                <?php
                /* Start the Loop */
                echo "<div class='multipurpose-business-posts-lists'>";
                
                while (have_posts()) : the_post(); ?>
                    <?php 
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', get_post_format());

                endwhile;
                echo "</div>";

                /**
                 * Hook - multipurpose_business_action_posts_navigation.
                 *
                 * @hooked: multipurpose_business_custom_posts_navigation - 10
                 */
                do_action('multipurpose_business_action_posts_navigation');

            else :

                get_template_part('template-parts/content', 'none');

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
