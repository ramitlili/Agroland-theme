<?php
/**
 * Plugin Name: Quanto Core
 * Description: This is a helper plugin of quanto theme
 * Version:     1.0.1
 * Author:      Mirror
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: quanto
 */
 // Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit();
}

//Defined Constants
if (!defined('QUANTO_BADGE')) {
    define('QUANTO_BADGE', '<span class="quanto-badge"></span>');
}


// Define Constant
define( 'QUANTO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'QUANTO_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'QUANTO_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );
define( 'QUANTO_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );
define( 'QUANTO_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
define( 'QUANTO_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );
define( 'QUANTO_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'quanto-template/' );

// load textdomain

add_action('init', function () {
    load_plugin_textdomain('quanto', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

//include file.
require_once QUANTO_PLUGIN_INC_PATH .'quantocore-functions.php';
require_once QUANTO_PLUGIN_INC_PATH .'custom-post-types.php';
require_once QUANTO_PLUGIN_INC_PATH .'icons-manager.php';
require_once QUANTO_PLUGIN_INC_PATH .'MCAPI.class.php';
require_once QUANTO_PLUGIN_INC_PATH .'quantoajax.php';
require_once QUANTO_PLUGIN_INC_PATH .'builder/builder.php';
require_once QUANTO_PLUGIN_INC_PATH .'animejs/elementor-animejs.php';
require_once QUANTO_PLUGIN_INC_PATH .'sticky-header.php';

require_once QUANTO_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget
require_once QUANTO_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'social-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'about-us-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'about-me-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'newsletter-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'gallery-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'event-widget.php';
require_once QUANTO_PLUGIN_WIDGET_PATH . 'video-box-widget.php';


// Custom CSS & Positioning
require_once QUANTO_PLUGIN_INC_PATH .'modules/custom-css/custom-css.php';
require_once QUANTO_PLUGIN_INC_PATH .'modules/custom-position/custom-position.php';

// Demo Data
require_once QUANTO_PLUGIN_INC_PATH . 'demo-data/demo-import.php';

//Demo Data Folder Directory Path
if( !defined( 'QUANTO_DEMO_DIR_PATH' ) ){
    define( 'QUANTO_DEMO_DIR_PATH', QUANTO_PLUGIN_INC_PATH.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'QUANTO_DEMO_DIR_URI' ) ){
    define( 'QUANTO_DEMO_DIR_URI', QUANTO_PLUGDIRURI.'inc/demo-data/' );
}

//addons
require_once QUANTO_ADDONS . 'addons.php';

