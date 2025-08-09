<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

// Block direct access
if (!defined('ABSPATH')) {
    exit;
}

if ( ! is_active_sidebar( 'agroland-page-sidebar' ) ) {
    return;
}
?>

<div class="col-lg-4">
    <div class="page-sidebar">
    <?php 
        dynamic_sidebar( 'agroland-page-sidebar' );
    ?>               
    </div>
</div>