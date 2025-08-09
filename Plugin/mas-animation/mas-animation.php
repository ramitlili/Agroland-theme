<?php
/**
 * Plugin Name: Mas Animation
 * Description: Mas Animation plugin for "Animation Addon for Elementor".
 * Plugin URI: https://wp.framerpeak.com/
 * Version:     1.0.1
 * Author:      Mirror
 * Author URI:  https://wp.framerpeak.com/
 * Text Domain: mas-animation
 * Domain Path: mas-animation
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
* Plugin Version.
*/

if ( ! defined( 'MAS_EX_ADDONS_VERSION' ) ) {
	define( 'MAS_EX_ADDONS_VERSION', '1.0.0' );
}

/**
* Plugin File Ref.
*/
if ( ! defined ( 'MAS_EX_PLUGIN_PATH' ) ) {
    define( 'MAS_EX_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * Plugin In file Ref..
 */
if ( ! defined ( 'MAS_EX_PLUGIN_INC' ) ) {
    define( 'MAS_EX_PLUGIN_INC', plugin_dir_path( __FILE__ ) . 'inc/' );
}
/**
 * Pluing url Ref..
 */
if ( ! defined ( 'MAS_EX_PLUGDIRURI' ) ) {
   define( 'MAS_EX_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
}
/**
 * Plugin assets file Ref..
 */

if ( ! defined ( 'MAS_EX_ASSETS_PUBLIC' ) ) {
    define('MAS_EX_ASSETS_PUBLIC', plugins_url('assets/', __FILE__));
}

// include base file   
require MAS_EX_PLUGIN_PATH . 'base.php';
