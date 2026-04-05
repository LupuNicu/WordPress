<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Vr_Gaming_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/core/includes/upgrade-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Vr_Gaming_Customize_Section_Pro' );

		// Add the PRO Upgrade section.
		$manager->add_section(
		    new Vr_Gaming_Customize_Section_Pro(
		        $manager,
		        'vr_gaming_upgrade_pro',
		        array(
		            'title'         => esc_html__( 'Vr Gaming PRO', 'vr-gaming' ),
		            'pro_text'      => esc_html__( 'Vr Gaming PRO', 'vr-gaming' ),
		            'pro_url'       => esc_url( VR_GAMING_BUY_NOW ),
		            'demo_text'     => esc_html__( 'Demo', 'vr-gaming' ),
		            'demo_url'      => esc_url( VR_GAMING_DEMO_PRO ),
		            'support_text'  => esc_html__( 'Support', 'vr-gaming' ),
		            'support_url'   => esc_url( VR_GAMING_SUPPORT_FREE ),
		            'bundle_text'   => esc_html__( 'Get All Themes', 'vr-gaming' ),
		            'bundle_url'    => esc_url( VR_GAMING_THEME_BUNDLE ),
		            'lite_doc_text' => esc_html__( 'Lite Doc', 'vr-gaming' ),
		            'lite_doc_url'  => esc_url( VR_GAMING_DOCS_FREE ),
		            'review_text'   => esc_html__( 'Review', 'vr-gaming' ),
		            'review_url'    => esc_url( VR_GAMING_REVIEW_FREE ),
		            'priority'      => 1,
		        )
		    )
		);

	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script(
			'vr-gaming-customize-controls',
			trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js',
			array( 'customize-controls' )
		);

		wp_enqueue_style(
			'vr-gaming-customize-controls',
			trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css'
		);
	}
}

// Doing this customizer thang!
Vr_Gaming_Customize::get_instance();
