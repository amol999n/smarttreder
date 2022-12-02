<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Multipurpose Business
 */

get_header(); ?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <header class="entry-header">
                <div class="wrapper">
                    <div class="col-row">
                        <div class="col col-full">
                            <h1 class="entry-title entry-title-big">
                                <?php printf(esc_html__('Search Results for: %s', 'multipurpose-business'), '<span>' . get_search_query() . '</span>'); ?>
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
            <?php
            if (have_posts()) : ?>

                <?php
                /* Start the Loop */
                while (have_posts()) : the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'search');

                endwhile;

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
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
