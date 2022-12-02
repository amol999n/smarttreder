<?php
/**
 * Theme Options Panel.
 *
 * @package Multipurpose Business
 */

$default = multipurpose_business_get_default_theme_options();

$wp_customize->add_panel('theme_option_panel',
	array(
		'title'      => esc_html__('Theme Options', 'multipurpose-business'),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);
$wp_customize->add_section('side_panel_section_settings',
	array(
		'title'      => esc_html__('Header Section Settings', 'multipurpose-business'),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('enable_contact_on_side_panel',
	array(
		'default'           => $default['enable_contact_on_side_panel'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_contact_on_side_panel',
	array(
		'label'    => esc_html__('Enable Contact on Header', 'multipurpose-business'),
		'section'  => 'side_panel_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

$wp_customize->add_setting( 'select_contact_page',
	array(
		'default'           => $default['select_contact_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_dropdown_pages',
	)
);
$wp_customize->add_control( 'select_contact_page',
	array(
		'label'    => esc_html__( 'Select Contact Page', 'multipurpose-business' ),
		'section'  => 'side_panel_section_settings',
		'type'     => 'dropdown-pages',
		'priority' => 150,
        'active_callback' 	=> 'multipurpose_business_enable_contact',

	)
);

$wp_customize->add_setting('excerpt_length_contact',
	array(
		'default'           => $default['excerpt_length_contact'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_positive_integer',
	)
);
$wp_customize->add_control('excerpt_length_contact',
	array(
		'label'       => esc_html__('Conatct Page Excerpt Length', 'multipurpose-business'),
		'section'     => 'side_panel_section_settings',
		'type'        => 'number',
		'priority'    => 150,
		'input_attrs' => array('min' => 1, 'max' => 200, 'style' => 'width: 150px;'),
        'active_callback' 	=> 'multipurpose_business_enable_contact',

	)
);

$wp_customize->add_setting('enable_social_menu_on_contact',
	array(
		'default'           => $default['enable_social_menu_on_contact'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_social_menu_on_contact',
	array(
		'label'    => esc_html__('Enable Social Menu on Contact section', 'multipurpose-business'),
		'section'  => 'side_panel_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
        'active_callback' 	=> 'multipurpose_business_enable_contact',

	)
);

$wp_customize->add_setting( 'contact_form_shortcode',
	array(
		'default'           => $default['contact_form_shortcode'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'contact_form_shortcode',
	array(
		'label'    => esc_html__( 'Contact Form Shortcode', 'multipurpose-business' ),
		'description'     => esc_html__( 'We Recomend you to use Contact Form by WPForms', 'multipurpose-business'),
		'section'  => 'side_panel_section_settings',
		'type'     => 'textarea',
		'priority' => 150,
        'active_callback' 	=> 'multipurpose_business_enable_contact',

	)
);


$wp_customize->add_setting('enable_search_on_header',
	array(
		'default'           => $default['enable_search_on_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_search_on_header',
	array(
		'label'    => esc_html__('Enable Search on Header', 'multipurpose-business'),
		'section'  => 'side_panel_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);

/*layout management section start */
$wp_customize->add_section('theme_option_section_settings',
	array(
		'title'      => esc_html__('Layout Management', 'multipurpose-business'),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);


/*Global Layout*/
$wp_customize->add_setting('global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control('global_layout',
	array(
		'label'          => esc_html__('Global Layout', 'multipurpose-business'),
		'section'        => 'theme_option_section_settings',
		'choices'        => array(
			'left-sidebar'  => esc_html__('Primary Sidebar - Content', 'multipurpose-business'),
			'right-sidebar' => esc_html__('Content - Primary Sidebar', 'multipurpose-business'),
			'no-sidebar'    => esc_html__('No Sidebar', 'multipurpose-business'),
		),
		'type'     => 'select',
		'priority' => 170,
	)
);

// Setting - read_more_button_text.
$wp_customize->add_setting('read_more_button_text',
	array(
		'default'           => $default['read_more_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('read_more_button_text',
	array(
		'label'    => esc_html__('Read More Button Text', 'multipurpose-business'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'text',
		'priority' => 170,
	)
);

/*content excerpt in global*/
$wp_customize->add_setting('excerpt_length_global',
	array(
		'default'           => $default['excerpt_length_global'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_positive_integer',
	)
);
$wp_customize->add_control('excerpt_length_global',
	array(
		'label'       => esc_html__('Set Global Archive Length', 'multipurpose-business'),
		'section'     => 'theme_option_section_settings',
		'type'        => 'number',
		'priority'    => 175,
		'input_attrs' => array('min' => 1, 'max' => 200, 'style' => 'width: 150px;'),

	)
);

$wp_customize->add_setting('enable_archive_category',
	array(
		'default'           => $default['enable_archive_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_archive_category',
	array(
		'label'    => esc_html__('Enable category Meta on Archive', 'multipurpose-business'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 175,
	)
);

$wp_customize->add_setting('enable_archive_post_date',
	array(
		'default'           => $default['enable_archive_post_date'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_archive_post_date',
	array(
		'label'    => esc_html__('Enable Post Date on Archive', 'multipurpose-business'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 175,
	)
);

$wp_customize->add_setting('enable_archive_post_by',
	array(
		'default'           => $default['enable_archive_post_by'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_archive_post_by',
	array(
		'label'    => esc_html__('Enable Post Author on Archive', 'multipurpose-business'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 175,
	)
);


/*single post Layout image*/
$wp_customize->add_setting('single_post_image_layout',
	array(
		'default'           => $default['single_post_image_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control('single_post_image_layout',
	array(
		'label'     => esc_html__('Single Post/Page Image Allocation', 'multipurpose-business'),
		'section'   => 'theme_option_section_settings',
		'choices'   => array(
			'full'     => esc_html__('Full', 'multipurpose-business'),
			'right'    => esc_html__('Right', 'multipurpose-business'),
			'left'     => esc_html__('Left', 'multipurpose-business'),
			'no-image' => esc_html__('No image', 'multipurpose-business')
		),
		'type'     => 'select',
		'priority' => 190,
	)
);


$wp_customize->add_setting('enable_author_info_in_single',
	array(
		'default'           => $default['enable_author_info_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_author_info_in_single',
	array(
		'label'    => esc_html__('Enable Post Author Info in Single Post', 'multipurpose-business'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 195,
	)
);


$wp_customize->add_setting('enable_related_post_in_single',
	array(
		'default'           => $default['enable_related_post_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_related_post_in_single',
	array(
		'label'    => esc_html__('Enable Related Post in Single Post', 'multipurpose-business'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 195,
	)
);

// Pagination Section.
$wp_customize->add_section('pagination_section',
	array(
		'title'      => esc_html__('Pagination Options', 'multipurpose-business'),
		'priority'   => 110,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting('pagination_type',
	array(
		'default'           => $default['pagination_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control('pagination_type',
	array(
		'label'    => esc_html__('Pagination Type', 'multipurpose-business'),
		'section'  => 'pagination_section',
		'type'     => 'select',
		'choices'  => array(
			'default' => esc_html__('Default (Older / Newer Post)', 'multipurpose-business'),
			'numeric' => esc_html__('Numeric', 'multipurpose-business'),
            'infinite_scroll_load' => esc_html__( 'Infinite Scroll Ajax Load', 'multipurpose-business' ),
		),
		'priority' => 100,
	)
);

// Footer Section.
$wp_customize->add_section('footer_section',
	array(
		'title'      => esc_html__('Footer Options', 'multipurpose-business'),
		'priority'   => 130,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting social_content_heading.
$wp_customize->add_setting('number_of_footer_widget',
	array(
		'default'           => $default['number_of_footer_widget'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control('number_of_footer_widget',
	array(
		'label'    => esc_html__('Number Of Footer Widget', 'multipurpose-business'),
		'section'  => 'footer_section',
		'type'     => 'select',
		'priority' => 100,
		'choices'  => array(
			0         => esc_html__('Disable footer sidebar area', 'multipurpose-business'),
			1         => esc_html__('1', 'multipurpose-business'),
			2         => esc_html__('2', 'multipurpose-business'),
			3         => esc_html__('3', 'multipurpose-business'),
		),
	)
);

// Setting copyright_text.
$wp_customize->add_setting('copyright_text',
	array(
		'default'           => $default['copyright_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('copyright_text',
	array(
		'label'    => esc_html__('Footer Copyright Text', 'multipurpose-business'),
		'section'  => 'footer_section',
		'type'     => 'text',
		'priority' => 120,
	)
);

// Breadcrumb Section.
$wp_customize->add_section('breadcrumb_section',
	array(
		'title'      => esc_html__('Breadcrumb Options', 'multipurpose-business'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting('breadcrumb_type',
	array(
		'default'           => $default['breadcrumb_type'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control('breadcrumb_type',
	array(
		'label'       => esc_html__('Breadcrumb Type', 'multipurpose-business'),
		'description' => sprintf(esc_html__('Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'multipurpose-business'), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">', '</a>'),
		'section'     => 'breadcrumb_section',
		'type'        => 'select',
		'choices'     => array(
			'disabled'   => esc_html__('Disabled', 'multipurpose-business'),
			'simple'     => esc_html__('Simple', 'multipurpose-business'),
			'advanced'   => esc_html__('Advanced', 'multipurpose-business'),
		),
		'priority' => 100,
	)
);

// Preloader Section.
$wp_customize->add_section('enable_preloader_option',
	array(
		'title'      => esc_html__('Preloader Options', 'multipurpose-business'),
		'priority'   => 120,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

// Setting enable_preloader.
$wp_customize->add_setting('enable_preloader',
	array(
		'default'           => $default['enable_preloader'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_preloader',
	array(
		'label'    => esc_html__('Enable Preloader', 'multipurpose-business'),
		'section'  => 'enable_preloader_option',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);
