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

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( agroland_meta('page_breadcrumb_area') ) ) {
            $agroland_page_breadcrumb_area  = agroland_meta('page_breadcrumb_area');
        } else {
            $agroland_page_breadcrumb_area = '1';
        }
    }else{
        $agroland_page_breadcrumb_area = '1';
    }

    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );

    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $agroland_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title -->';
            echo '<div class="breadcumb-wrapper">';
                echo '<div class="container custom-container">';
                    echo '<div class="breadcumb-content">';
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                            if( agroland_meta('page_breadcrumb_settings') == 'page' ) {
                                $agroland_page_title_switcher = agroland_meta('page_title');
                            } elseif( agroland_opt('agroland_page_title_switcher') == true ) {
                                $agroland_page_title_switcher = agroland_opt('agroland_page_title_switcher');
                            }else{
                                $agroland_page_title_switcher = '1';
                            }
                        } else {
                            $agroland_page_title_switcher = '1';
                        }

                        if( $agroland_page_title_switcher == '1' ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $agroland_page_title_tag    = agroland_opt('agroland_page_title_tag');
                            }else{
                                $agroland_page_title_tag    = 'h2';
                            }

                            if( defined( 'CMB2_LOADED' )  ){
                                if( !empty( agroland_meta('page_title_settings') ) ) {
                                    $agroland_custom_title = agroland_meta('page_title_settings');
                                } else {
                                    $agroland_custom_title = 'default';
                                }
                            }else{
                                $agroland_custom_title = 'default';
                            }

                            if( $agroland_custom_title == 'default' ) {
                                echo agroland_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agroland_page_title_tag ),
                                        "text"  => esc_html( get_the_title( ) ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                echo agroland_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agroland_page_title_tag ),
                                        "text"  => esc_html( agroland_meta('custom_page_title') ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }

                        }
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                            if( agroland_meta('page_breadcrumb_settings') == 'page' ) {
                                $agroland_breadcrumb_switcher = agroland_meta('page_breadcrumb_trigger');
                            } else {
                                $agroland_breadcrumb_switcher = agroland_opt('agroland_enable_breadcrumb');
                            }

                        } else {
                            $agroland_breadcrumb_switcher = '1';
                        }

                        if( $agroland_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                            echo '<div class="breadcumb-menu-wrap">';
                                agroland_breadcrumbs(
                                    array(
                                        'breadcrumbs_classes' => 'nav',
                                    )
                                );
                            echo '</div>';
                        }

                        echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
        }
    } else {
        echo '<!-- Page title -->';
        $extra_class = '';
        
        if ( class_exists('Redux') ) {
            if ( is_singular() || is_singular('product') || is_singular('agroland_class') || is_singular('agroland_event') || is_singular('agroland_teacher') ) {
                $extra_class = ' detail-page';
            }
        }


        echo '<div class="breadcumb-wrapper' . esc_attr($extra_class) . '">';
            echo '<div class="container custom-container">';
                echo '<div class="breadcumb-content">';
                    if( class_exists( 'ReduxFramework' )  ){
                        $agroland_page_title_switcher  = agroland_opt('agroland_page_title_switcher');
                    }else{
                        $agroland_page_title_switcher = '1';
                    }

                    if( $agroland_page_title_switcher ){
                        if( class_exists( 'ReduxFramework' ) ){
                            $agroland_page_title_tag    = agroland_opt('agroland_page_title_tag');
                        }else{
                            $agroland_page_title_tag    = 'h2';
                        }
                        if ( is_archive() ){
                            echo agroland_heading_tag(
                                array(
                                    "tag"   => esc_attr( $agroland_page_title_tag ),
                                    "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif ( is_home() ){
                            $agroland_blog_page_title_setting = agroland_opt('agroland_blog_page_title_setting');
                            $agroland_blog_page_title_switcher = agroland_opt('agroland_blog_page_title_switcher');
                            $agroland_blog_page_custom_title = agroland_opt('agroland_blog_page_custom_title');
                            if( class_exists('ReduxFramework') ){
                                if( $agroland_blog_page_title_switcher ){
                                    echo agroland_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $agroland_page_title_tag ),
                                            "text"  => !empty( $agroland_blog_page_custom_title ) && $agroland_blog_page_title_setting == 'custom' ? esc_html( $agroland_blog_page_custom_title) : esc_html__( 'Blog', 'quanto' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }else{
                                echo agroland_heading_tag(
                                    array(
                                        "tag"   => "h2",
                                        "text"  => esc_html__( 'Blog', 'quanto' ),
                                        'class' => 'breadcumb-title',
                                    )
                                );
                            }
                        }elseif( is_search() ){
                            echo agroland_heading_tag(
                                array(
                                    "tag"   => esc_attr( $agroland_page_title_tag ),
                                    "text"  => esc_html__( 'Search Result', 'quanto' ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif( is_404() ){
                            echo agroland_heading_tag(
                                array(
                                    "tag"   => esc_attr( $agroland_page_title_tag ),
                                    "text"  => esc_html__( '404 PAGE', 'quanto' ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif( is_singular( 'agroland_class' ) ){
                            echo agroland_heading_tag(
                                array(
                                    "tag"   => "h2",
                                    "text"  => esc_html__( 'Class Details', 'quanto' ),
                                    'class' => 'breadcumb-title text-start',
                                )
                            );
                        }elseif( is_singular( 'agroland_event' ) ){
                            echo agroland_heading_tag(
                                array(
                                    "tag"   => "h2",
                                    "text"  => esc_html__( 'Event Details', 'quanto' ),
                                    'class' => 'breadcumb-title text-start',
                                )
                            );
                        }elseif( is_singular( 'agroland_teacher' ) ){
                            echo agroland_heading_tag(
                                array(
                                    "tag"   => "h2",
                                    "text"  => esc_html__( 'Teacher Details', 'quanto' ),
                                    'class' => 'breadcumb-title text-start',
                                )
                            );
                        }elseif( is_singular( 'product' ) ){
                            $posttitle_position  = agroland_opt('agroland_product_details_title_position');
                            $postTitlePos = false;
                            if( class_exists( 'ReduxFramework' ) ){
                                if( $posttitle_position && $posttitle_position != 'header' ){
                                    $postTitlePos = true;
                                }
                            }else{
                                $postTitlePos = false;
                            }
                            
                            if( $postTitlePos != true ){
                                echo agroland_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agroland_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title text-start'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $agroland_post_details_custom_title  = agroland_opt('agroland_product_details_custom_title');
                                }else{
                                    $agroland_post_details_custom_title = __( 'Shop Details','quanto' );
                                }

                                if( !empty( $agroland_post_details_custom_title ) ) {
                                    echo agroland_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $agroland_page_title_tag ),
                                            "text"  => wp_kses( $agroland_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title text-start'
                                        )
                                    );
                                }
                            }
                        }else{
                            $posttitle_position  = agroland_opt('agroland_post_details_title_position');
                            $postTitlePos = false;
                            if( is_single() ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }
                            if( is_singular( 'product' ) ){
                                $posttitle_position  = agroland_opt('agroland_product_details_title_position');
                                $postTitlePos = false;
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }

                            if( $postTitlePos != true ){
                                echo agroland_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agroland_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title text-start'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $agroland_post_details_custom_title  = agroland_opt('agroland_post_details_custom_title');
                                }else{
                                    $agroland_post_details_custom_title = __( 'Blog Details','quanto' );
                                }

                                if( !empty( $agroland_post_details_custom_title ) ) {
                                    echo agroland_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $agroland_page_title_tag ),
                                            "text"  => wp_kses( $agroland_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title text-start'
                                        )
                                    );
                                }
                            }
                        }
                    }
                    if( class_exists('ReduxFramework') ) {
                        $agroland_breadcrumb_switcher = agroland_opt( 'agroland_enable_breadcrumb' );
                    } else {
                        $agroland_breadcrumb_switcher = '1';
                    }
                    if( $agroland_breadcrumb_switcher == '1' ) {
                        echo '<div class="breadcumb-menu-wrap">';
                            agroland_breadcrumbs(
                                array(
                                    'breadcrumbs_classes' => 'nav',
                                )
                            );
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }