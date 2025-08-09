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
* Creating Event Widget
***************************************/

class agroland_event_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'agroland_event_widget',

                // Widget name will appear in UI
                esc_html__( 'Quanto :: Event', 'quanto' ),

                // Widget description
                array(
                    'classname'                     => '',
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add Event Widget', 'quanto' ),
                )
            );
        }

        // This is where the action happens
    public function widget( $args, $instance ) {

            $title      = apply_filters( 'widget_title', $instance['title'] );
            //Post Count
            if ( isset( $instance[ 'post_count' ] ) ) {
                $post_count = $instance[ 'post_count' ];
            }else {
                $post_count = '2';
            }

        echo '<div class="widget">';
            if( ! empty( $title  ) ){
                echo $args['before_title'];
                    echo esc_html( $title );
                echo $args['after_title'];
            }

            $query_args = array(
                "post_type"         => "agroland_event",
                "posts_per_page"    => esc_attr( $post_count ),
                "post_status"       => "publish",
                "ignore_sticky_posts"   => true
            );


            $eventpost = new WP_Query( $query_args );
            if( $eventpost->have_posts(  ) ) {
                echo '<!-- Widget Content -->';
                    echo '<div class="rvs-event-widget">';
                        while( $eventpost->have_posts(  ) ) {
                            $eventpost->the_post();

                            $date = agroland_meta( 'event_date' );
                            echo '<div class="recent-event">';
                                if( ! empty( $date) ){
                                    echo '<a href="'.esc_url( get_the_permalink() ).'" class="event-date">
                                    <span class="month">'.esc_html( date('M', $date ) ).'</span>
                                        ' .esc_html( date('d', $date ) ).'
                                    </a>';
                                }
                                echo '<div class="media-body">';
                                    echo '<h4 class="event-title">
                                    <a class="text-inherit" href="'.esc_url( get_the_permalink() ).'">'.wp_kses_post( wp_trim_words( get_the_title(), 7, '' ) ).'</a>
                                    </h4>';
                                    
                                echo '</div>';
                        echo '</div>';
                        }
                        wp_reset_postdata();
                    echo '</div>';
                }
            echo '</div>';
        echo '<!-- End of Widget Content -->';
    }

        // Widget Backend
        public function form( $instance ) {

            //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = '';
            }

            //Post Count
            if ( isset( $instance[ 'post_count' ] ) ) {
                $post_count = $instance[ 'post_count' ];
            }else {
                $post_count = '4';
            }

            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'quanto'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'post_count' ); ?>"><?php _e( 'Number of Posts to show:' ,'quanto'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?>" />
            </p>
            <?php
        }


        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] 	        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['post_count'] 	= ( ! empty( $new_instance['post_count'] ) ) ? strip_tags( $new_instance['post_count'] ) : '4';

            return $instance;
        }
    } // Class agroland_event_widget ends here


    // Register and load the widget
    function agroland_event_load_widget() {
        register_widget( 'agroland_event_widget' );
    }
    add_action( 'widgets_init', 'agroland_event_load_widget' );