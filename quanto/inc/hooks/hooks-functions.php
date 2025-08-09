<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

    // Prevent direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }


    // cursor hook function
    if( ! function_exists( 'quanto_cursor_wrap_cb' ) ) {
        function quanto_cursor_wrap_cb() {
            $cursor_display =  quanto_opt('quanto_display_cursor');

            if( class_exists('ReduxFramework') ){
                if( $cursor_display ){
                    echo '<div class="cursor d-none d-lg-block">';
                    echo '</div>';
                }
            }
        }
    };

    
    // preloader hook function
    if( ! function_exists( 'quanto_preloader_wrap_cb' ) ) {
        function quanto_preloader_wrap_cb() {
            $preloader_display =  quanto_opt('quanto_display_preloader');
            $preloader_image   = quanto_opt('preloader_image');

            if( class_exists('ReduxFramework') ){
                if( $preloader_display ){
                    echo '<div class="preloader">';
                        echo '<div class="spinner-wrap">';
                            echo '<div class="preloader-logo">';
                                if ( ! empty( $preloader_image['url'] ) ) {
                                    echo '<img src="' . esc_url( $preloader_image['url'] ) . '" alt="' . esc_attr__('Preloader', 'quanto') . '">';
                                }  
                            echo '</div>';
                            echo '<div class="spinner"></div>';
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                echo '<div class="preloader">';
                    echo '<div class="spinner-wrap">';
                        echo '<div class="preloader-logo">';
                        echo '</div>';
                        echo '<div class="spinner"></div>';
                    echo '</div>';
                echo '</div>';
            }
        }
    };

    // Header Hook function
    if( !function_exists('quanto_header_cb') ) {
        function quanto_header_cb( ) {
            get_template_part('templates/header');
        }
    } 

    // Breadcrumb Hook function
    if( !function_exists('quanto_breadcrumb_cb') ) {
        function quanto_breadcrumb_cb( ) {
            if ( class_exists('ReduxFramework') ) {
                $breadcrumb_switcher = quanto_opt('quanto_full_breadcrumb_switcher');
            } else {
                $breadcrumb_switcher = 1; // Default ON if Redux not present
            }

            if ( $breadcrumb_switcher == 1 ) {
                get_template_part('templates/header-menu-bottom');
            }
        }
    } 

    // Blog Start Wrapper Function
    if( !function_exists('quanto_blog_section_title_cb') ) {
        function quanto_blog_section_title_cb() {
            if( class_exists( 'ReduxFramework' ) ){
                $breadcrumb_switcher = quanto_opt('quanto_full_breadcrumb_switcher');
                $quanto_blog_section_custom_title_tag    = quanto_opt('quanto_blog_section_custom_title_tag');
            }else{
                $breadcrumb_switcher = 0; // Default Off if Redux not present
                $quanto_blog_section_custom_title_tag    = 'h1';
            }

            $quanto_blog_section_title_switcher = quanto_opt('quanto_blog_section_title_switcher');
            $quanto_blog_section_custom_title = quanto_opt('quanto_blog_section_custom_title');
            if( $quanto_blog_section_title_switcher == 1 ){
                echo '<section class="quanto-hero-blog-section overflow-hidden">';
                    echo '<div class="container custom-container">';
                        echo '<div class="row g-4">';
                            echo '<div class="col-lg-12 col-xxl-11">';
                                echo '<div class="quanto-hero-blog__content move-anim" data-delay="0.45">';
                                    echo quanto_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $quanto_blog_section_custom_title_tag ),
                                            "text"  => !empty( $quanto_blog_section_custom_title ) ? esc_html( $quanto_blog_section_custom_title) : esc_html__( 'Blog', 'quanto' ),
                                            'class' => 'title'
                                        )
                                    );
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
        }
    }

    // Blog Start Wrapper Function
    if( !function_exists('quanto_blog_start_wrap_cb') ) {
        function quanto_blog_start_wrap_cb() {
            echo '<section class="quanto-blog-section section-padding-top section-padding-bottom overflow-hidden">';
                echo '<div class="container custom-container">';
                    if( is_active_sidebar( 'quanto-blog-sidebar' ) ){
                        $quanto_gutter_class = 'gx-30';
                    }else{
                        $quanto_gutter_class = '';
                    }
                    echo '<div class="row '.esc_attr( $quanto_gutter_class ).'">';
        }
    }

    // Blog End Wrapper Function
    if( !function_exists('quanto_blog_end_wrap_cb') ) {
        function quanto_blog_end_wrap_cb() {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // Blog Column Start Wrapper Function
    if( !function_exists('quanto_blog_col_start_wrap_cb') ) {
        function quanto_blog_col_start_wrap_cb() {
            if( class_exists('ReduxFramework') ) {
                $quanto_blog_sidebar = quanto_opt('quanto_blog_sidebar');
                if( $quanto_blog_sidebar == '2' && is_active_sidebar('quanto-blog-sidebar') ) {
                    echo '<div class="col-lg-8 order-lg-last">';
                } elseif( $quanto_blog_sidebar == '3' && is_active_sidebar('quanto-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('quanto-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }
    // Blog Column End Wrapper Function
    if( !function_exists('quanto_blog_col_end_wrap_cb') ) {
        function quanto_blog_col_end_wrap_cb() {
            echo '</div>';
        }
    }

    // Blog Sidebar
    if( !function_exists('quanto_blog_sidebar_cb') ) {
        function quanto_blog_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_blog_sidebar = quanto_opt('quanto_blog_sidebar');
            } else {
                $quanto_blog_sidebar = 2;
            }
            if( $quanto_blog_sidebar != 1 && is_active_sidebar('quanto-blog-sidebar') ) {
                // Sidebar
                get_sidebar();
            }
        }
    }


    if( !function_exists('quanto_blog_details_sidebar_cb') ) {
        function quanto_blog_details_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_blog_single_sidebar = quanto_opt('quanto_blog_single_sidebar');
            } else {
                $quanto_blog_single_sidebar = 4;
            }
            if( $quanto_blog_single_sidebar != 1 ) {
                // Sidebar
                get_sidebar();
            }

        }
    }

    // Blog Pagination Function
    if( !function_exists('quanto_blog_pagination_cb') ) {
        function quanto_blog_pagination_cb( ) {
            get_template_part('templates/pagination');
        }
    }

    // Blog Content Function
    if( !function_exists('quanto_blog_content_cb') ) {
        function quanto_blog_content_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_blog_grid = quanto_opt('quanto_blog_grid');
            } else {
                $quanto_blog_grid = '1';
            }

            if( $quanto_blog_grid == '1' ) {
                $quanto_blog_grid_class = 'col-lg-12';
            } elseif( $quanto_blog_grid == '2' ) {
                $quanto_blog_grid_class = 'col-md-6';
            } else {
                $quanto_blog_grid_class = 'col-md-6 col-lg-4';
            }

            echo '<div class="row gx-4 gy-5">';
                if( have_posts() ) {
                    while( have_posts() ) {
                        the_post();
                        echo '<div class="'.esc_attr($quanto_blog_grid_class).'">';
                            if( class_exists( 'ReduxFramework' )){
                                $quanto_blog_style = quanto_opt('quanto_blog_style');

                                if('blog_style_one' == $quanto_blog_style ){
                                    echo '<div class="quanto-blog-box fade-anim" data-delay="0.30" data-direction="right">';
                                }elseif('blog_style_two' == $quanto_blog_style ){
                                    echo '<div class="quanto-blog-box style-2 fade-anim" data-delay="0.30" data-direction="right">';
                                }
                            }else{
                                echo '<div class="quanto-blog-box fade-anim" data-delay="0.30" data-direction="right">';
                            }
                                get_template_part('templates/content',get_post_format());
                            echo '</div>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                } else{
                    if( class_exists( 'ReduxFramework' )){
                        $quanto_blog_style = quanto_opt('quanto_blog_style');

                        if('blog_style_one' == $quanto_blog_style ){
                            echo '<div class="quanto-blog-box fade-anim" data-delay="0.30" data-direction="right">';
                        }elseif('blog_style_two' == $quanto_blog_style ){
                            echo '<div class="quanto-blog-box style-2 fade-anim" data-delay="0.30" data-direction="right">';
                        }
                    }else{
                        echo '<div class="quanto-blog-box fade-anim" data-delay="0.30" data-direction="right">';
                    }
                        get_template_part('templates/content','none');
                    echo '</div>';
                }
            echo '</div>';
        }
    }

    // footer content Function
    if( !function_exists('quanto_footer_content_cb') ) {
        function quanto_footer_content_cb( ) {

            if ( class_exists('ReduxFramework') && did_action( 'elementor/loaded' ) ) {
                if ( is_page() || is_page_template('template-builder.php') ) {
                    // Page-specific footer
                    $post_id = get_the_ID();
                    $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );
                    $page_settings_model = $page_settings_manager->get_model( $post_id );

                    $footer_settings = $page_settings_model->get_settings( 'quanto_footer_style' );
                    $footer_local = $page_settings_model->get_settings( 'quanto_footer_builder_option' );
                    $footer_enable_disable = $page_settings_model->get_settings( 'quanto_footer_choice' );

                    if ( $footer_enable_disable == 'yes' ) {
                        if ( $footer_settings == 'footer_builder' ) {
                            $quanto_local_footer = get_post( $footer_local );
                            echo '<footer>';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $quanto_local_footer->ID );
                            echo '</footer>';
                        } else {
                            $quanto_footer_builder_trigger = quanto_opt('quanto_footer_builder_trigger');
                            if ( $quanto_footer_builder_trigger == 'footer_builder' ) {
                                echo '<footer>';
                                $quanto_global_footer_select = get_post( quanto_opt( 'quanto_footer_builder_select' ) );
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $quanto_global_footer_select->ID );
                                echo '</footer>';
                            } else {
                                quanto_footer_global_option();
                            }
                        }
                    }

                } 
                // Archive, Blog, Search, Single post footer
                elseif ( is_archive() || is_home() || is_search() || ( is_single() && get_post_type() === 'post' ) ) {

                    $archive_footer_id = quanto_opt('quanto_archive_footer_select_options');

                    if ( ! empty( $archive_footer_id ) ) {
                        $footer_post = get_post( $archive_footer_id );
                        if ( $footer_post ) {
                            echo '<footer class="footer">';
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_post->ID );
                            echo '</footer>';
                        }
                    } else {
                        // fallback to global footer
                        $quanto_footer_builder_trigger = quanto_opt('quanto_footer_builder_trigger');
                        if ( $quanto_footer_builder_trigger == 'footer_builder' ) {
                            echo '<footer class="footer">';
                            $quanto_global_footer_select = get_post( quanto_opt( 'quanto_footer_builder_select' ) );
                            echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $quanto_global_footer_select->ID );
                            echo '</footer>';
                        } else {
                            quanto_footer_global_option();
                        }
                    }

                }
                // Other fallback for all other pages (non-page, non-archive)
                else {

                    $quanto_footer_builder_trigger = quanto_opt('quanto_footer_builder_trigger');

                    if ( $quanto_footer_builder_trigger == 'footer_builder' ) {
                        echo '<footer class="footer">';
                        $quanto_global_footer_select = get_post( quanto_opt( 'quanto_footer_builder_select' ) );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $quanto_global_footer_select->ID );
                        echo '</footer>';
                    } else {
                        quanto_footer_global_option();
                    }

                }

            } else {
                // Elementor or Redux not active, fallback footer
                echo '<div class="footer-copyright text-center bg-black py-3 link-inherit z-index-common">';
                    echo '<div class="container">';
                        echo '<p class="mb-0 text-white">'.sprintf( 'Copyright © %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Quanto.','quanto' ),esc_url('#'),__( 'Mirrortheme', 'quanto' ) ).'</p>';
                    echo '</div>';
                echo '</div>';
            }

        }
    }

    // blog details wrapper start hook function
    if( !function_exists('quanto_blog_details_wrapper_start_cb') ) {
        function quanto_blog_details_wrapper_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                echo '<section class="blog-page-sec blog-detail-page section-padding-bottom">';
            } else {
                echo '<section class="blog-page-sec blog-detail-page local-blog-detail-page section-padding-bottom">';
            }
                echo '<div class="container custom-container">';
                    echo '<div class="row">';
        }
    }

    // blog details column wrapper start hook function
    if( !function_exists('quanto_blog_details_col_start_cb') ) {
        function quanto_blog_details_col_start_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_blog_single_sidebar = quanto_opt('quanto_blog_single_sidebar');
                if( $quanto_blog_single_sidebar == '2' && is_active_sidebar('quanto-blog-sidebar') ) {
                    echo '<div class="col-lg-8 order-last">';
                } elseif( $quanto_blog_single_sidebar == '3' && is_active_sidebar('quanto-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }

            } else {
                if( is_active_sidebar('quanto-blog-sidebar') ) {
                    echo '<div class="col-lg-8">';
                } else {
                    echo '<div class="col-lg-12">';
                }
            }
        }
    }


    // blog post meta hook function
    if( !function_exists('quanto_blog_post_meta_cb') ) {
        function quanto_blog_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_display_post_date      =  quanto_opt('quanto_display_post_date');
                $quanto_display_post_category   =  quanto_opt('quanto_display_post_category');

            } else {
                $quanto_display_post_date      = '1';
                $quanto_display_post_category   = '1';
            }

            echo '<!-- Blog Meta -->';
            echo '<div class="blog-meta">';

                if( $quanto_display_post_category ){
                    quanto_blog_category();
                }
                
                if( $quanto_display_post_date ){
                    echo '<span class="quanto-blog-date">';
                        echo esc_html( get_the_date() );
                    echo '</span>';
                }

            echo '</div>';

        }
    }

    
    // blog details post meta hook function
    if( !function_exists('quanto_blog_details_post_meta_cb') ) {
        function quanto_blog_details_post_meta_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_display_post_details_date      =  quanto_opt('quanto_display_post_details_date');
                $quanto_display_post_details_category   =  quanto_opt('quanto_display_post_details_category');
                $quanto_display_post_author      =  quanto_opt('quanto_display_post_author');

            } else {
                $quanto_display_post_details_date      = '1';
                $quanto_display_post_details_category   = '1';
                $quanto_display_post_author   = '1';
            }

            echo '<!-- Blog Meta -->';
            echo '<div class="meta-box">';
                echo '<ul class="custom-ul meta-info d-flex">';

                    if( $quanto_display_post_details_date ){
                        echo '<li><span><a href="'.esc_url( quanto_blog_date_permalink() ).'">';
                            echo esc_html( get_the_date( 'F d, Y' ) );
                        echo '</a></span></li>';

                    }
                    
                    if( $quanto_display_post_details_category ){
                        quanto_blog_category();
                    }

                    if( $quanto_display_post_author ){
                        echo '<li><span><a href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">';
                            echo 'by ' . esc_html( ucwords( get_the_author() ) );
                        echo '</a></span></li>';
                    }

                echo '</ul>';
            echo '</div>';

        }
    }

    // blog details share options hook function
    if( !function_exists('quanto_blog_details_share_options_cb') ) {
        function quanto_blog_details_share_options_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_post_details_share_options = quanto_opt('quanto_post_details_share_options');
            } else {
                $quanto_post_details_share_options = false;
            }
            if( function_exists( 'quanto_social_sharing_buttons' ) && $quanto_post_details_share_options ) {
                    echo '<ul class="custom-ul">';
                        echo quanto_social_sharing_buttons();
                    echo '</ul>';
            }
        }
    }

    // Blog Details Comments hook function
    if( !function_exists('quanto_blog_details_comments_cb') ) {
        function quanto_blog_details_comments_cb( ) {
            if ( ! comments_open() ) {
                echo '<div class="blog-comment-area">';
                    echo quanto_heading_tag( array(
                        "tag"   => "h3",
                        "text"  => esc_html__( 'Comments are closed', 'quanto' ),
                        "class" => "inner-title"
                    ) );
                echo '</div>';
            }

            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
        }
    }

    // Blog Details Related Post hook function
    if( !function_exists('quanto_blog_details_related_post_cb') ) {
        function quanto_blog_details_related_post_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_excerpt_length = '4';
                $quanto_post_details_related_post = quanto_opt('quanto_post_details_related_post');
            } else {
                $quanto_excerpt_length = '4';
                $quanto_post_details_related_post = false;
            }
            $relatedpost = new WP_Query( array(
                "post_type"         => "post",
                "posts_per_page"    => "3",
                "category__in"      => wp_get_post_categories(get_the_ID()),
                "post__not_in"      =>  array( get_the_ID() )
            ) );
            if( $relatedpost->have_posts() && $quanto_post_details_related_post ) {
                echo '<!-- Related Post -->';
                echo '<div class="quanto-blog-section section-padding-bottom overflow-hidden">';
                    echo '<div class="container custom-container">';
                        echo '<div class="row">';
                            echo '<div class="col-12">';
                                echo '<div class="quanto__header text-center text-md-start row-padding-bottom">';
                                    echo '<h3 class="title fade-anim" data-delay="0.30" data-direction="left">'.esc_html__( 'More articles', 'quanto' ).'</h3>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="row gx-4 gy-5">';
                            while( $relatedpost->have_posts() ) {
                                $relatedpost->the_post();
                                echo '<div class="col-md-6 col-lg-4">';
                                    echo '<!-- Single Post -->';
                                    echo '<div class="quanto-blog-box fade-anim" data-delay="0.45" data-direction="right">';
                                        if( has_post_thumbnail(  ) ){
                                            echo '<div class="quanto-blog-thumb">';
                                                echo '<a href="'.esc_url( get_permalink() ).'" class="post-thumbnail">';
                                                    the_post_thumbnail();
                                                echo '</a>';
                                            echo '</div>';
                                        }

                                        echo '<div class="quanto-blog-content">';
                                            if( get_the_title() ){
                                                echo '<!-- Post Title -->';
                                                echo '<h5 class="line-clamp-2"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title(), '12', '' ) ).'</a></h5>';
                                                echo '<!-- End Post Title -->';
                                            }

                                            // Blog Post Meta
                                            do_action( 'quanto_blog_post_meta' );

                                            // Excerpt And Read More Button
                                            do_action( 'quanto_blog_postexcerpt_read_content' );
                                            
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<!-- End Single Post -->';
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<!-- End Related Post -->';
            }
        }
    }

    // Blog Details Column end hook function
    if( !function_exists('quanto_blog_details_col_end_cb') ) {
        function quanto_blog_details_col_end_cb( ) {
            echo '</div>';
        }
    }

    // Blog Details Wrapper end hook function
    if( !function_exists('quanto_blog_details_wrapper_end_cb') ) {
        function quanto_blog_details_wrapper_end_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page start wrapper hook function
    if( !function_exists('quanto_page_start_wrap_cb') ) {
        function quanto_page_start_wrap_cb( ) {
            if( is_page( 'cart' ) ){
                $section_class = "quanto-cart-wrapper quanto-section-padding blog-details";
            }elseif( is_page( 'checkout' ) ){
                $section_class = "quanto-checkout-wrapper quanto-section-padding blog-details";
            }else{
                $section_class = "quanto-page-section";
            }
            echo '<section class="'.esc_attr( $section_class ).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }

    // page wrapper end hook function
    if( !function_exists('quanto_page_end_wrap_cb') ) {
        function quanto_page_end_wrap_cb( ) {
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
    }

    // page column wrapper start hook function
    if( !function_exists('quanto_page_col_start_wrap_cb') ) {
        function quanto_page_col_start_wrap_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_page_sidebar = quanto_opt('quanto_page_sidebar');
            }else {
                $quanto_page_sidebar = '1';
            }
            if( $quanto_page_sidebar == '2' && is_active_sidebar('quanto-page-sidebar') ) {
                echo '<div class="col-lg-8 order-last">';
            } elseif( $quanto_page_sidebar == '3' && is_active_sidebar('quanto-page-sidebar') ) {
                echo '<div class="col-lg-8">';
            } else {
                echo '<div class="col-lg-12">';
            }

        }
    }

    // page column wrapper end hook function
    if( !function_exists('quanto_page_col_end_wrap_cb') ) {
        function quanto_page_col_end_wrap_cb( ) {
            echo '</div>';
        }
    }

    // page sidebar hook function
    if( !function_exists('quanto_page_sidebar_cb') ) {
        function quanto_page_sidebar_cb( ) {
            if( class_exists('ReduxFramework') ) {
                $quanto_page_sidebar = quanto_opt('quanto_page_sidebar');
            }else {
                $quanto_page_sidebar = '1';
            }

            if( class_exists('ReduxFramework') ) {
                $quanto_page_layoutopt = quanto_opt('quanto_page_layoutopt');
            }else {
                $quanto_page_layoutopt = '3';
            }

            if( $quanto_page_layoutopt == '1' && $quanto_page_sidebar != 1 ) {
                get_sidebar('page');
            } elseif( $quanto_page_layoutopt == '2' && $quanto_page_sidebar != 1 ) {
                get_sidebar();
            }
        }
    }

    // page content hook function
    if( !function_exists('quanto_page_content_cb') ) {
        function quanto_page_content_cb( ) {
            
            echo '<div class="page--content clearfix">';
                the_content();

                // Link Pages
                quanto_link_pages();

            echo '</div>';
            // comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }

        }
    }
    if( !function_exists('quanto_blog_post_thumb_cb') ) {
        function quanto_blog_post_thumb_cb( ) {
            if( get_post_format() ) {
                $format = get_post_format();
            }else{
                $format = 'standard';
            }

            $quanto_post_slider_thumbnail = quanto_meta( 'post_format_slider' );

            if( !empty( $quanto_post_slider_thumbnail ) ){
                if ( ! is_single() ) {
                    echo '<div class="quanto-blog-thumb quanto-carousel" data-arrows="true" data-slide-show="1" data-fade="true">';
                    foreach ( $quanto_post_slider_thumbnail as $single_image ) {
                        if( class_exists( 'ReduxFramework' )){
                            $quanto_blog_style = quanto_opt('quanto_blog_style');

                            if('blog_style_one' == $quanto_blog_style ){
                                echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                            }elseif('blog_style_two' == $quanto_blog_style ){
                                echo '<a href="' . esc_url( get_permalink() ) . '" class="d-inline-block overflow-hidden">';
                            }
                        }else{
                            echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                        }
                            echo quanto_img_tag( array(
                                'url' => esc_url( $single_image )
                            ) );
                        echo '</a>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="img-box overflow-hidden">';
                    foreach ( $quanto_post_slider_thumbnail as $single_image ) {
                        echo quanto_img_tag( array(
                            'url' => esc_url( $single_image )
                        ) );
                    }
                    echo '</div>';
                }
            }elseif( has_post_thumbnail() && $format == 'standard' ) {
                if( ! is_single() ){
                    echo '<div class="quanto-blog-thumb">';
                        if( class_exists( 'ReduxFramework' )){
                            $quanto_blog_style = quanto_opt('quanto_blog_style');

                            if('blog_style_one' == $quanto_blog_style ){
                                echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                            }elseif('blog_style_two' == $quanto_blog_style ){
                                echo '<a href="' . esc_url( get_permalink() ) . '" class="d-inline-block overflow-hidden">';
                            }
                        }else{
                            echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                        }
                            the_post_thumbnail();
                        echo '</a>';
                    echo '</div>';
                } else {
                    echo '<div class="img-box overflow-hidden">';
                        the_post_thumbnail( 'full', array(
                            'class' => 'w-100 d-block',
                            'alt'   => get_the_title(),
                            'data-speed' => '0.8',
                        ) );
                    echo '</div>';
                }
            }elseif( $format == 'video' ){
                if( has_post_thumbnail() && !empty ( quanto_meta( 'post_format_video' ) ) ){
                    if( ! is_single() ){
                        echo '<div class="blog-video quanto-blog-thumb">';
                            if( class_exists( 'ReduxFramework' )){
                                $quanto_blog_style = quanto_opt('quanto_blog_style');

                                if('blog_style_one' == $quanto_blog_style ){
                                    echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                                }elseif('blog_style_two' == $quanto_blog_style ){
                                    echo '<a href="' . esc_url( get_permalink() ) . '" class="d-inline-block overflow-hidden">';
                                }
                            }else{
                                echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                            }
                                the_post_thumbnail();
                            echo '</a>';
                            echo '<a href="'.esc_url( quanto_meta( 'post_format_video' ) ).'" class="play-btn popup-video">';
                            echo '<i class="fas fa-play"></i>';
                            echo '</a>';
                        echo '</div>';
                    } else {
                        echo '<div class="img-box overflow-hidden">';
                            the_post_thumbnail( 'full', array(
                                'class' => 'w-100 d-block',
                                'alt'   => get_the_title(),
                                'data-speed' => '0.8',
                            ) );
                            echo '<a href="'.esc_url( quanto_meta( 'post_format_video' ) ).'" class="play-btn popup-video">';
                                echo '<i class="fas fa-play"></i>';
                            echo '</a>';
                        echo '</div>';
                    }

                }elseif( ! has_post_thumbnail() && ! is_single() ){
                    echo '<div class="blog-video">';
                        if( ! is_single() ){
                            if( class_exists( 'ReduxFramework' )){
                                $quanto_blog_style = quanto_opt('quanto_blog_style');

                                if('blog_style_one' == $quanto_blog_style ){
                                    echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                                }elseif('blog_style_two' == $quanto_blog_style ){
                                    echo '<a href="' . esc_url( get_permalink() ) . '" class="d-inline-block overflow-hidden">';
                                }
                            }else{
                                echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
                            }
                        }
                            echo quanto_embedded_media( array( 'video', 'iframe' ) );
                        if( ! is_single() ){
                            echo '</a>';
                        }
                       
                    echo '</div>';
                }
            }elseif( $format == 'audio' ){
                $quanto_audio = quanto_meta( 'post_format_audio' );
                if( !empty( $quanto_audio ) ){
                    echo '<div class="blog-audio blog-image">';
                            echo wp_oembed_get( $quanto_audio );
                           
                    echo '</div>';
                }elseif( !is_single() ){
                    echo '<div class="blog-audio blog-image">';
                            echo quanto_embedded_media( array( 'audio', 'iframe' ) );
                           
                    echo '</div>';
                }
            }

        }
    }

    if( !function_exists( 'quanto_blog_post_content_cb' ) ) {
        function quanto_blog_post_content_cb( ) {
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
                'sup'       => array(),
                'sub'       => array(),
            );
            echo '<!-- blog-content -->';

            echo '<div class="quanto-blog-content">';

                if( class_exists( 'ReduxFramework' )){
                    $quanto_blog_style = quanto_opt('quanto_blog_style');

                    if('blog_style_one' == $quanto_blog_style ){
                        if( ! is_single() ){
                            echo '<h5 class="line-clamp-2"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title(), $allowhtml ).'</a></h5>';
                        }

                        // Blog Post Meta
                        do_action( 'quanto_blog_post_meta' );
                    }elseif('blog_style_two' == $quanto_blog_style ){
                        // Blog Post Meta
                        do_action( 'quanto_blog_post_meta' );

                        if( ! is_single() ){
                            echo '<h5 class="line-clamp-3"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title(), $allowhtml ).'</a></h5>';
                        }
                    }
                }else{
                    if( ! is_single() ){
                        echo '<h5 class="line-clamp-2"><a href="'.esc_url( get_permalink() ).'">'.wp_kses( get_the_title(), $allowhtml ).'</a></h5>';
                    }

                    // Blog Post Meta
                    do_action( 'quanto_blog_post_meta' );
                }

                // Excerpt And Read More Button
                do_action( 'quanto_blog_postexcerpt_read_content' );

            echo '</div>';
            echo '<!-- End Post Content -->';
        }
    }

    if( ! function_exists( 'quanto_blog_postexcerpt_read_content_cb') ) {
        function quanto_blog_postexcerpt_read_content_cb( ) {
            if( class_exists( 'ReduxFramework' ) ) {
                $quanto_excerpt_length = quanto_opt('quanto_blog_postExcerpt');
            } else {
                $quanto_excerpt_length = '24';
            }
            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );

            if( class_exists( 'ReduxFramework' ) ) {
                $quanto_blog_admin = quanto_opt( 'quanto_blog_post_author' );
                $quanto_blog_readmore_setting_val = quanto_opt('quanto_blog_readmore_setting');
                if( $quanto_blog_readmore_setting_val == 'custom' ) {
                    $quanto_blog_readmore_setting = quanto_opt('quanto_blog_custom_readmore');
                } else {
                    $quanto_blog_readmore_setting = __( 'Read More', 'quanto' );
                }
            } else {
                $quanto_blog_readmore_setting = __( 'Read More', 'quanto' );
                $quanto_blog_admin = true;
            }

            echo '<!-- Post Summary -->';
                echo quanto_paragraph_tag( array(
                    "text"  => wp_kses( wp_trim_words( get_the_excerpt(), $quanto_excerpt_length, '' ), $allowhtml ),
                    "class" => 'blog-text',
                ) );
            echo '<!-- End Post Summary -->';
            

            if( $quanto_blog_admin || !empty( $quanto_blog_readmore_setting ) ){
                if( !empty( $quanto_blog_readmore_setting ) ){
                    echo '<!-- Button -->';
                        if( class_exists( 'ReduxFramework' )){
                            $quanto_blog_style = quanto_opt('quanto_blog_style');

                            if('blog_style_one' == $quanto_blog_style ){
                                echo '<a href="'.esc_url( get_permalink() ).'" class="quanto-link-btn btn-pill">';
                            }elseif('blog_style_two' == $quanto_blog_style ){
                                echo '<a href="'.esc_url( get_permalink() ).'" class="quanto-link-btn">';
                            }
                        }else{
                            echo '<a href="'.esc_url( get_permalink() ).'" class="quanto-link-btn btn-pill">';
                        }
                            echo esc_html( $quanto_blog_readmore_setting );
                            echo '<span>';
                                echo '<i class="fa-solid fa-arrow-right arry1"></i>';
                                echo '<i class="fa-solid fa-arrow-right arry2"></i>';
                            echo '</span>';
                        echo '</a>';
                    echo '<!-- End Button -->';
                }
            }




        }
    }


    // Hook Function for smooth
    add_action( 'quanto_before_content', function () {
        echo '<div id="smooth-wrapper"><div id="smooth-content">';
    } );
    add_action( 'quanto_after_content', function () {
        echo '</div></div>';
    } );