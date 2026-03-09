<?php

function boldo_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'boldo_header',
		array(
			'title'    => __( 'Header', 'tailpress' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_section(
		'boldo_footer',
		array(
			'title'    => __( 'Footer', 'tailpress' ),
			'priority' => 31,
		)
	);

	$wp_customize->add_setting(
		'boldo_header_logo',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'boldo_header_logo',
			array(
				'label'   => __( 'Header Logo', 'tailpress' ),
				'section' => 'boldo_header',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_logo',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'boldo_footer_logo',
			array(
				'label'   => __( 'Footer Logo', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_description',
		array(
			'default'           => 'Social media validation business model canvas graphical user interface launch party creative facebook iPad twitter.',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);
	$wp_customize->add_control(
		'boldo_footer_description',
		array(
			'label'   => __( 'Footer Description', 'tailpress' ),
			'section' => 'boldo_footer',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_rights_text',
		array(
			'default'           => 'All rights reserved.',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'boldo_footer_rights_text',
		array(
			'label'   => __( 'Footer Rights Text', 'tailpress' ),
			'section' => 'boldo_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_heading_color',
		array(
			'default'           => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_footer_heading_color',
			array(
				'label'   => __( 'Footer Heading Color', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_text_color',
		array(
			'default'           => '#777777',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_footer_text_color',
			array(
				'label'   => __( 'Footer Text Color', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_link_color',
		array(
			'default'           => '#777777',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_footer_link_color',
			array(
				'label'   => __( 'Footer Link Color', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_link_hover_color',
		array(
			'default'           => '#65E4A3',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_footer_link_hover_color',
			array(
				'label'   => __( 'Footer Link Hover Color', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_landings_title',
		array(
			'default'           => 'Landings',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'boldo_footer_landings_title',
		array(
			'label'   => __( 'Footer Landings Title', 'tailpress' ),
			'section' => 'boldo_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_company_title',
		array(
			'default'           => 'Company',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'boldo_footer_company_title',
		array(
			'label'   => __( 'Footer Company Title', 'tailpress' ),
			'section' => 'boldo_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_resources_title',
		array(
			'default'           => 'Resources',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'boldo_footer_resources_title',
		array(
			'label'   => __( 'Footer Resources Title', 'tailpress' ),
			'section' => 'boldo_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_hiring_badge_text',
		array(
			'default'           => 'Hiring!',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'boldo_footer_hiring_badge_text',
		array(
			'label'   => __( 'Hiring Badge Text', 'tailpress' ),
			'section' => 'boldo_footer',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_hiring_badge_bg_color',
		array(
			'default'           => '#65E4A3',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_footer_hiring_badge_bg_color',
			array(
				'label'   => __( 'Hiring Badge Background Color', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_footer_hiring_badge_text_color',
		array(
			'default'           => '#0A2640',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_footer_hiring_badge_text_color',
			array(
				'label'   => __( 'Hiring Badge Text Color', 'tailpress' ),
				'section' => 'boldo_footer',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_header_menu_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_header_menu_text_color',
			array(
				'label'   => __( 'Menu Text Color', 'tailpress' ),
				'section' => 'boldo_header',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_header_menu_hover_text_color',
		array(
			'default'           => '#65E4A3',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_header_menu_hover_text_color',
			array(
				'label'   => __( 'Menu Hover Text Color', 'tailpress' ),
				'section' => 'boldo_header',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_text_color',
		array(
			'default'           => '#0A2640',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_header_cta_text_color',
			array(
				'label'   => __( 'Header Button Text Color', 'tailpress' ),
				'section' => 'boldo_header',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_bg_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_header_cta_bg_color',
			array(
				'label'   => __( 'Header Button Background Color', 'tailpress' ),
				'section' => 'boldo_header',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_hover_bg_color',
		array(
			'default'           => '#65E4A3',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'boldo_header_cta_hover_bg_color',
			array(
				'label'   => __( 'Header Button Hover Background Color', 'tailpress' ),
				'section' => 'boldo_header',
			)
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_enable',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'boldo_header_cta_enable',
		array(
			'label'   => __( 'Enable Header Button', 'tailpress' ),
			'section' => 'boldo_header',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_text',
		array(
			'default'           => 'Log In',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'boldo_header_cta_text',
		array(
			'label'   => __( 'Header Button Text', 'tailpress' ),
			'section' => 'boldo_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_url',
		array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'boldo_header_cta_url',
		array(
			'label'   => __( 'Header Button URL', 'tailpress' ),
			'section' => 'boldo_header',
			'type'    => 'url',
		)
	);

	$wp_customize->add_setting(
		'boldo_header_cta_new_tab',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'boldo_header_cta_new_tab',
		array(
			'label'   => __( 'Open Header Button in New Tab', 'tailpress' ),
			'section' => 'boldo_header',
			'type'    => 'checkbox',
		)
	);
}

add_action( 'customize_register', 'boldo_customize_register' );

function boldo_nav_menu_link_attributes( $atts, $menu_item, $args, $depth ) {
	if ( isset( $args->theme_location ) && $args->theme_location === 'primary' ) {
		$is_cta = in_array( 'menu-item-cta', (array) $menu_item->classes, true ) || in_array( 'is-cta', (array) $menu_item->classes, true );
		if ( $is_cta ) {
			$atts['class'] = 'font-opensans text-sm md:text-base/6 px-6 md:px-[41px] py-2 rounded-full font-bold transition';
		} else {
			$atts['class'] = 'font-opensans inline-flex items-center text-sm md:text-base/6 font-semibold transition';
		}
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'boldo_nav_menu_link_attributes', 10, 4 );

function boldo_footer_nav_menu_link_attributes( $atts, $menu_item, $args, $depth ) {
	if ( ! isset( $args->theme_location ) ) {
		return $atts;
	}

	$footer_locations = array( 'footer_landings', 'footer_company', 'footer_resources' );
	if ( in_array( $args->theme_location, $footer_locations, true ) ) {
		$atts['class'] = 'text-xl sm:text-xl leading-8 font-normal transition';
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'boldo_footer_nav_menu_link_attributes', 11, 4 );

function boldo_footer_company_menu_hiring_badge( $item_output, $menu_item, $depth, $args ) {
	if ( ! isset( $args->theme_location ) || $args->theme_location !== 'footer_company' ) {
		return $item_output;
	}

	$classes = array();
	foreach ( (array) $menu_item->classes as $class ) {
		$classes[] = strtolower( sanitize_html_class( $class ) );
	}

	if ( ! in_array( 'hiring', $classes, true ) ) {
		return $item_output;
	}

	$badge_text  = get_theme_mod( 'boldo_footer_hiring_badge_text', 'Hiring!' );
	$badge_bg    = get_theme_mod( 'boldo_footer_hiring_badge_bg_color', '#65E4A3' );
	$badge_color = get_theme_mod( 'boldo_footer_hiring_badge_text_color', '#0A2640' );
	$badge_text  = $badge_text ? $badge_text : 'Hiring!';
	$badge_bg    = $badge_bg ? $badge_bg : '#65E4A3';
	$badge_color = $badge_color ? $badge_color : '#0A2640';

	$badge = ' <span class="text-sm leading-7 font-bold px-3 py-1 rounded-full" style="background-color:' . esc_attr( $badge_bg ) . ';color:' . esc_attr( $badge_color ) . ';">' . esc_html( $badge_text ) . '</span>';

	if ( strpos( $item_output, '</a>' ) !== false ) {
		$item_output = str_replace( '</a>', $badge . '</a>', $item_output );
	} else {
		$item_output .= $badge;
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'boldo_footer_company_menu_hiring_badge', 10, 4 );

function boldo_primary_menu_append_cta( $items, $args ) {
	if ( ! isset( $args->theme_location ) || $args->theme_location !== 'primary' ) {
		return $items;
	}

	if ( ! get_theme_mod( 'boldo_header_cta_enable', 1 ) ) {
		return $items;
	}

	$cta_text    = get_theme_mod( 'boldo_header_cta_text', 'Log In' );
	$cta_url     = get_theme_mod( 'boldo_header_cta_url', '#' );
	$cta_new_tab = (bool) get_theme_mod( 'boldo_header_cta_new_tab', 0 );

	$target = $cta_new_tab ? ' target="_blank" rel="noopener noreferrer"' : '';

	$items .= '<li class="menu-item-cta"><a class="font-opensans text-sm md:text-base/6 px-6 md:px-[41px] py-2 rounded-full font-bold transition" href="' . esc_url( $cta_url ) . '"' . $target . '>' . esc_html( $cta_text ) . '</a></li>';

	return $items;
}

add_filter( 'wp_nav_menu_items', 'boldo_primary_menu_append_cta', 10, 2 );

function boldo_header_dynamic_css() {
	// Agar is page pe ACF Custom Header ON hai toh
	// customizer CSS skip karo - ACF header.php handle karega
	$acf_enabled = function_exists( 'get_field' ) ? get_field( 'enable_custom_header' ) : false;
	if ( $acf_enabled ) {
		return;
	}

	// Sirf woh pages jahan ACF custom header OFF hai
	// unpe customizer ki default CSS lagegi
	$menu_text    = get_theme_mod( 'boldo_header_menu_text_color', '#ffffff' );
	$menu_hover   = get_theme_mod( 'boldo_header_menu_hover_text_color', '#65E4A3' );
	$cta_text     = get_theme_mod( 'boldo_header_cta_text_color', '#0A2640' );
	$cta_bg       = get_theme_mod( 'boldo_header_cta_bg_color', '#ffffff' );
	$cta_hover_bg = get_theme_mod( 'boldo_header_cta_hover_bg_color', '#65E4A3' );
	$menu_text    = $menu_text    ? $menu_text    : '#ffffff';
	$menu_hover   = $menu_hover   ? $menu_hover   : '#65E4A3';
	$cta_text     = $cta_text     ? $cta_text     : '#0A2640';
	$cta_bg       = $cta_bg       ? $cta_bg       : '#ffffff';
	$cta_hover_bg = $cta_hover_bg ? $cta_hover_bg : '#65E4A3';

	echo '<style id="boldo-header-customizer-css">';
	echo '#mainMenu a{color:' . esc_attr( $menu_text ) . ' !important;}';
	echo '#mainMenu a:hover{color:' . esc_attr( $menu_hover ) . ' !important;}';
	echo '#mainMenu li.menu-item-cta a{background-color:' . esc_attr( $cta_bg ) . ' !important;color:' . esc_attr( $cta_text ) . ' !important;}';
	echo '#mainMenu li.menu-item-cta a:hover{background-color:' . esc_attr( $cta_hover_bg ) . ' !important;}';
	echo '</style>';
}

add_action( 'wp_head', 'boldo_header_dynamic_css' );

function boldo_footer_dynamic_css() {
	$heading   = get_theme_mod( 'boldo_footer_heading_color', '#000000' );
	$text      = get_theme_mod( 'boldo_footer_text_color', '#777777' );
	$link      = get_theme_mod( 'boldo_footer_link_color', '#777777' );
	$linkhover = get_theme_mod( 'boldo_footer_link_hover_color', '#65E4A3' );
	$heading   = $heading ? $heading : '#000000';
	$text      = $text ? $text : '#777777';
	$link      = $link ? $link : '#777777';
	$linkhover = $linkhover ? $linkhover : '#65E4A3';

	echo '<style id="boldo-footer-customizer-css">';
	echo '#boldoFooter h3{color:' . esc_attr( $heading ) . ' !important;}';
	echo '#boldoFooter p{color:' . esc_attr( $text ) . ' !important;}';
	echo '#boldoFooter a{color:' . esc_attr( $link ) . ' !important;}';
	echo '#boldoFooter a:hover{color:' . esc_attr( $linkhover ) . ' !important;}';
	echo '</style>';
}

add_action( 'wp_head', 'boldo_footer_dynamic_css' );