<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

// Block direct access
if ( ! defined('ABSPATH') ) {
    exit;
}
    // Header
    get_header();

    /**
    *
    * Hook for Blog Start Wrapper
    *
    * Hook agroland_blog_start_wrap
    *
    * @Hooked agroland_blog_start_wrap_cb 10
    *
    */
    do_action( 'agroland_blog_start_wrap' );

    /**
    *
    * Hook for Blog Column Start Wrapper
    *
    * Hook agroland_blog_col_start_wrap
    *
    * @Hooked agroland_blog_col_start_wrap_cb 10
    *
    */
    do_action( 'agroland_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook agroland_blog_content
    *
    * @Hooked agroland_blog_content_cb 10
    *  
    */
    do_action( 'agroland_blog_content' );

    /**
    *
    * Hook for Blog Pagination
    *
    * Hook agroland_blog_pagination
    *
    * @Hooked agroland_blog_pagination_cb 10
    *
    */
    do_action( 'agroland_blog_pagination' );

    /**
    *
    * Hook for Blog Column End Wrapper
    *
    * Hook agroland_blog_col_end_wrap
    *
    * @Hooked agroland_blog_col_end_wrap_cb 10
    *
    */
    do_action( 'agroland_blog_col_end_wrap' );

    /**
    *
    * Hook for Blog Sidebar
    *
    * Hook agroland_blog_sidebar
    *
    * @Hooked agroland_blog_sidebar_cb 10
    *
    */
    do_action( 'agroland_blog_sidebar' );

    /**
    *
    * Hook for Blog End Wrapper
    *
    * Hook agroland_blog_end_wrap
    *
    * @Hooked agroland_blog_end_wrap_cb 10
    *
    */
    do_action( 'agroland_blog_end_wrap' );

    //footer
    get_footer();