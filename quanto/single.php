<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */
 
    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    //header
    get_header();

    /**
    * 
    * Hook for Blog Details Wrapper
    *
    * Hook agroland_blog_details_wrapper_start
    *
    * @Hooked agroland_blog_details_wrapper_start_cb 10
    *  
    */
    do_action( 'agroland_blog_details_wrapper_start' );
    
    /**
    * 
    * Hook for Blog Details Column Start
    *
    * Hook agroland_blog_details_col_start
    *
    * @Hooked agroland_blog_details_col_start_cb 10
    *  
    */
    do_action( 'agroland_blog_details_col_start' );

    while( have_posts( ) ) :
        the_post();
        
        get_template_part( 'templates/content-single');
        
    endwhile;
    /**
    * 
    * Hook for Blog Details Column End
    *
    * Hook agroland_blog_details_col_end
    *
    * @Hooked agroland_blog_details_col_end_cb 10
    *  
    */
    do_action( 'agroland_blog_details_col_end' );

    /**
    * 
    * Hook for Blog Details Sidebar
    *
    * Hook agroland_blog_details_sidebar
    *
    * @Hooked agroland_blog_details_sidebar_cb 10
    *  
    */
    do_action( 'agroland_blog_details_sidebar' );
    
    /**
    * 
    * Hook for Blog Details Wrapper End
    *
    * Hook agroland_blog_details_wrapper_end
    *
    * @Hooked agroland_blog_details_wrapper_end_cb 10
    *  
    */
    do_action( 'agroland_blog_details_wrapper_end' );
    
    /**
    *
    * Hook for Blog Details Related Post
    *
    * Hook agroland_blog_details_related_post
    *
    * @Hooked agroland_blog_details_related_post_cb 10
    *
    */
    do_action( 'agroland_blog_details_related_post' );

    //footer
    get_footer();