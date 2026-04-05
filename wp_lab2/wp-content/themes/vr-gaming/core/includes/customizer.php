<?php

if ( class_exists("Kirki")){

if ( ! defined( 'VR_GAMING_BUY_NOW' ) ) {
define('VR_GAMING_BUY_NOW',__('https://www.misbahwp.com/products/vr-gaming-wordpress-theme','vr-gaming'));
}

	// LOGO

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'vr_gaming_logo_resizer',
		'label'       => esc_html__( 'Adjust Your Logo Size ', 'vr-gaming' ),
		'section'     => 'title_tagline',
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 10,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'vr-gaming' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'vr-gaming' ),
		'section'     => 'title_tagline',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

	// FONT STYLE TYPOGRAPHY

	Kirki::add_panel( 'vr_gaming_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Typography', 'vr-gaming' ),
	) );

	Kirki::add_section( 'vr_gaming_font_style_section', array(
		'title'      => esc_html__( 'Typography Option',  'vr-gaming' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_font_style_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_all_headings_typography',
		'section'     => 'vr_gaming_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'vr_gaming_all_headings_typography',
		'label'       => esc_html__( 'Heading Typography',  'vr-gaming' ),
		'description' => esc_html__( 'Select the typography options for your heading.',  'vr-gaming' ),
		'section'     => 'vr_gaming_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_body_content_typography',
		'section'     => 'vr_gaming_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'vr_gaming_body_content_typography',
		'label'       => esc_html__( 'Content Typography',  'vr-gaming' ),
		'description' => esc_html__( 'Select the typography options for your content.',  'vr-gaming' ),
		'section'     => 'vr_gaming_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );

		// PANEL
	Kirki::add_panel( 'vr_gaming_panel_id_5', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Animations', 'vr-gaming' ),
	) );

	// ANIMATION SECTION
	Kirki::add_section( 'vr_gaming_section_animation', array(
	    'title'          => esc_html__( 'Animations', 'vr-gaming' ),
	    'priority'       => 2,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_section_animation',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_animation_enabled',
		'label'       => esc_html__( 'Turn To Show Animation', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_animation',
		'default'     => true,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

	// PANEL
	Kirki::add_panel( 'vr_gaming_panel_id_2', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Dark Mode', 'vr-gaming' ),
	) );

	// DARK MODE SECTION
	Kirki::add_section( 'vr_gaming_section_dark_mode', array(
	    'title'          => esc_html__( 'Dark Mode', 'vr-gaming' ),
	    'priority'       => 3,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_section_dark_mode',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	]);

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'vr_gaming_dark_colors',
	    'section'     => 'vr_gaming_section_dark_mode',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Dark Appearance', 'vr-gaming' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_is_dark_mode_enabled',
		'label'       => esc_html__( 'Turn To Dark Mode', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_dark_mode',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );


	// PANEL
	Kirki::add_panel( 'vr_gaming_panel_id_3', array(
	    'priority'    => 10,
	    'title'       => esc_html__( '404 Settings / No Result', 'vr-gaming' ),
	) );

	// 404 SECTION
	Kirki::add_section( 'vr_gaming_section_404', array(
		'panel'          => 'vr_gaming_panel_id_3',
	    'title'          => esc_html__( '404 Settings', 'vr-gaming' ),
	    'priority'       => 3,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_section_404',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
		'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'vr_gaming_404_heading',
	    'section'     => 'vr_gaming_section_404',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Heading', 'vr-gaming' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_404_page_title',
		'section'  => 'vr_gaming_section_404',
		'default'  => esc_html__('404 Not Found', 'vr-gaming'),
		'priority' => 10,
	] );

		Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'vr_gaming_404_text',
	    'section'     => 'vr_gaming_section_404',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Content', 'vr-gaming' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_404_page_content',
		'section'  => 'vr_gaming_section_404',
		'default'  => esc_html__('Sorry, no posts matched your criteria.', 'vr-gaming'),
		'priority' => 10,
	] );

	// NO Result
	Kirki::add_section( 'vr_gaming_no_result', array(
		'panel'          => 'vr_gaming_panel_id_3',
	    'title'          => esc_html__( 'No Result Page Settings', 'vr-gaming' ),
	    'priority'       => 3,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_no_result',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
		'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'vr_gaming_not_found_heading',
	    'section'     => 'vr_gaming_no_result',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Search Result Heading', 'vr-gaming' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_no_results_page_title',
		'section'  => 'vr_gaming_no_result',
		'default'  => esc_html__('404 Not Found', 'vr-gaming'),
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'vr_gaming_not_found_text',
	    'section'     => 'vr_gaming_no_result',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Search Result Content', 'vr-gaming' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_no_results_page_content',
		'section'  => 'vr_gaming_no_result',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vr-gaming'),
		'priority' => 10,
	] );

	// PANEL

	Kirki::add_panel( 'vr_gaming_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Options', 'vr-gaming' ),
	) );

	//COLOR SECTION

	Kirki::add_section( 'vr_gaming_section_color', array(
	    'title'          => esc_html__( 'Global Color', 'vr-gaming' ),
	    'panel'          => 'vr_gaming_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_section_color',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_global_colors',
		'section'     => 'vr_gaming_section_color',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Here you can change your theme color on one click.', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'vr_gaming_first_color',
		'label'       => __( 'Choose Your First Color', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_color',
		'default'     => '#F83DDE',
	] );

	// Additional Settings

	Kirki::add_section( 'vr_gaming_additional_settings', array(
	    'title'          => esc_html__( 'Additional Settings', 'vr-gaming' ),
	    'panel'          => 'vr_gaming_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_additional_settings',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	new \Kirki\Field\Radio_Buttonset(
	[
		'settings'    => 'vr_gaming_scroll_top_position',
		'label'       => esc_html__( 'Alignment for Scroll To Top', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default'     => 'Right',
		'priority'    => 10,
		'choices'     => [
			'Left'   => esc_html__( 'Left', 'vr-gaming' ),
			'Center' => esc_html__( 'Center', 'vr-gaming' ),
			'Right'  => esc_html__( 'Right', 'vr-gaming' ),
		],
	]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'vr_gaming_scroll_top_icon',
		'label'    => esc_html__( 'Select Appropriate Scroll Top Icon', 'vr-gaming' ),
		'section'  => 'vr_gaming_additional_settings',
		'default'  => 'dashicons dashicons-arrow-up-alt',
		'priority' => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'menu_text_transform_vr_gaming',
		'label'       => esc_html__( 'Menus Text Transform', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default'     => 'CAPITALISE',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'CAPITALISE' => esc_html__( 'CAPITALISE', 'vr-gaming' ),
			'UPPERCASE' => esc_html__( 'UPPERCASE', 'vr-gaming' ),
			'LOWERCASE' => esc_html__( 'LOWERCASE', 'vr-gaming' ),

		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_menu_zoom',
		'label'       => esc_html__( 'Menu Transition', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default' => 'Zoom Out',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Zoomout' => __('Zoom Out','vr-gaming'),
            'Zoominn' => __('Zoom Inn','vr-gaming'),
            
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'vr_gaming_container_width',
		'label'       => esc_html__( 'Theme Container Width', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default'     => 100,
		'choices'     => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_site_loader',
		'label'       => esc_html__( 'Here you can enable or disable your Site Loader.', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

		new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_preloader_type',
		'label'       => esc_html__( 'Preloader Type', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default' => 'four-way-loader',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'four-way-loader' => __('Type 1','vr-gaming'),
            'cube-loader' => __('Type 2','vr-gaming'),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_sticky_header',
		'label'       => esc_html__( 'Here you can enable or disable your Sticky Header.', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_page_layout',
		'label'       => esc_html__( 'Page Layout Setting', 'vr-gaming' ),
		'section'     => 'vr_gaming_additional_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','vr-gaming'),
            'Right Sidebar' => __('Right Sidebar','vr-gaming'),
            'One Column' => __('One Column','vr-gaming')
		],
	] );

	if ( class_exists("woocommerce")){

	// Woocommerce Settings

	Kirki::add_section( 'vr_gaming_woocommerce_settings', array(
			'title'          => esc_html__( 'Woocommerce Settings', 'vr-gaming' ),
			'panel'          => 'vr_gaming_panel_id',
			'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_woocommerce_settings',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_shop_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable shop page sidebar.', 'vr-gaming' ),
		'section'     => 'vr_gaming_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_product_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable product page sidebar.', 'vr-gaming' ),
		'section'     => 'vr_gaming_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_related_product_setting',
		'label'       => esc_html__( 'Here you can enable or disable your related products.', 'vr-gaming' ),
		'section'     => 'vr_gaming_woocommerce_settings',
		'default'     => true,
		'priority'    => 10,
	] );

	new \Kirki\Field\Number(
		[
			'settings' => 'vr_gaming_per_columns',
			'label'    => esc_html__( 'Product Per Row', 'vr-gaming' ),
			'section'  => 'vr_gaming_woocommerce_settings',
			'default'  => 3,
			'choices'  => [
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			],
		]
	);

	new \Kirki\Field\Number(
		[
			'settings' => 'vr_gaming_product_per_page',
			'label'    => esc_html__( 'Product Per Page', 'vr-gaming' ),
			'section'  => 'vr_gaming_woocommerce_settings',
			'default'  => 9,
			'choices'  => [
				'min'  => 1,
				'max'  => 15,
				'step' => 1,
			],
		]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number_per_row',
		'label'    => esc_html__( 'Related Product Per Column', 'vr-gaming' ),
		'section'  => 'vr_gaming_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number',
		'label'    => esc_html__( 'Related Product Per Page', 'vr-gaming' ),
		'section'  => 'vr_gaming_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_shop_page_layout',
		'label'       => esc_html__( 'Shop Page Layout Setting', 'vr-gaming' ),
		'section'     => 'vr_gaming_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','vr-gaming'),
            'Right Sidebar' => __('Right Sidebar','vr-gaming')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_product_page_layout',
		'label'       => esc_html__( 'Product Page Layout Setting', 'vr-gaming' ),
		'section'     => 'vr_gaming_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','vr-gaming'),
            'Right Sidebar' => __('Right Sidebar','vr-gaming')
		],
	] );

	new \Kirki\Field\Radio_Buttonset( [
		'settings'    => 'vr_gaming_woocommerce_pagination_position',
		'label'       => esc_html__( 'Woocommerce Pagination Alignment', 'vr-gaming' ),
		'section'     => 'vr_gaming_woocommerce_settings',
		'default'     => 'Center',
		'priority'    => 10,
		'choices'     => [
			'Left'   => esc_html__( 'Left', 'vr-gaming' ),
			'Center' => esc_html__( 'Center', 'vr-gaming' ),
			'Right'  => esc_html__( 'Right', 'vr-gaming' ),
		],
	]
	);

}

	// POST SECTION

	Kirki::add_section( 'vr_gaming_section_post', array(
	    'title'          => esc_html__( 'Post Settings', 'vr-gaming' ),
	    'panel'          => 'vr_gaming_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_section_post',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

		new \Kirki\Field\Sortable(
	[
		'settings' => 'vr_gaming_archive_element_sortable',
		'label'    => __( 'Archive Post Page Element Reordering', 'vr-gaming' ),
		'description'    => esc_html__( 'This setting is not favorable with post format.', 'vr-gaming' ),
		'section'  => 'vr_gaming_section_post',
		'default'  => [ 'option1', 'option2', 'option3', 'option4', 'option5' ],
		'choices'  => [
			'option1' => esc_html__( 'Post Image', 'vr-gaming' ),
			'option2' => esc_html__( 'Post Meta', 'vr-gaming' ),
			'option3' => esc_html__( 'Post Title', 'vr-gaming' ),
			'option4' => esc_html__( 'Post Content', 'vr-gaming' ),
			'option5' => esc_html__( 'Post Button', 'vr-gaming' ),
		],
	]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'vr_gaming_post_excerpt_number',
		'label'       => esc_html__( 'Post Content Range', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_post',
		'default'     => 10,
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'vr_gaming_pagination_setting',
		'label'       => esc_html__( 'Here you can enable or disable your Pagination.', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_post',
		'default'     => true,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_archive_sidebar_layout',
		'label'       => esc_html__( 'Archive Post Sidebar Layout Setting', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','vr-gaming'),
            'Right Sidebar' => __('Right Sidebar','vr-gaming'),
            'Three Column' => __('Three Column','vr-gaming'),
            'Four Column' => __('Four Column','vr-gaming'),
            'Grid Layout Without Sidebar' => __('Grid Layout Without Sidebar','vr-gaming'),
            'Grid Layout With Right Sidebar' => __('Grid Layout With Right Sidebar','vr-gaming'),
            'Grid Layout With Left Sidebar' => __('Grid Layout With Left Sidebar','vr-gaming')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_single_post_sidebar_layout',
		'label'       => esc_html__( 'Single Post Sidebar Layout Setting', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','vr-gaming'),
            'Right Sidebar' => __('Right Sidebar','vr-gaming'),
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_search_sidebar_layout',
		'label'       => esc_html__( 'Search Page Sidebar Layout Setting', 'vr-gaming' ),
		'section'     => 'vr_gaming_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','vr-gaming'),
            'Right Sidebar' => __('Right Sidebar','vr-gaming'),
            'Three Column' => __('Three Column','vr-gaming'),
            'Four Column' => __('Four Column','vr-gaming'),
            'Grid Layout Without Sidebar' => __('Grid Layout Without Sidebar','vr-gaming'),
            'Grid Layout With Right Sidebar' => __('Grid Layout With Right Sidebar','vr-gaming'),
            'Grid Layout With Left Sidebar' => __('Grid Layout With Left Sidebar','vr-gaming')
		],
	] );

	// Breadcrumb
	Kirki::add_section( 'vr_gaming_bradcrumb', array(
	    'title'          => esc_html__( 'Breadcrumb Settings', 'vr-gaming' ),
	    'panel'          => 'vr_gaming_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_bradcrumb',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_enable_breadcrumb_heading',
		'section'     => 'vr_gaming_bradcrumb',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Single Page Breadcrumb', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_breadcrumb_enable',
		'label'       => esc_html__( 'Breadcrumb Enable / Disable', 'vr-gaming' ),
		'section'     => 'vr_gaming_bradcrumb',
		'default'     => true,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'default'     => '/',
        'settings' => 'vr_gaming_breadcrumb_separator' ,
        'label'    => esc_html__( 'Breadcrumb Separator',  'vr-gaming' ),
        'section'  => 'vr_gaming_bradcrumb',
    ] );

	// HEADER SECTION

	Kirki::add_section( 'vr_gaming_header_section', array(
        'title'          => esc_html__( 'Header Settings', 'vr-gaming' ),
        'panel'          => 'vr_gaming_panel_id',
        'priority'       => 160,
    ) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_header_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_enable_search',
		'section'     => 'vr_gaming_header_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Search Box', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_search_box_enable',
		'label'       => esc_html__( 'Search Enable / Disable Button', 'vr-gaming' ),
		'section'     => 'vr_gaming_header_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

	// SLIDER SECTION

	Kirki::add_section( 'vr_gaming_blog_slide_section', array(
        'title'          => esc_html__( 'Slider Settings', 'vr-gaming' ),
        'panel'          => 'vr_gaming_panel_id',
        'priority'       => 160,
    ) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_blog_slide_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_enable_heading',
		'section'     => 'vr_gaming_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Slider', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_blog_box_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'vr-gaming' ),
		'section'     => 'vr_gaming_blog_slide_section',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_slider_heading',
		'section'     => 'vr_gaming_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Slider', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

	new \Kirki\Field\Image(
		[
			'settings'    => 'vr_gaming_slider_banner_image',
			'label'       => esc_html__( 'Upload Slider Image', 'vr-gaming' ),
			'section'     => 'vr_gaming_blog_slide_section',
			'default'     => '',
		]
	);

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'vr_gaming_blog_slide_number',
		'label'       => esc_html__( 'Number of slides to show', 'vr-gaming' ),
		'section'     => 'vr_gaming_blog_slide_section',
		'default'     => 3,
		'choices'     => [
			'min'  => 0,
			'max'  => 3,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'vr_gaming_blog_slide_category',
		'label'       => esc_html__( 'Select the category to show slider ( Image Dimension 1600 x 600 )', 'vr-gaming' ),
		'section'     => 'vr_gaming_blog_slide_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'vr-gaming' ),
		'priority'    => 10,
		'choices'     => vr_gaming_get_categories_select(),
	] );

	// OUR PRODUCTS SECTION

	Kirki::add_section( 'vr_gaming_products_section', array(
        'title'          => esc_html__( 'Our Products Settings', 'vr-gaming' ),
        'panel'          => 'vr_gaming_panel_id',
        'priority'       => 160,
    ) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_products_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_products_section_enable_heading',
		'section'     => 'vr_gaming_products_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Products Section', 'vr-gaming' ) . '</h3>',
		'priority'    => 1,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_products_section_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'vr-gaming' ),
		'section'     => 'vr_gaming_products_section',
		'default'     => true,
		'priority'    => 2,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_products_heading',
		'section'     => 'vr_gaming_products_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Our Products Headings',  'vr-gaming' ) . '</h3>',
		'priority'    => 3,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_products_short_heading',
		'label'    => esc_html__( 'Main Short Heading', 'vr-gaming' ),
		'section'  => 'vr_gaming_products_section',
		'priority' => 5,
    ] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_products_main_heading',
		'label'    => esc_html__( 'Main Heading', 'vr-gaming' ),
		'section'  => 'vr_gaming_products_section',
		'priority' => 5,
    ] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_our_product_heading',
		'section'     => 'vr_gaming_products_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Hot Products', 'vr-gaming' ) . '</h3>',
		'priority'    => 7,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'vr_gaming_products_per_page',
		'label'       => esc_html__( 'Number of products to show', 'vr-gaming' ),
		'section'     => 'vr_gaming_products_section',
		'default'     => 8,
		'choices'     => [
			'min'  => 0,
			'max'  => 12,
			'step' => 1,
		],
	] );

	// FOOTER SECTION

	Kirki::add_section( 'vr_gaming_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'vr-gaming' ),
        'description'    => esc_html__( 'Here you can change copyright text', 'vr-gaming' ),
        'panel'          => 'vr_gaming_panel_id',
        'priority'       => 160,
    ) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'vr-gaming' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( VR_GAMING_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'vr-gaming' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'vr_gaming_footer_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'vr-gaming' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_footer_enable_heading',
		'section'     => 'vr_gaming_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Footer Link', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'vr_gaming_copyright_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'vr-gaming' ),
		'section'     => 'vr_gaming_footer_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'vr-gaming' ),
			'off' => esc_html__( 'Disable', 'vr-gaming' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_footer_text_heading',
		'section'     => 'vr_gaming_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'vr-gaming' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'vr_gaming_footer_text',
		'section'  => 'vr_gaming_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'vr_gaming_footer_text_heading_2',
	'section'     => 'vr_gaming_footer_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Alignment', 'vr-gaming' ) . '</h3>',
	'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'vr_gaming_copyright_text_alignment',
		'label'       => esc_html__( 'Copyright text Alignment', 'vr-gaming' ),
		'section'     => 'vr_gaming_footer_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'vr-gaming' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'vr-gaming' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'vr-gaming' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'vr-gaming' ),

		],
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'vr_gaming_footer_text_heading_1',
	'section'     => 'vr_gaming_footer_section',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Background Color', 'vr-gaming' ) . '</h3>',
	'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'vr_gaming_copyright_bg',
		'label'       => __( 'Choose Your Copyright Background Color', 'vr-gaming' ),
		'section'     => 'vr_gaming_footer_section',
		'default'     => '#000000',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'vr_gaming_enable_footer_socail_link',
		'section'     => 'vr_gaming_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'vr-gaming' ) . '</h3>',
		'priority'    => 11,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'vr_gaming_footer_section',
		'priority'    => 11,
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Footer Social Icon', 'vr-gaming' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'vr-gaming' ),
		'settings'     => 'vr_gaming_footer_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'vr-gaming' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'vr-gaming' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'vr-gaming' ),
				'description' => esc_html__( 'Add the social icon url here.', 'vr-gaming' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 5
		],
	] );
}

add_action( 'customize_register', 'vr_gaming_customizer_settings' );
function vr_gaming_customizer_settings( $wp_customize ) {
	$vr_gaming_args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
	$categories = get_categories($vr_gaming_args);
	$vr_gaming_cat_posts = array();
	$vr_gaming_m = 0;
	$vr_gaming_cat_posts[]='Select';
	foreach($categories as $category){
		if($vr_gaming_m==0){
			$default = $category->slug;
			$vr_gaming_m++;
		}
		$vr_gaming_cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vr_gaming_products_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vr_gaming_sanitize_select',
		'description'    => esc_html__( 'You have to select product category to show product section.', 'vr-gaming' ),
	));

	$wp_customize->add_control('vr_gaming_products_category',array(
		'type'    => 'select',
		'choices' => $vr_gaming_cat_posts,
		'label' => __('Select category to display products ','vr-gaming'),
		'section' => 'vr_gaming_products_section',
	));
}

/*
 *  Customizer Notifications
 */

$vr_gaming_config_customizer = array(
    'recommended_plugins' => array( 
        'kirki' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the sections of the FrontPage, please install and activate %s plugin', 'vr-gaming' ), 
                '<strong>' . esc_html__( 'Kirki Customizer', 'vr-gaming' ) . '</strong>'
            ),
        ),
    ),
    'vr_gaming_recommended_actions'       => array(),
    'vr_gaming_recommended_actions_title' => esc_html__( 'Recommended Actions', 'vr-gaming' ),
    'vr_gaming_recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'vr-gaming' ),
    'vr_gaming_install_button_label'      => esc_html__( 'Install and Activate', 'vr-gaming' ),
    'vr_gaming_activate_button_label'     => esc_html__( 'Activate', 'vr-gaming' ),
    'vr_gaming_deactivate_button_label'   => esc_html__( 'Deactivate', 'vr-gaming' ),
);

VR_Gaming_Customizer_Notify::init( apply_filters( 'vr_gaming_customizer_notify_array', $vr_gaming_config_customizer ) );