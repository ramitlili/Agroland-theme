<?php
/**
 * Class KS_FontAwesome_IconPicker
 */
class KS_FontAwesome_IconPicker {

    /**
     * Current version number
     */
    const VERSION = '1.0.0';

    /**
     * Initialize the plugin by hooking into CMB2
     */
    public function __construct() {
        add_action( 'cmb2_render_fontawesome_icon', array( $this, 'render' ), 10, 5 );
        add_action( 'cmb2_sanitize_fontawesome_icon', array( $this, 'sanitize' ), 10, 2 );
    }

    /**
     * Add a CMB custom field to allow for the selection FontAwesome Icon
     */
    public function render( $field, $escaped_value, $object_id, $object_type, $field_type ) {
        $this->setup_admin_scripts();

    	echo $field_type->input( array( 'type' => 'text', 'class' => 'fontawesome-icon-select regular-text' ) );
    }

    /**
     * Sanitize icon class name
     */
   public function sanitize( $sanitized_val, $val ) {
        if ( ! empty( $val ) ) {
            return  sanitize_html_class( $val );
        }
        return $sanitized_val;
    }

    /**
     * Enqueue admin scripts for our font-awesome picker field type
     */
    protected function setup_admin_scripts() {
        $dir = trailingslashit( dirname( __FILE__ ) );

        if ( 'WIN' === strtoupper( substr( PHP_OS, 0, 3 ) ) ) {
            // Windows
            $content_dir = str_replace( '/', DIRECTORY_SEPARATOR, WP_CONTENT_DIR );
            $content_url = str_replace( $content_dir, WP_CONTENT_URL, $dir );
            $url = str_replace( DIRECTORY_SEPARATOR, '/', $content_url );
        }
        else {
            $url = str_replace(
                array( WP_CONTENT_DIR, WP_PLUGIN_DIR ),
                array( WP_CONTENT_URL, WP_PLUGIN_URL ),
                $dir
            );
        }

        $url = set_url_scheme( $url );

        $requirements = array(
            'jquery',
        );
    }
}
new KS_FontAwesome_IconPicker();
