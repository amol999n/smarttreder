<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Multipurpose Business
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="twp-article-wrapper">
        <header class="article-header">
                <?php the_title( sprintf( '<h2 class="entry-title entry-title-medium"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <div class="entry-meta">
                    <?php multipurpose_business_posted_details(); ?>
                </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
        <div class="twp-content-details">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
    </div>

</article><!-- #post-## -->
