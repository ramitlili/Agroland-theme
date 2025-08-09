<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : quanto
 * @version   : 1.0
 * @Author    : Mirrortheme
 * @Author URI: https://mirrortheme.com/
 */
 
// demo import file
function quanto_import_files() {

    return array(
        array(
            'import_file_name'             => esc_html__('Agroland Demo','quanto'),
            'local_import_file'            =>  QUANTO_DEMO_DIR_PATH  . 'quanto-demo.xml',
            'local_import_widget_file'     =>  QUANTO_DEMO_DIR_PATH  . 'widgets.wie',
            'local_import_customizer_file' =>  QUANTO_DEMO_DIR_PATH  . 'customizer.dat',
            'local_import_redux'           => array(
                array(
                    'file_path'   =>  QUANTO_DEMO_DIR_PATH . 'redux_options_demo.json',
                    'option_name' => 'quanto_opt',
                ),
            ),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'quanto_import_files' );

// demo import setup
function quanto_after_import_setup() {
	// Assign menus to their locations.
	$main_menu   = get_term_by( 'name', 'Header Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu'    => $main_menu->term_id,
			'mobile-menu'     =>  $main_menu ->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id 	= get_page_by_title( esc_html__( 'Farm Home', 'quanto' ) );
	$blog_page_id  	= get_page_by_title( 'Blog Grid' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );


	// Define the old and new URLs
    $old_url = 'https://wp.framerpeak.com/quanto/'; // Replace with your old/static URL
    $new_url = esc_url( home_url( '/' ) ); // get current home url
    
    if (class_exists('\Elementor\Utils')) {
        \Elementor\Utils::replace_urls($old_url, $new_url);
    }

	global $wpdb;
    $active_kit_id = $wpdb->get_var(
        "SELECT ID
         FROM {$wpdb->posts}
         WHERE post_type = 'elementor_library'
           AND post_status = 'publish'
           AND post_title = 'Default Kit'
         ORDER BY ID DESC
         LIMIT 1"
    );
    // Update the active kit option
    if ($active_kit_id) {
        update_option('elementor_active_kit', $active_kit_id);
    }
    
}
add_action( 'pt-ocdi/after_import', 'quanto_after_import_setup' );


//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function quanto_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Agroland Demo Import' , 'quanto' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'quanto' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'quanto-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'quanto_import_plugin_page_setup' );
 
// Enqueue scripts
function quanto_demo_import_custom_scripts(){
	if( isset( $_GET['page'] ) && $_GET['page'] == 'quanto-demo-import' ){
		// style
		wp_enqueue_style( 'quanto-demo-import', QUANTO_DEMO_DIR_URI.'css/quanto.demo.import.css', array(), '1.0', false );
	}
}
add_action( 'admin_enqueue_scripts', 'quanto_demo_import_custom_scripts' );