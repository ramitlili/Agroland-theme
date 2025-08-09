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

class quanto_event_widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            // Base ID of your widget
            'quanto_event_widget',

            // Widget name will appear in UI
            esc_html__( 'Agroland :: Farm Events', 'agroland' ),

            // Widget description
            array(
                'classname'                     => '',
                'customize_selective_refresh'   => true,
                'description'                   => esc_html__( 'Display upcoming farm events with crop and season details', 'agroland' ),
            )
        );
    }

    // This is where the action happens
    public function widget( $args, $instance ) {

        $title     = apply_filters( 'widget_title', $instance['title'] );
        $crop_type = ! empty( $instance['crop_type'] ) ? $instance['crop_type'] : '';
        $season    = ! empty( $instance['season'] ) ? $instance['season'] : '';
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

        if( ! empty( $crop_type ) || ! empty( $season ) ){
            echo '<p class="farm-event-meta">';
                if( ! empty( $crop_type ) ){
                    echo '<span class="crop-type">' . esc_html__( 'Crop: ', 'agroland' ) . esc_html( $crop_type ) . '</span>';
                }
                if( ! empty( $season ) ){
                    echo ' <span class="season">' . esc_html__( 'Season: ', 'agroland' ) . esc_html( $season ) . '</span>';
                }
            echo '</p>';
        }

        $query_args = array(
            "post_type"         => "quanto_event",
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

                        $date = quanto_meta( 'event_date' );
                        echo '<div class="recent-event">';
                            if( ! empty( $date) ){
                                echo '<a href="'.esc_url( get_the_permalink() ).'" class="event-date">';
                                echo '<span class="month">'.esc_html( date('M', $date ) ).'</span>' .esc_html( date('d', $date ) );
                                echo '</a>';
                            }
                            echo '<div class="media-body">';
                                echo '<h4 class="event-title">';
                                echo '<a class="text-inherit" href="'.esc_url( get_the_permalink() ).'">'.wp_kses_post( wp_trim_words( get_the_title(), 7, '' ) ).'</a>';
                                echo '</h4>';

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
            $title = esc_html__( 'Upcoming Sustainable Farm Events', 'agroland' );
        }

        //Post Count
        if ( isset( $instance[ 'post_count' ] ) ) {
            $post_count = $instance[ 'post_count' ];
        }else {
            $post_count = '4';
        }

        if ( isset( $instance[ 'crop_type' ] ) ) {
            $crop_type = $instance[ 'crop_type' ];
        }else {
            $crop_type = esc_html__( 'Mixed crops', 'agroland' );
        }

        if ( isset( $instance[ 'season' ] ) ) {
            $season = $instance[ 'season' ];
        }else {
            $season = esc_html__( 'Year-round', 'agroland' );
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
        <p>
            <label for="<?php echo $this->get_field_id( 'crop_type' ); ?>"><?php _e( 'Crop Type:' ,'agroland'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'crop_type' ); ?>" name="<?php echo $this->get_field_name( 'crop_type' ); ?>" type="text" value="<?php echo esc_attr( $crop_type ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'season' ); ?>"><?php _e( 'Season:' ,'agroland'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'season' ); ?>" name="<?php echo $this->get_field_name( 'season' ); ?>" type="text" value="<?php echo esc_attr( $season ); ?>" />
        </p>
        <?php
    }


    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['post_count']     = ( ! empty( $new_instance['post_count'] ) ) ? strip_tags( $new_instance['post_count'] ) : '4';
        $instance['crop_type']      = ( ! empty( $new_instance['crop_type'] ) ) ? strip_tags( $new_instance['crop_type'] ) : '';
        $instance['season']         = ( ! empty( $new_instance['season'] ) ) ? strip_tags( $new_instance['season'] ) : '';

        return $instance;
    }
}


// Register and load the widget
function quanto_event_load_widget() {
    register_widget( 'quanto_event_widget' );
}
add_action( 'widgets_init', 'quanto_event_load_widget' );
