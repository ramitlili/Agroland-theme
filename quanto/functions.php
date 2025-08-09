<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/agroland-constants.php';

//theme setup
require_once AGROLAND_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once AGROLAND_DIR_PATH_INC . 'essential-scripts.php';

//template helper
require_once AGROLAND_DIR_PATH_INC . 'template-helper.php';

// plugin activation
require_once AGROLAND_DIR_PATH_INC . 'agroland-framework/plugins-activation/agroland-active-plugins.php';

// meta options
require_once AGROLAND_DIR_PATH_INC . 'agroland-framework/agroland-meta/agroland-config.php';

// page breadcrumbs
require_once AGROLAND_DIR_PATH_INC . 'agroland-breadcrumbs.php';

// sidebar register
require_once AGROLAND_DIR_PATH_INC . 'agroland-widgets-reg.php';

//essential functions
require_once AGROLAND_DIR_PATH_INC . 'agroland-functions.php';

// theme dynamic css
require_once AGROLAND_DIR_PATH_INC . 'agroland-commoncss.php';

// helper function
require_once AGROLAND_DIR_PATH_INC . 'wp-html-helper.php';

// pagination
require_once AGROLAND_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// quanto options
function agroland_setup_ab() { 
    require_once AGROLAND_DIR_PATH_INC . 'agroland-framework/agroland-options/agroland-options.php';
}
add_action( 'after_setup_theme', 'agroland_setup_ab', 20 );

// hooks
require_once AGROLAND_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once AGROLAND_DIR_PATH_HOOKS . 'hooks-functions.php';

