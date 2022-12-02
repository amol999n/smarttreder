<?php 
$default = multipurpose_business_get_default_theme_options();

//$wp_customize->get_section('colors')->title = __( 'General settings' );

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_color_typo',
	array(
		'title'      => __( 'General settings', 'multipurpose-business' ),
		'priority'   => 40,
		'capability' => 'edit_theme_options',
	)
);

// font Section.
$wp_customize->add_section( 'font_typo_section',
	array(
		'title'      => __( 'Fonts & Typography', 'multipurpose-business' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_color_typo',
	)
);

// font Section.
$wp_customize->add_section( 'colors',
	array(
		'title'      => __( 'Color Options', 'multipurpose-business' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_color_typo',
	)
);

// Setting - primary_color.
$wp_customize->add_setting( 'primary_color',
	array(
		'default'           => $default['primary_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( 'primary_color',
	array(
		'label'    => __( 'Primary Color', 'multipurpose-business' ),
		'section'  => 'colors',
		'type'     => 'color',
		'priority' => 100,
	)
);


// Setting - secondary_color.
$wp_customize->add_setting( 'secondary_color',
	array(
		'default'           => $default['secondary_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( 'secondary_color',
	array(
		'label'    => __( 'Secondary Color', 'multipurpose-business' ),
		'section'  => 'colors',
		'type'     => 'color',
		'priority' => 100,
	)
);


// Setting - tertiary_color.
$wp_customize->add_setting( 'tertiary_color',
	array(
		'default'           => $default['tertiary_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( 'tertiary_color',
	array(
		'label'    => __( 'Tertiary Color', 'multipurpose-business' ),
		'section'  => 'colors',
		'type'     => 'color',
		'priority' => 100,
	)
);

global $multipurpose_business_google_fonts;

// Setting - primary_font.
$wp_customize->add_setting( 'primary_font',
	array(
		'default'           => $default['primary_font'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control( 'primary_font',
	array(
		'label'    => __( 'Primary Font', 'multipurpose-business' ),
		'section'  => 'font_typo_section',
		'type'     => 'select',
		'choices'     => $multipurpose_business_google_fonts,
		'priority' => 100,
	)
);

// Setting - secondary_font.
$wp_customize->add_setting( 'secondary_font',
	array(
		'default'           => $default['secondary_font'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_select',
	)
);
$wp_customize->add_control( 'secondary_font',
	array(
		'label'    => __( 'Secondary Font', 'multipurpose-business' ),
		'section'  => 'font_typo_section',
		'type'     => 'select',
		'choices'     => $multipurpose_business_google_fonts,
		'priority' => 110,
	)
);


// Setting - text_size_title_font_big.
$wp_customize->add_setting( 'text_size_title_font_big',
	array(
		'default'           => $default['text_size_title_font_big'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'text_size_title_font_big',
	array(
		'label'    => __( 'Font Size for Big Title', 'multipurpose-business' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 120,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

// Setting - text_size_title_font_small.
$wp_customize->add_setting( 'text_size_title_font_small',
	array(
		'default'           => $default['text_size_title_font_small'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'text_size_title_font_small',
	array(
		'label'    => __( 'Font Size for Small Title', 'multipurpose-business' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 125,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

// Setting - text_size_p.
$wp_customize->add_setting( 'text_size_p',
	array(
		'default'           => $default['text_size_p'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'multipurpose_business_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'text_size_p',
	array(
		'label'    => __( 'Font Size For Paragraph', 'multipurpose-business' ),
		'section'  => 'font_typo_section',
		'type'     => 'number',
		'priority' => 140,
		'input_attrs'     => array( 'min' => 1, 'max' => 100, 'style' => 'width: 150px;' ),
	)
);

