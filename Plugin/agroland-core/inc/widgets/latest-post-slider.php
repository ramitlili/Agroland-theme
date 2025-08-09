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
* Creating Recent Post Widget
***************************************/

class quanto_recent_posts_widget_slider extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'quanto_recent_posts_widget_slider',

                // Widget name will appear in UI
                esc_html__( 'Agroland :: Farm Posts Slider', 'agroland' ),

                // Widget description
                array(
                    'classname'                     => '',
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add farm posts slider widget', 'agroland' ),
                )
            );
        }

        // This is where the action happens
        public function widget( $args, $instance ) {

            $title      = apply_filters( 'widget_title', $instance['title'] );
            $show_date  = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
            //Post Count
            if ( isset( $instance[ 'post_count' ] ) ) {
                $post_count = $instance[ 'post_count' ];
            }else {
                $post_count = '2';
            }

            //before and after widget arguments are defined by themes
            echo $args['before_widget'];

                if( !empty( $title  ) ){
                    echo $args['before_title'];
                        echo esc_html( $title );
                    echo $args['after_title'];
                }


                $query_args = array(
                    "post_type"         => "post",
                    "posts_per_page"    => esc_attr( $post_count ),
                    "post_status"       => "publish",
                    "ignore_sticky_posts"   => true
                );


                $recentposts = new WP_Query( $query_args );

                if( $recentposts->have_posts(  ) ) {
					echo '<div class="vs-widget-recent-post">';
						echo '<div class="recent-vs-carousel vs-carousel mb-30" data-slidetoshow="1">';
                            while( $recentposts->have_posts(  ) ) {
                                $recentposts->the_post();
								if( has_post_thumbnail() ){
	                                echo '<div class="recent-post" data-overlay="gradient" data-opacity="8">';
										echo '<a href="'.esc_url( get_the_permalink( ) ).'">';
	                                        the_post_thumbnail( );
										echo '</a>';
	                                    if( $show_date ){
	                                        echo '<span class="post-date text-white"><i class="fal fa-calendar-alt"></i><a href="'.esc_url( quanto_blog_date_permalink() ).'">'.esc_html( get_the_time( 'd F Y' ) ).'</a></span>';
	                                    }
	                            	echo '</div>';
								}
                        	}
                            wp_reset_postdata();
						echo '</div>';
						while( $recentposts->have_posts(  ) ) {
                            $recentposts->the_post();
                            echo '<div class="recent-post media align-items-center">';
                                if( has_post_thumbnail() ){
									echo '<div class="media-img pr-20">';
                                        the_post_thumbnail( 'blog-sidebar-size' );
									echo '</div>';
                                }
								echo '<div class="media-body">';
									if( get_the_title() ){
                                        echo '<h4 class="recent-post-title h6 mb-0"><a href="'.esc_url( get_the_permalink() ).'">'.wp_kses_post( wp_trim_words( get_the_title(), 3, '' ) ).'</a></h4>';
									}
									if( $show_date ){
                                        echo '<span class="text-theme text-xs"><a href="'.esc_url( quanto_blog_date_permalink() ).'">'.esc_html( get_the_time( 'd F, Y' ) ).'</a></span>';
                                    }
                                echo '</div>';
                        	echo '</div>';
                        }
                        wp_reset_postdata();
                    echo '</div>';
                    echo '<!-- End of Widget Content -->';
                }
            echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

            //Title
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else {
                $title = esc_html__( 'Latest Farm Posts', 'agroland' );
            }

            //Post Count
            if ( isset( $instance[ 'post_count' ] ) ) {
                $post_count = $instance[ 'post_count' ];
            }else {
                $post_count = '4';
            }

            // Show Date
            $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;

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
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
    		    <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
            </p>
            <?php
        }


        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {

            $instance = array();
            $instance['title'] 	        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['post_count'] 	= ( ! empty( $new_instance['post_count'] ) ) ? strip_tags( $new_instance['post_count'] ) : '4';
            $instance['show_date']      = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

            return $instance;
        }
    } // Class quanto_recent_posts_widget_slider ends here


    // Register and load the widget
    function quanto_recent_posts_widget_slider() {
        register_widget( 'quanto_recent_posts_widget_slider' );
    }
    add_action( 'widgets_init', 'quanto_recent_posts_widget_slider' );