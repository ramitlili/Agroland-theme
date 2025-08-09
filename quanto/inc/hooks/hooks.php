<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit();
	}

	/**
	* Hook for cursor
	*/
	add_action( 'agroland_cursor_wrap', 'agroland_cursor_wrap_cb', 10 );

	/**
	* Hook for preloader
	*/
	add_action( 'agroland_preloader_wrap', 'agroland_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'agroland_main_wrapper_start', 'agroland_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'agroland_header', 'agroland_header_cb', 10 );

	/**
	* Hook for Breadcrumb
	*/
	add_action( 'agroland_breadcrumb', 'agroland_breadcrumb_cb', 10 );

	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'agroland_blog_section_title', 'agroland_blog_section_title_cb', 10 );

	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'agroland_blog_start_wrap', 'agroland_blog_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'agroland_blog_col_start_wrap', 'agroland_blog_col_start_wrap_cb', 10 );

	/**
	* Hook for Service Column Start Wrapper
	*/
    add_action( 'agroland_service_col_start_wrap', 'agroland_service_col_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'agroland_blog_col_end_wrap', 'agroland_blog_col_end_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'agroland_blog_end_wrap', 'agroland_blog_end_wrap_cb', 10 );

	/**
	* Hook for Blog Pagination
	*/
    add_action( 'agroland_blog_pagination', 'agroland_blog_pagination_cb', 10 );

    /**
	* Hook for Blog Content
	*/
	add_action( 'agroland_blog_content', 'agroland_blog_content_cb', 10 );

    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'agroland_blog_sidebar', 'agroland_blog_sidebar_cb', 10 );


    /**
	* Hook for Service Sidebar
	*/
	add_action( 'agroland_service_sidebar', 'agroland_service_sidebar_cb', 10 );

    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'agroland_blog_details_sidebar', 'agroland_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'agroland_blog_details_wrapper_start', 'agroland_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Post Meta
	*/
	add_action( 'agroland_blog_post_meta', 'agroland_blog_post_meta_cb', 10 );


	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'agroland_blog_details_post_meta', 'agroland_blog_details_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'agroland_blog_details_share_options', 'agroland_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'agroland_blog_details_tags_and_categories', 'agroland_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Deatils Related Post
	*/
	add_action( 'agroland_blog_details_related_post', 'agroland_blog_details_related_post_cb', 10 );

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'agroland_blog_details_comments', 'agroland_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('agroland_blog_details_col_start','agroland_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('agroland_blog_details_col_end','agroland_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('agroland_blog_details_wrapper_end','agroland_blog_details_wrapper_end_cb');

	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('agroland_blog_post_thumb','agroland_blog_post_thumb_cb');

	/**
	* Hook for Blog Post Content
	*/
	add_action('agroland_blog_post_content','agroland_blog_post_content_cb');


	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('agroland_blog_postexcerpt_read_content','agroland_blog_postexcerpt_read_content_cb');

	/**
	* Hook for footer content
	*/
	add_action( 'agroland_footer_content', 'agroland_footer_content_cb', 10 );

	/**
	* Hook for main wrapper end
	*/
	add_action( 'agroland_main_wrapper_end', 'agroland_main_wrapper_end_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'agroland_page_start_wrap', 'agroland_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'agroland_page_end_wrap', 'agroland_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'agroland_page_col_start_wrap', 'agroland_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'agroland_page_col_end_wrap', 'agroland_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'agroland_page_sidebar', 'agroland_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'agroland_page_content', 'agroland_page_content_cb', 10 );