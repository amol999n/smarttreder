<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Multipurpose Business
 */

if (!function_exists('multipurpose_business_posted_details')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function multipurpose_business_posted_details()
    {
        global $post;
        $author_id = $post->post_author;
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html__( 'Posted On %s', 'multipurpose-business' ),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html__( 'By %s', 'multipurpose-business' ),
            '<a class="url" href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html(get_the_author_meta('display_name', $author_id)) . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span><span class="author"> ' . $byline . '</span>'; // WPCS: XSS OK.

        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;


if (!function_exists('multipurpose_business_posted_comment')) :
    function multipurpose_business_posted_comment()
    {
        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(esc_html__('comment', 'multipurpose-business'), esc_html__('1 Comment', 'multipurpose-business'), esc_html__('% Comments', 'multipurpose-business'));
            echo '</span>';
        } 
    }
endif;

if (!function_exists('multipurpose_business_posted_by')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function multipurpose_business_posted_by()
    {
        global $post;
        $author_id = $post->post_author;
        $byline = sprintf(
            esc_html__( 'By %s', 'multipurpose-business' ),
            '<a class="url" href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html(get_the_author_meta('display_name', $author_id)) . '</a>'
        );

        echo '<span class="author"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }
endif;
if (!function_exists('multipurpose_business_posted_date_only')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function multipurpose_business_posted_date_only()
    {
        global $post;
        $author_id = $post->post_author;
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html__( ' %s', 'multipurpose-business' ),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    }
endif;


if (!function_exists('multipurpose_business_entry_category')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function multipurpose_business_entry_category()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(' #', 'multipurpose-business'));
            if ($categories_list && multipurpose_business_categorized_blog()) {
                printf(esc_html__('#%1$s', 'multipurpose-business'), $categories_list);
            }
        }
    }
endif;

if (!function_exists('multipurpose_business_entry_tags')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function multipurpose_business_entry_tags()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(' ', 'multipurpose-business'));
            if ($tags_list) {
                printf('<span class="tags-links"> ' . esc_html__('Tagged: %1$s', 'multipurpose-business') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function multipurpose_business_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('multipurpose_business_categories'))) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('multipurpose_business_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so multipurpose_business_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so multipurpose_business_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in multipurpose_business_categorized_blog.
 */
function multipurpose_business_category_transient_flusher()
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('multipurpose_business_categories');
}

add_action('edit_category', 'multipurpose_business_category_transient_flusher');
add_action('save_post', 'multipurpose_business_category_transient_flusher');
