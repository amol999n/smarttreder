<?php

if (!function_exists('multipurpose_business_add_breadcrumb')) :

    /**
     * Add breadcrumb.
     *
     * @since 1.0.0
     */
    function multipurpose_business_add_breadcrumb()
    {

        // Bail if Breadcrumb disabled.
        $breadcrumb_type = multipurpose_business_get_option('breadcrumb_type');
        if ('disabled' === $breadcrumb_type) {
            return;
        }
        // Bail if Home Page.
        if (is_front_page() || is_home()) {
            return;
        }
        // Render breadcrumb.
        switch ($breadcrumb_type) {
            case 'simple':
                echo "<div class='breadcrumb-bgcolor'>";
                multipurpose_business_simple_breadcrumb();
                echo "</div>";
                break;

            case 'advanced':
                if (function_exists('bcn_display')) {
                    bcn_display();
                }
                break;

            default:
                break;
        }
        return;

    }

endif;

add_action('multipurpose_business_action_breadcrumb', 'multipurpose_business_add_breadcrumb', 10);
