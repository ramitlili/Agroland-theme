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
    *
    * Hook for Footer Content
    *
    * Hook agroland_footer_content
    *
    * @Hooked agroland_footer_content_cb 10
    *
    */
    do_action( 'agroland_footer_content' );



    do_action( 'agroland_after_content' );
    

    if( !is_404( ) ) {
        /**
        *
        * Hook for Back to Top Button
        *
        * Hook agroland_back_to_top
        *
        * @Hooked agroland_back_to_top_cb 10
        *
        */
        do_action( 'agroland_back_to_top' );
    }

    wp_footer();
    ?>
</body>
</html>