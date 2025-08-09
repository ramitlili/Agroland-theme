<?php

namespace Mas\inc;

use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class Ajax_Handler {

	public static function init() {
		
		add_action( 'wp_ajax_mas_load_popup_content', [ __CLASS__, 'mas_popup_content' ] );
		add_action( 'wp_ajax_nopriv_mas_load_popup_content', [ __CLASS__, 'mas_popup_content' ] );
	}

	/**
	 * mas popup content Ajax call
	 */
	public static function mas_popup_content() {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'mas-addons-frontend' ) ) {
			exit( 'No naughty business please' );
		}

		$post_id  = $_REQUEST["post_id"];
		$widget_id  = $_REQUEST["widget_id"];
       
		$settings = mas_animation_get_widget_settings($post_id, $widget_id);
      
		ob_start();
	
		if ( 'template' === $settings['popup_content_type'] ){
			echo Plugin::$instance->frontend->get_builder_content( $settings['popup_elementor_templates'] );
        } else{

			$content = $settings['popup_content'];
			$content = shortcode_unautop( $content );
			$content = do_shortcode( $content );
			$content = wptexturize( $content );

			if ( $GLOBALS['wp_embed'] instanceof \WP_Embed ) {
				$content = $GLOBALS['wp_embed']->autoembed( $content );
			}

		    echo $content;
        }
		$html = ob_get_contents();
		ob_end_clean();

		wp_send_json(
			array(
				'html'      => $html,
				'widget_attr' => 'test attr',
			)
		);

		die();
	}
}

Ajax_Handler::init();
