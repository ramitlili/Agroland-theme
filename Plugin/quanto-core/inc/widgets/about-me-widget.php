<?php
/**
* @version  1.0
* @package  quanto
* @author   Mirror <support@quanto.com>
*
* Websites: http://www.vecurosoft.com
*
*/

/**************************************
* Creating About Me Widget
***************************************/

class quanto_about_me_widget extends WP_Widget {

        function __construct() {
        
            parent::__construct(
                // Base ID of your widget
                'quanto_about_me_widget', 
            
                // Widget name will appear in UI
                esc_html__( 'Quanto :: About Me', 'quanto' ),
            
                // Widget description
                array( 
                    'classname'   					=> 'widget_admin',
                    'customize_selective_refresh' 	=> true,  
                    'description' 					=> esc_html__( 'Add About Me Widget', 'quanto' ),   
                )
            );

        }
    
        // This is where the action happens
        public function widget( $args, $instance ) {
            $about_img  	= ( !empty( $instance['about_img'] ) ) ? $instance['about_img'] : "";
            $author_name  	= ( !empty( $instance['author_name'] ) ) ? $instance['author_name'] : "";   
            $desc  			= ( !empty( $instance['desc'] ) ) ? $instance['desc'] : "";
            
            //before and after widget arguments are defined by themes
            echo '<!-- Author Widget -->';
            echo $args['before_widget']; 
                echo '<!-- Widget Content -->';
                echo '<div class="vs-widget-admin">';
                    if( !empty( $about_img ) ) {
                        echo '<!-- Author Image -->';
                        echo '<div class="admin-img">';
                            echo quanto_img_tag( array(
                                "url"   => esc_url( $about_img ),
                            ) );
                        echo '</div>';
                        echo '<!-- End of Author Image -->';
                    }
                    if( !empty( $author_name ) ) {
                        echo quanto_heading_tag( array(
                            "text"  => esc_html( $author_name ),
							"class"	=> "widget_title",
							"tag"	=> "h3",
                        ) );
                    }
					if( !empty( $instance['desc'] ) ) {
						echo quanto_paragraph_tag( array(
							'text'	=> wp_kses_post( $instance['desc'] ),
							'class' => 'admin-text',
						) );
                    }
                    
                echo '</div>';
                echo '<!-- End of Widget Content -->';
            echo $args['after_widget'];
            echo '<!-- End of Author Widget -->';
        }
            
        // Widget Backend 
        public function form( $instance ) {

            // Author Name	
            if ( isset( $instance[ 'author_name' ] ) ) {
                $author_name = $instance[ 'author_name' ];
            }else {
                $author_name = '';
            }

            // Description
            if ( isset( $instance[ 'desc' ] ) ) {
                $desc = $instance[ 'desc' ];
            }else {
                $desc = '';
            }
            
            //Image
            if ( isset( $instance[ 'about_img' ] ) ) {
                $about_img = $instance[ 'about_img' ];
            }else {
                $about_img = '';
            }

            // Widget admin form
            ?>
            <p>
                <input value="<?php echo esc_attr($about_img); ?>" name="<?php echo $this->get_field_name( 'about_img' ); ?>" type="hidden" class="widefat about_me_img_val" type="text" />
                <img class="_signature" src="<?php echo esc_url($about_img); ?>" alt="">
            </p>

            <p>
                <button class="button about-me-up-button"><?php ( empty( $about_img ) ) ?  esc_html_e("Upload Image","quanto") : esc_html_e("Change Image","quanto"); ?></button>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'author_name' ); ?>"><?php _e( 'Author Name:' ,'quanto'); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'author_name' ); ?>" name="<?php echo $this->get_field_name( 'author_name' ); ?>" type="text" value="<?php echo esc_attr( $author_name ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php _e( 'Description:' ,'quanto'); ?></label> 
                <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" cols="30" rows="10"><?php echo wp_kses_post( $desc ); ?></textarea>
            </p>
			
			
            <?php 
        }
    
        
        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            
            $instance = array();       
            $instance['author_name'] 	= ( ! empty( $new_instance['author_name'] ) ) ? strip_tags( $new_instance['author_name'] ) : '';                
            $instance['desc'] 	        = ( ! empty( $new_instance['desc'] ) ) ? wp_kses_post( $new_instance['desc'] ) : '';        
            $instance['about_img'] 	    = ( ! empty( $new_instance['about_img'] ) ) ? strip_tags( $new_instance['about_img'] ) : '';
            return $instance;
        }
    } // Class quanto_about_me_widget ends here
    

    // Register and load the widget
    function quanto_about_me_load_widget() {
        register_widget( 'quanto_about_me_widget' );
    }
    add_action( 'widgets_init', 'quanto_about_me_load_widget' );