<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'AGROLAND_DIR_URI' ) ) {
    define('AGROLAND_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'AGROLAND_DIR_ASSIST_URI' ) ) {
    define( 'AGROLAND_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'AGROLAND_DIR_CSS_URI' ) ) {
    define( 'AGROLAND_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Skin Css File
if ( ! defined( 'AGROLAND_DIR_SKIN_CSS_URI' ) ) {
    define( 'AGROLAND_DIR_SKIN_CSS_URI', get_theme_file_uri('/assets/css/skins/') );
}


// Js File URI
if (!defined('AGROLAND_DIR_JS_URI')) {
    define('AGROLAND_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// External PLugin File URI
if (!defined('AGROLAND_DIR_PLUGIN_URI')) {
    define('AGROLAND_DIR_PLUGIN_URI', get_theme_file_uri( '/assets/plugins/'));
}

// Base Directory
if (!defined('AGROLAND_DIR_PATH')) {
    define('AGROLAND_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('AGROLAND_DIR_PATH_INC')) {
    define('AGROLAND_DIR_PATH_INC', AGROLAND_DIR_PATH . 'inc/');
}

//QUANTO framework Folder Directory
if (!defined('AGROLAND_DIR_PATH_FRAM')) {
    define('AGROLAND_DIR_PATH_FRAM', AGROLAND_DIR_PATH_INC . 'agroland-framework/');
}

//Classes Folder Directory
if (!defined('AGROLAND_DIR_PATH_CLASSES')) {
    define('AGROLAND_DIR_PATH_CLASSES', AGROLAND_DIR_PATH_INC . 'classes/');
}

//Hooks Folder Directory
if (!defined('AGROLAND_DIR_PATH_HOOKS')) {
    define('AGROLAND_DIR_PATH_HOOKS', AGROLAND_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'AGROLAND_DEMO_DIR_PATH' ) ){
    define( 'AGROLAND_DEMO_DIR_PATH', AGROLAND_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'AGROLAND_DEMO_DIR_URI' ) ){
    define( 'AGROLAND_DEMO_DIR_URI', AGROLAND_DIR_URI.'inc/demo-data/' );
}