<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Multipurpose Business
 */

get_header(); ?>

    <div class="wrapper">
        <div class="col-row">
            <div class="col col-full">
                <header class="entry-header">
                        <h1 class="entry-title entry-title-large"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'multipurpose-business'); ?></h1>
                        <?php
                        /**
                         * Hook - multipurpose_business_add_breadcrumb.
                         */
                        do_action('multipurpose_business_action_breadcrumb');
                        ?>
                </header>
            </div>
            <div id="main" class="col col-full" role="main">
                <section class="error-404 not-found">
                    <div class="page-content">
                        <h2>
                            <?php esc_html_e('404 page not found', 'multipurpose-business'); ?></h2>
                        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try going back to Homepage or a search?', 'multipurpose-business'); ?></p>

                        <?php get_search_form(); ?>

                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </div><!-- #main -->
        </div>
    </div><!-- #primary -->

<?php
get_footer();
