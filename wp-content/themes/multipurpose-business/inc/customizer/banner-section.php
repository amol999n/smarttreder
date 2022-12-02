<?php
	/**
	 * Banner Options Panel.
	 *
	 * @package Multipurpose Business
	 */

	$default = multipurpose_business_get_default_theme_options();
	//front page options
	$wp_customize->add_panel('banner_section_settings_pannel',
		array(
			'title'      => esc_html__('Main Banner Section Settings', 'multipurpose-business'),
			'priority'   => 190,
			'capability' => 'edit_theme_options',
		)
	);

	// Slider Main Section.
	$wp_customize->add_section('header_image',
		array(
			'title'      => esc_html__('Main Banner Background', 'multipurpose-business'),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'banner_section_settings_pannel',
		)
	);

	// Slider Main Section.
	$wp_customize->add_section('header_content',
		array(
			'title'      => esc_html__('Main Banner Content', 'multipurpose-business'),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'banner_section_settings_pannel',
		)
	);

	// Setting - banner conent -section.
	$wp_customize->add_setting( 'select_banner_page',
		array(
			'default'           => $default['select_banner_page'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'multipurpose_business_sanitize_dropdown_pages',
		)
	);
	$wp_customize->add_control( 'select_banner_page',
		array(
			'label'    => esc_html__( 'Select Main Banner Page', 'multipurpose-business' ),
			'section'  => 'header_content',
			'type'     => 'dropdown-pages',
			'priority' => 10,
		)
	);

	// Setting .
	$wp_customize->add_setting( 'show_page_featured_image',
		array(
			'default'           => $default['show_page_featured_image'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'show_page_featured_image',
		array(
			'label'    => esc_html__( 'Enable Featured Image as Background Image', 'multipurpose-business' ),
			'description'	=> __( 'Enabling this will dissable your Main Banner Background i.e your video or choosen header image.', 'multipurpose-business' ),
			'section'  => 'header_content',
			'type'     => 'checkbox',
			'priority' => 120,
		)
	);


	/*content excerpt in banner section*/
	$wp_customize->add_setting( 'number_of_banner_content',
		array(
			'default'           => $default['number_of_banner_content'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'multipurpose_business_sanitize_positive_integer',
		)
	);
	$wp_customize->add_control( 'number_of_banner_content',
		array(
			'label'    => __( 'Select no of words to Display', 'multipurpose-business' ),
			'section'  => 'header_content',
			'type'     => 'number',
			'priority' => 130,
			'input_attrs'     => array( 'min' => 1, 'max' => 500, 'style' => 'width: 150px;' ),

		)
	);


	// Setting .
	$wp_customize->add_setting( 'show_page_link_button',
		array(
			'default'           => $default['show_page_link_button'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'multipurpose_business_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'show_page_link_button',
		array(
			'label'    => esc_html__( 'Enable Page Link Button', 'multipurpose-business' ),
			'section'  => 'header_content',
			'type'     => 'checkbox',
			'priority' => 140,
		)
	);



	/*button text*/
	$wp_customize->add_setting( 'banner_additional_button_text',
		array(
			'default'           => $default['banner_additional_button_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control( 'banner_additional_button_text',
		array(
			'label'    		=> __( 'Additional Banner Button Text', 'multipurpose-business' ),
			'description'	=> __( 'Removing the text from this section will disable the custom button on Banner Section', 'multipurpose-business' ),
			'section'  		=> 'header_content',
			'type'     		=> 'text',
			'priority' 		=> 150,
		)
	);

	/*button url*/
	$wp_customize->add_setting( 'additional_button_link',
		array(
			'default'           => $default['additional_button_link'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control( 'additional_button_link',
		array(
			'label'    		=> __( 'Additional Button URL', 'multipurpose-business' ),
			'section'  		=> 'header_content',
			'type'     		=> 'text',
			'priority' 		=> 160,
		)
	);