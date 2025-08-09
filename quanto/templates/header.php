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
        exit();
    }

    if ( class_exists( 'ReduxFramework' ) && defined( 'ELEMENTOR_VERSION' ) ) {

        // ✅ Handle archive, blog, Single Post and search pages first
        if ( is_archive() || is_home() || is_search() || ( is_single() && get_post_type() === 'post' ) ) {

            $archive_header_id = agroland_opt('agroland_archive_header_select_options');

            if ( ! empty( $archive_header_id ) ) {
                $header_post = get_post( $archive_header_id );
                if ( $header_post ) {
                    echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                }
            } else {
                $global_header_id = agroland_opt('agroland_header_select_options');
                if ( ! empty( $global_header_id ) ) {
                    $header_post = get_post( $global_header_id );
                    if ( $header_post ) {
                        echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                        echo '</header>';
                    }
                } else {
                    agroland_global_header_option(); // fallback
                }
            }

        } 
        // ✅ Handle pages
        elseif ( is_page() || is_page_template('template-builder.php') ) {

            $agroland_post_id = get_the_ID();
            $settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );
            $settings_model = $settings_manager->get_model( $agroland_post_id );
            $header_style = $settings_model->get_settings( 'agroland_header_style' );
            $builder_option = $settings_model->get_settings( 'agroland_header_builder_option' );

            if ( $header_style == 'header_builder' && ! empty( $builder_option ) ) {
                $header_post = get_post( $builder_option );
                echo '<header class="header">';
                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                echo '</header>';
            } else {
                $trigger = agroland_opt('agroland_header_options');
                if ( $trigger == '2' ) {
                    $header_post = get_post( agroland_opt( 'agroland_header_select_options' ) );
                    echo '<header>';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    agroland_global_header_option();
                }
            }

        } 
        // ✅ Fallback for all others
        else {
            $option = agroland_opt('agroland_header_options');
            if ( $option == '1' ) {
                agroland_global_header_option();
            } else {
                $header_post = get_post( agroland_opt( 'agroland_header_select_options' ) );
                echo '<header class="header">';
                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                echo '</header>';
            }
        }

    } else {
        agroland_global_header_option(); // Elementor or Redux not active
    }
