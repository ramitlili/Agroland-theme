<?php
/**
* @version  1.0
* @package  quanto
* @author   Mirror <support@vecurosoft.com>
*
* Websites: http://www.vecurosoft.com
*
*/

/**************************************
* Creating About Us Widget
***************************************/

class agroland_aboutus_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'agroland_aboutus_widget',

                // Widget name will appear in UI
                esc_html__( 'Quanto :: About Us Widget', 'quanto' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add About Us Widget', 'quanto' ),
                    'classname'		                => 'pt-0',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            $aboutus_bg_img  	= ( !empty( $instance['aboutus_bg_img'] ) ) ? $instance['aboutus_bg_img'] : "";
            $title          = apply_filters( 'widget_title', $instance['title'] );
			$about_us 	    = apply_filters( 'widget_about_us', $instance['about_us'] );
			$button_text 	= apply_filters( 'widget_button_text', $instance['button_text'] );

            if ( isset( $instance[ 'button_url' ] ) ) {
                $button_url = $instance[ 'button_url' ];
            }else {
                $button_url = '#';
            }

        echo '<div class="widget bg-vs-secondary background-image" style="background-image: url( '.esc_url($aboutus_bg_img).' );" > ';
            //before and after widget arguments are defined by themes
            if( !empty( $title  ) ){
                echo '<h4 class="mt-n2 text-white">';
                    echo esc_html( $title );
                echo '</h4>';
            }
            echo '<div class="vs-widget-about">';
                if( ! empty( $about_us ) ){
                    echo '<p class="mb-4 pb-1 text-white">'.wp_kses_post( $about_us ).'</p>';
                }
                if( ! empty( $button_text ) ){
                    echo '<a href="'.esc_url( $button_url ).'" class="vs-btn">'.esc_html( $button_text ).'</a>';
                }
            echo '</div>';
        echo '</dev>';
        }

        // Widget Backend
        public function form( $instance ) {

             //Title
             if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }

            //Image
            if ( isset( $instance[ 'button_text' ] ) ) {
                $button_text = $instance[ 'button_text' ];
            }else {
                $button_text = '';
            }

            //Image Url
            if ( isset( $instance[ 'button_url' ] ) ) {
                $button_url = $instance[ 'button_url' ];
            }else {
                $button_url = '#';
            }

			if ( isset( $instance[ 'about_us' ] ) ) {
				$about_us = $instance[ 'about_us' ];
			}else {
				$about_us = '';
			}

             //Image
             if ( isset( $instance[ 'aboutus_bg_img' ] ) ) {
                $aboutus_bg_img = $instance[ 'aboutus_bg_img' ];
            }else {
                $aboutus_bg_img = '';
            }
            

            // Widget admin form
            ?>
            <p>
                <input value="<?php echo esc_attr($aboutus_bg_img); ?>" name="<?php echo $this->get_field_name( 'aboutus_bg_img' ); ?>" type="hidden" class="widefat about_me_img_val" type="text" />
                <img class="_signature" src="<?php echo esc_url($aboutus_bg_img); ?>" alt="">
            </p>

            <p>
                <button class="button about-me-up-button"><?php ( empty( $aboutus_bg_img ) ) ?  esc_html_e("Upload Image","quanto") : esc_html_e("Change Image","quanto"); ?></button>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quanto'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text' , 'quanto' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button URL:' ,'quanto'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
            </p>
			<p>
				<label for="<?php echo $this->get_field_id( 'about_us' ); ?>">
					<?php
						_e( 'About Us:' ,'dvpn');
					?>
				</label>
		        <textarea class="widefat" id="<?php echo $this->get_field_id( 'about_us' ); ?>" name="<?php echo $this->get_field_name( 'about_us' ); ?>" rows="8" cols="80"><?php echo esc_html( $about_us ); ?></textarea>
			</p>
            <?php
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] 	        	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['button_text'] 	    = ( ! empty( $new_instance['button_text'] ) ) ? strip_tags( $new_instance['button_text'] ) : '';
            $instance['button_url'] 	    = ( ! empty( $new_instance['button_url'] ) ) ? strip_tags( $new_instance['button_url'] ) : '';
            $instance['about_us'] 			= ( ! empty( $new_instance['about_us'] ) ) ? strip_tags( $new_instance['about_us'] ) : '';
            $instance['aboutus_bg_img'] 	    = ( ! empty( $new_instance['aboutus_bg_img'] ) ) ? strip_tags( $new_instance['aboutus_bg_img'] ) : '';
			return $instance;
        }
    } // Class agroland_aboutus_widget ends here


    // Register and load the widget
    function agroland_aboutus_load_widget() {
        register_widget( 'agroland_aboutus_widget' );
    }
    add_action( 'widgets_init', 'agroland_aboutus_load_widget' );