<?php
if (!defined('ABSPATH')) {
    exit;
}

if ( ! function_exists('mas_animation_cpt_slug_and_id') ) {
    
    function mas_animation_cpt_slug_and_id( $post_type ) {
        $the_query = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type'      => $post_type,
        ) );
        $cpt_posts = [];
        while ( $the_query->have_posts() ): $the_query->the_post();
            $cpt_posts[get_the_ID()] = get_the_title();
        endwhile;
        wp_reset_postdata();
        return $cpt_posts;
    }
}

/**
 * Get database settings of a widget by widget id and post id
 *
 * @param number $post_id
 * @param string $widget_id
 *
 * @return false|mixed|string
 */
if ( ! function_exists( 'mas_animation_get_widget_settings' ) ) :
	function mas_animation_get_widget_settings( $post_id, $widget_id ) {

		$elementor_data = json_decode( get_post_meta( $post_id, '_elementor_data', true ), true );

		if ( $elementor_data ) {
			$element = mas_animation_get_widget_element_settings( $elementor_data, $widget_id );

			return isset( $element['settings'] ) ? $element['settings'] : '';
		}

		return false;
	}
endif;

/**
 * Get database settings of a widget by widget id and element
 *
 * @param array $elements
 * @param string $widget_id
 *
 * @return false|mixed|string
 */
if ( ! function_exists( 'mas_animation_get_widget_element_settings' ) ) :
	function mas_animation_get_widget_element_settings( $elements, $widget_id ) {

		if ( is_array( $elements ) ) {
			foreach ( $elements as $d ) {
				if ( $d && ! empty( $d['id'] ) && $d['id'] == $widget_id ) {
					return $d;
				}
				if ( $d && ! empty( $d['elements'] ) && is_array( $d['elements'] ) ) {
					$value = mas_animation_get_widget_element_settings( $d['elements'], $widget_id );
					if ( $value ) {
						return $value;
					}
				}
			}
		}

		return false;
	}
endif;