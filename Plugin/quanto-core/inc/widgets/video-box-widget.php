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
* Creating Video Widget
***************************************/

class agroland_videobox_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'agroland_videobox_widget',

                // Widget name will appear in UI
                esc_html__( 'Quanto :: Video Box', 'quanto' ),

                // Widget description
                array(
                    'classname'                     => '',
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add Video Widget', 'quanto' ),
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
                    $video_image  = agroland_opt( 'video_image' );
                    $video_url    = agroland_opt( 'video_url' );
                    $video_title  = agroland_opt( 'video_title' );
                    ?>
                    <?php if(!empty( $video_image )): ?>
                        <div class="vs-video-widget">
                            <div class="video-thumb mega-hover">
                                <?php 
                                    echo agroland_img_tag( array(
                                        'url'	=> esc_url( $video_image['url'] ),
                                        'class' => 'w-100',
                                        'alt'   => 'Video Thumb',
                                    ) );
                                ?>
                                <?php if( !empty( $video_url ) ): ?>
                                    <a href="<?php echo esc_url( $video_url ); ?>" class="play-btn popup-video position-center">
                                        <i class="fas fa-play"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php if( !empty( $video_title ) ): ?>
                                <h4 class="video-title h5">
                                    <a href="<?php echo esc_url( $video_url ); ?>" class="text-inherit popup-video">
                                        <?php echo esc_html( $video_title ); ?>
                                    </a>
                                </h4>
                            <?php endif; ?>
                        </div>
                    <?php endif;  ?>
                <?php 
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

            //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }

            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quanto'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
				<a href="<?php echo esc_url( home_url('/').'wp-admin/admin.php?page=Quanto&tab=19' );?>"><?php _e( 'Add Video Content' )?></a>
            </p>

            <?php
        }


        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] 	        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

            return $instance;
        }
    } // Class agroland_videobox_widget ends here


    // Register and load the widget
    function agroland_videobox_widget() {
        register_widget( 'agroland_videobox_widget' );
    }
    add_action( 'widgets_init', 'agroland_videobox_widget' );