<?php
/**
* @version  1.0
* @package  Quanto
* @author   Mirror <support@vecurosoft.com>
*
* Websites: http://www.vecurosoft.com
*
*/

/**************************************
* Creating Gallery Widget
***************************************/

class quanto_gallery_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'quanto_gallery_widget',

                // Widget name will appear in UI
                esc_html__( 'Agroland :: Farm Gallery', 'agroland' ),

                // Widget description
                array(
                    'classname'                     => '',
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add farm gallery widget', 'agroland' ),
                )
            );
        }

        // This is where the action happens
        public function widget( $args, $instance ) {


            $title      = apply_filters( 'widget_title', $instance['title'] );

            //before and after widget arguments are defined by themes
            echo $args['before_widget'];

                if( !empty( $title  ) ){
                    echo $args['before_title'];
                        echo esc_html( $title );
                    echo $args['after_title'];
                }
				$quanto_gallery_image = quanto_opt( 'quanto_gallery_image_widget' );
				
				if( !empty( $quanto_gallery_image ) && isset( $quanto_gallery_image ) ){
					echo '<div class="sidebar-gallery">';
                        foreach( $quanto_gallery_image as $single_image ){
                            echo '<div class="gallery-thumb">';
                                echo quanto_img_tag( array(
                                    'url'	=> esc_url( $single_image['image'] ),
                                    'class' => 'w-100',
                                ) );
                               echo '<a href="'.esc_url( $single_image['image'] ).'" class="popup-image gal-btn">';
                                    echo '<i class="fal fa-plus"></i>';
                               echo '</a>';
                                
                           echo '</div>';
                        }
                    echo '</div>';
				}
                
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

            //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = esc_html__( 'Farm Gallery', 'agroland' );
            }

            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quanto'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				<a href="<?php echo esc_url( home_url('/').'wp-admin/admin.php?page=Quanto&tab=1' );?>"><?php _e( 'Add Gallery Image' )?></a>
            </p>

            <?php
        }


        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] 	        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

            return $instance;
        }
    } // Class quanto_gallery_widget ends here


    // Register and load the widget
    function quanto_gallery_widget() {
        register_widget( 'quanto_gallery_widget' );
    }
    add_action( 'widgets_init', 'quanto_gallery_widget' );