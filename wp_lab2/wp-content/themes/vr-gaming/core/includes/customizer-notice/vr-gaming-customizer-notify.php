<?php

class VR_Gaming_Customizer_Notify {

	private $config = array(); // Declare $config property
	
	private $vr_gaming_recommended_actions;
	
	private $recommended_plugins;
	
	private static $instance;
	
	private $vr_gaming_recommended_actions_title;
	
	private $vr_gaming_recommended_plugins_title;
	
	private $dismiss_button;
	
	private $vr_gaming_install_button_label;
	
	private $vr_gaming_activate_button_label;
	
	private $vr_gaming_deactivate_button_label;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof VR_Gaming_Customizer_Notify ) ) {
			self::$instance = new VR_Gaming_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $vr_gaming_customizer_notify_recommended_plugins;
		global $vr_gaming_customizer_notify_vr_gaming_recommended_actions;

		global $vr_gaming_install_button_label;
		global $vr_gaming_activate_button_label;
		global $vr_gaming_deactivate_button_label;

		$this->vr_gaming_recommended_actions = isset( $this->config['vr_gaming_recommended_actions'] ) ? $this->config['vr_gaming_recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->vr_gaming_recommended_actions_title = isset( $this->config['vr_gaming_recommended_actions_title'] ) ? $this->config['vr_gaming_recommended_actions_title'] : '';
		$this->vr_gaming_recommended_plugins_title = isset( $this->config['vr_gaming_recommended_plugins_title'] ) ? $this->config['vr_gaming_recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$vr_gaming_customizer_notify_recommended_plugins = array();
		$vr_gaming_customizer_notify_vr_gaming_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$vr_gaming_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->vr_gaming_recommended_actions ) ) {
			$vr_gaming_customizer_notify_vr_gaming_recommended_actions = $this->vr_gaming_recommended_actions;
		}

		$vr_gaming_install_button_label    = isset( $this->config['vr_gaming_install_button_label'] ) ? $this->config['vr_gaming_install_button_label'] : '';
		$vr_gaming_activate_button_label   = isset( $this->config['vr_gaming_activate_button_label'] ) ? $this->config['vr_gaming_activate_button_label'] : '';
		$vr_gaming_deactivate_button_label = isset( $this->config['vr_gaming_deactivate_button_label'] ) ? $this->config['vr_gaming_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'vr_gaming_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'vr_gaming_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'vr_gaming_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'vr_gaming_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function vr_gaming_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'vr-gaming-customizer-notify-css', get_template_directory_uri() . '/core/includes/customizer-notice/css/vr-gaming-customizer-notify.css', array());

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'vr-gaming-customizer-notify-js', get_template_directory_uri() . '/core/includes/customizer-notice/js/vr-gaming-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'vr-gaming-customizer-notify-js', 'vrgamingCustomizercompanionObject', array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'vr-gaming' ),
			)
		);

	}

	
	public function vr_gaming_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/core/includes/customizer-notice/vr-gaming-customizer-notify-section.php';

		$wp_customize->register_section_type( 'VR_Gaming_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new VR_Gaming_Customizer_Notify_Section(
				$wp_customize,
				'vr-gaming-customizer-notify-section',
				array(
					'title'          => $this->vr_gaming_recommended_actions_title,
					'plugin_text'    => $this->vr_gaming_recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function vr_gaming_customizer_notify_dismiss_recommended_action_callback() {

		global $vr_gaming_customizer_notify_vr_gaming_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */ 

		if ( ! empty( $action_id ) ) {
			
			if ( get_option( 'vr_gaming_customizer_notify_show' ) ) {

				$vr_gaming_customizer_notify_show_vr_gaming_recommended_actions = get_option( 'vr_gaming_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$vr_gaming_customizer_notify_show_vr_gaming_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$vr_gaming_customizer_notify_show_vr_gaming_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'vr_gaming_customizer_notify_show', $vr_gaming_customizer_notify_show_vr_gaming_recommended_actions );

				
			} else {
				$vr_gaming_customizer_notify_show_vr_gaming_recommended_actions = array();
				if ( ! empty( $vr_gaming_customizer_notify_vr_gaming_recommended_actions ) ) {
					foreach ( $vr_gaming_customizer_notify_vr_gaming_recommended_actions as $vr_gaming_lite_customizer_notify_recommended_action ) {
						if ( $vr_gaming_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$vr_gaming_customizer_notify_show_vr_gaming_recommended_actions[ $vr_gaming_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$vr_gaming_customizer_notify_show_vr_gaming_recommended_actions[ $vr_gaming_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					update_option( 'vr_gaming_customizer_notify_show', $vr_gaming_customizer_notify_show_vr_gaming_recommended_actions );
				}
			}
		}
		die(); 
	}

	
	public function vr_gaming_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) {

			$vr_gaming_lite_customizer_notify_show_recommended_plugins = get_option( 'vr_gaming_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$vr_gaming_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$vr_gaming_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'vr_gaming_customizer_notify_show_recommended_plugins', $vr_gaming_lite_customizer_notify_show_recommended_plugins );
		}
		die(); 
	}

}
