<?php
namespace MasAnimation;

if ( ! defined( 'ABSPATH' ) ) exit;

final class Base_Ex {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'init', [ $this ,'mas_ex_load_textdomain' ] );

		// Register widget scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'widget_scripts' ] );

		// Register widget style
		add_action( 'wp_enqueue_scripts', [ $this, 'widget_styles' ] );

		// include all file
		$this->include_files();
	}

	/**
	 * Widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {

		// lib js include
		foreach ( self::get_library_scripts() as $key => $script) {
			
			wp_register_script( $script['handler'], plugins_url( '/assets/lib/' . $script['src'], __FILE__ ), $script['dep'], $script['version'], $script['arg'] );

			wp_enqueue_script( $script['handler'] );
		
		}

		// widget js file include
		foreach ( self::get_widget_scripts() as $key => $script) {
			
			wp_register_script( $script['handler'], plugins_url( '/assets/js/' . $script['src'], __FILE__ ), $script['dep'], $script['version'], $script['arg'] );

			wp_enqueue_script( $script['handler'] );
			
			$data = apply_filters( 'mas-addons/js/data', [
				'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
				'_wpnonce'       => wp_create_nonce( 'mas-addons-frontend' ),
				'post_id'        => get_the_ID(),
				'smoothScroller' => json_decode( get_option( 'mas_smooth_scroller' ), true ) ?: [ 'enabled' => false ],
			]);
			
			error_log( 'MAS_ADDONS_JS Data: ' . print_r( $data, true ) );
			
			wp_localize_script( 'mas-animation', 'MAS_ADDONS_JS', $data );
			
		
		}
		
	}

	/**
	 * Function widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public static function widget_styles() {

		wp_enqueue_style( 'mas-animation-ex' );
		wp_enqueue_style( 'magnific-popup' );
		//widget style
		foreach ( self::get_widget_style() as $key => $style ) {
			
			wp_register_style( $style['handler'], plugins_url( '/assets/css/' . $style['src'], __FILE__ ), $style['dep'], $style['version'], $style['media'] );

			wp_enqueue_style( 'handler' );
		}

	}

	/**
	 * Function lib_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function get_library_scripts() {
		$script = [
			'gsap'            => [
				'handler' => 'gsap',
				'src'     => 'gsap.min.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'scroll-smoother' => [
				'handler' => 'scrollSmoother',
				'src'     => 'ScrollSmoother.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'scroll-to' => [
				'handler' => 'scrollTo',
				'src'     => 'ScrollToPlugin.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'scroll-trigger'  => [
				'handler' => 'scrollTrigger',
				'src'     => 'ScrollTrigger.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'split-text'      => [
				'handler' => 'split-text',
				'src'     => 'SplitText.min.js',
				'dep'     => [ 'gsap' ],
				'version' => false,
				'arg'     => true,
			],
			'magnific-popup'  => [
				'handler' => 'magnific-popup',
				'src'     => 'jquery.magnific-popup.min.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
			'mixitup'         => [
				'handler' => 'mixitup',
				'src'     => 'mixitup.min.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			],
		];

		return $script;
	}

		/**
	 * Function widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function get_widget_scripts() {
		$widgetjs = [
			'mas-animation' => [
				'handler' => 'mas-animation',
				'src'     => 'mas-animation.js',
				'dep'     => [],
				'version' => false,
				'arg'     => true,
			]
		];

		return $widgetjs;
	}

	/**
	 * Function widget_style
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function get_widget_style() {
		$style = [
			'mas-animation-ex'    => [
				'handler' => 'mas-animation-ex',
				'src'     => 'mas-animation.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			],
			'magnific-popup'   => [
				'handler' => 'magnific-popup',
				'src'     => 'magnific-popup.css',
				'dep'     => [],
				'version' => false,
				'media'   => 'all',
			]
		];

		return $style;
	}

	/**
	 * Include Plugin files
	 *
	 * @access private
	 */
	private function include_files() {
		
		// require_once MAS_ADDONS_EX_PATH . 'inc/hook.php';
		require_once MAS_EX_PLUGIN_INC . 'ajax-handler.php';
		require_once MAS_EX_PLUGIN_INC . 'hook.php';
		require_once MAS_EX_PLUGIN_INC . 'helper.php';

		//extensions
		$this->register_extensions();
	}

	/**
	 *
	 * Register new Elementor Extensions.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_extensions() {

		require_once MAS_EX_PLUGIN_INC . 'extensions/hover-effect-image.php';
		require_once MAS_EX_PLUGIN_INC . 'extensions/cursor-hover-effect.php';
		require_once MAS_EX_PLUGIN_INC . 'extensions/animation-effects.php';
		require_once MAS_EX_PLUGIN_INC . 'extensions/popup-effect.php';
		require_once MAS_EX_PLUGIN_INC . 'extensions/image-animation-effects.php';
		require_once MAS_EX_PLUGIN_INC . 'extensions/text-animation-effects.php';
		require_once MAS_EX_PLUGIN_INC . 'extensions/tilt-effect.php';
	}


	/**
	 * Load the text domain for the plugin.
	 *
	 * This function ensures that the translation files for the plugin are loaded correctly.
	 * It uses the 'load_plugin_textdomain' function to load .mo and .po files located in the 'languages' folder
	 * relative to the plugin directory.
	 *
	 * @return void
	 */

	public function mas_ex_load_textdomain() {
		load_plugin_textdomain( 'mas-animation', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// translated this plugin

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		
	}

	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'mas-animation' ),
			'<strong>' . esc_html__( 'Mas Animation', 'mas-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mas-animation' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mas-animation' ),
			'<strong>' . esc_html__( 'Mas Animation', 'mas-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'mas-animation' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'mas-animation' ),
			'<strong>' . esc_html__( 'Mas', 'mas-animation' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'mas-animation' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

Base_Ex::instance();