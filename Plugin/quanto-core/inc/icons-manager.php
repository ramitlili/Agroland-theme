<?php

defined( 'ABSPATH' ) || die();

class QuantoIcons_Manager {
    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_mas_icons_tab' ] );
    }
    public static function add_mas_icons_tab( $tabs ) {

        $tabs['remix-icons'] = [
            'name' => 'remix-icons',
            'label' => __( 'Remix Icons', 'quanto' ),
            'url' => QUANTO_PLUGDIRURI . 'assets/fonts/remix-icon/remixicon.min.css',
            'enqueue' => [ QUANTO_PLUGDIRURI . 'assets/fonts/remix-icon/remixicon.min.css' ],
            'prefix' => 'ri-',
            'displayPrefix' => 'remixicon',
            'labelIcon' => 'remixicon ri-remixicon-fill exad-font-manager',
            'ver' => '1.1',
            'fetchJson' => QUANTO_PLUGDIRURI . 'assets/fonts/remix-icon/remix-icon.js?v=' . '1.1',
            'native' => false,
        ];
        return $tabs;
    }
}
QuantoIcons_Manager::init();
