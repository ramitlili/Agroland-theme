<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php
    wp_body_open();

    /**
    *
    * Cursor
    *
    * Hook agroland_cursor_wrap
    *
    * @Hooked agroland_cursor_wrap_cb 10
    *
    */
    do_action( 'agroland_cursor_wrap' );

    /**
    *
    * Preloader
    *
    * Hook agroland_preloader_wrap
    *
    * @Hooked agroland_preloader_wrap_cb 10
    *
    */
    do_action( 'agroland_preloader_wrap' );

    /**
    *
    * quanto header
    *
    * Hook agroland_header
    *
    * @Hooked agroland_header_cb 10
    *
    */
    do_action( 'agroland_header' );



    do_action( 'agroland_before_content' );


    /**
    *
    * quanto breadcrumb
    *
    * Hook agroland_breadcrumb
    *
    * @Hooked agroland_breadcrumb_cb 10
    *
    */
    do_action( 'agroland_breadcrumb' );