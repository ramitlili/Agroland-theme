<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Quanto Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Agroland_Extension {

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

		

		//Defined Constants
		if (!defined('AGROLAND_ADDONS_BADGE')) {
            define('AGROLAND_ADDONS_BADGE', '<span class="agroland-badge"></span>');
        }
		add_action( 'plugins_loaded', [ $this, 'init' ] );

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

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

        // Register widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);


		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts'], 100 );

        // category register
		add_action( 'elementor/elements/categories_registered',[ $this, 'agroland_elementor_widget_categories' ] );

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
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'quanto' ),
			'<strong>' . esc_html__( 'Quanto Core', 'quanto' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'quanto' ) . '</strong>'
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'quanto' ),
			'<strong>' . esc_html__( 'Quanto Core', 'quanto' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'quanto' ) . '</strong>',
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
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'quanto' ),
			'<strong>' . esc_html__( 'Quanto Core', 'quanto' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'quanto' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		// All Header Widget Start
		require_once( AGROLAND_ADDONS . '/header/menu.php' );
		require_once( AGROLAND_ADDONS . '/header/logo.php' );
		// require_once( AGROLAND_ADDONS . '/header/search.php' );
		require_once( AGROLAND_ADDONS . '/header/offcanvas.php' );
		require_once( AGROLAND_ADDONS . '/header/header-sidebar.php' );


		// All Dynamic Widgets
		require_once( AGROLAND_ADDONS . '/dynamic-widgets/feature-image.php' );
		require_once( AGROLAND_ADDONS . '/dynamic-widgets/heading.php' );
		require_once( AGROLAND_ADDONS . '/dynamic-widgets/post-navigation.php' );


		// All Custom Post Widget
		require_once( AGROLAND_ADDONS . '/widgets/service.php' );
		require_once( AGROLAND_ADDONS . '/widgets/team.php' );
		// require_once( AGROLAND_ADDONS . '/widgets/project.php' );

	
 
		// All Widget Start
		require_once( AGROLAND_ADDONS . '/widgets/button.php' );
		require_once( AGROLAND_ADDONS . '/widgets/award.php' );
		require_once( AGROLAND_ADDONS . '/widgets/pricing.php' );
		require_once( AGROLAND_ADDONS . '/widgets/testimonial.php' );
		require_once( AGROLAND_ADDONS . '/widgets/video-box.php' );
		require_once( AGROLAND_ADDONS . '/widgets/process.php' );
		require_once( AGROLAND_ADDONS . '/widgets/header-status.php' );
		require_once( AGROLAND_ADDONS . '/widgets/text-slider.php' );
		require_once( AGROLAND_ADDONS . '/widgets/list-icon.php' );
		require_once( AGROLAND_ADDONS . '/widgets/hero.php' );
		require_once( AGROLAND_ADDONS . '/widgets/animation-title.php' );
		require_once( AGROLAND_ADDONS . '/widgets/counter.php' );
		require_once( AGROLAND_ADDONS . '/widgets/animation-image.php' );
		require_once( AGROLAND_ADDONS . '/widgets/project-slider.php' );
		require_once( AGROLAND_ADDONS . '/widgets/project.php' );
		require_once( AGROLAND_ADDONS . '/widgets/faqs.php' );
		require_once( AGROLAND_ADDONS . '/widgets/counter-two.php' );
		require_once( AGROLAND_ADDONS . '/widgets/text-slider-two.php' );
		require_once( AGROLAND_ADDONS . '/widgets/scroll-down.php' );
		require_once( AGROLAND_ADDONS . '/widgets/career.php' );

		// All blog widget 
		require_once( AGROLAND_ADDONS . '/widgets/blog-post.php' );
	}


	// editor script 
    public function editor_scripts() {
		wp_enqueue_script(
            'agroland-addons-editor',
            AGROLAND_PLUGDIRURI . 'assets/js/editor.js',
            array('jquery'),
            false,
            true
		);
	}

	// front-end script
    public function widget_scripts() {

        wp_enqueue_script(
            'agroland-addon-script',
            AGROLAND_PLUGDIRURI . 'assets/js/agroland-addon.js',
            array('jquery'),
            time(),
            true 
		);

        wp_enqueue_script(
            'agroland-slick-animation',
            AGROLAND_PLUGDIRURI . 'assets/js/slick-animation.js',
            array('jquery'),
            time(),
            true 
		);

        wp_enqueue_script(
            'agroland-hello-animai',
            AGROLAND_PLUGDIRURI . 'assets/js/hello-animai.js',
            array('jquery'),
            time(),
            true 
		);

        //  style 
		wp_enqueue_style(
            'agroland-helping-style',
            AGROLAND_PLUGDIRURI . 'assets/css/helping.css',
			microtime()
		);
        //  style 
		wp_enqueue_style(
            'agroland-animate',
            AGROLAND_PLUGDIRURI . 'assets/css/animate.css',
			microtime()
		);

		wp_enqueue_style(
            'agroland-widget-style',
            AGROLAND_PLUGDIRURI . 'assets/css/style.css',
			microtime()
		);

		wp_enqueue_style(
            'agroland-mehdi-css',
            AGROLAND_PLUGDIRURI . 'assets/css/mehedi.css',
			microtime()
		);
	}
    function agroland_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'quanto',
            [
                'title' => __( 'Quanto', 'quanto' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
        $elements_manager->add_category(
            'agroland_footer_elements',
            [
                'title' => __( 'Quanto Footer Elements', 'quanto' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);
		$elements_manager->add_category(
            'agroland_header_elements',
            [
                'title' => __( 'Quanto Header Elements', 'quanto' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

	}
}
Agroland_Extension::instance();