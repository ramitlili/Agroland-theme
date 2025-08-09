<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirrortheme
 * @Author URI : https://mirrortheme.com/
 *
 */

// enqueue css
function agroland_common_custom_css(){


    $CustomCssOpt  = agroland_opt( 'agroland_css_editor' );
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";

    if( get_header_image() ){
        $agroland_header_bg =  get_header_image();
    }else{
        if( agroland_meta( 'page_breadcrumb_settings' ) == 'page' && is_page() ){
            if( ! empty( agroland_meta( 'breadcumb_image' ) ) ){
                $agroland_header_bg = agroland_meta( 'breadcumb_image' );
            }
        }
    }

    if( !empty( $agroland_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$agroland_header_bg}')!important;
        }";
    }

	// Check if logo_max_width_desktop option is set and append CSS
	if ( !empty( agroland_opt( 'logo_max_width_desktop' ) ) ) {
		$logo_max_width_desktop = agroland_opt('logo_max_width_desktop' );
		$customcss .= "
			.header-logo img {
				width: {$logo_max_width_desktop}px;
			}
		";
	}

	// Check if logo_max_width_mobile option is set and append CSS for mobile view
	if ( !empty( agroland_opt('logo_max_width_mobile') ) ) {
		$logo_max_width_mobile = agroland_opt('logo_max_width_mobile');
		$customcss .= "
			@media (max-width: 680px) {
				.header-logo img {
					width: {$logo_max_width_mobile}px;
				}
			}
		";
	}

	// theme color
	$agroland_primary 	   = agroland_opt('agroland_primary');
	$agroland_heading_color  = agroland_opt('agroland_heading_color');
	$agroland_body_color     = agroland_opt('agroland_body_color');
	

	
	if( !empty( $agroland_primary ) ) {
		$customcss .= ":root {
		  --accent-color: {$agroland_primary};
		}";
	}

	if( !empty( $agroland_heading_color ) ) {
		$customcss .= ":root {
			--heading-color: {$agroland_heading_color};
		}";
	}

	if( !empty( $agroland_body_color ) ) {
		$customcss .= ":root {
			--body-color: {$agroland_body_color};
		}";
	}


	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'agroland-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'agroland_common_custom_css', 100 );