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
*Creating Contact Information Widget
***************************************/

class quanto_social_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'quanto_social_widget',
			// Widget name will appear in UI
			esc_html__( 'Agroland :: Social Icon', 'quanto' ),
			// Widget description
			array(
				'description'	 => esc_html__( 'Add Social Icon', 'quanto' ),
				'classname'		 => 'widget_social_icon pt-0',
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$social_icon    = isset( $instance['social_icon'] ) ? $instance['social_icon'] : false;


	//before and after widget arguments are defined by themes
	echo $args['before_widget'];

		if ( ! empty( $title ) ){
			echo '<h5 class="text-white  mb-0 me-2 d-inline-block">' . $title . '</h5>';
		}
        if( $social_icon ){
            echo '<div class="footer-social d-inline-block">';
                quanto_social_icon();
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
		$title = esc_html__( 'Have Inquiry? Just Call', 'quanto' );
	}

    // Social Icon
    $social_icon = isset( $instance['social_icon'] ) ? (bool) $instance['social_icon'] : false;

?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
			<?php
				_e( 'Title:' ,'quanto');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
    <p>
        <input class="checkbox" type="checkbox"<?php checked( $social_icon ); ?> id="<?php echo $this->get_field_id( 'social_icon' ); ?>" name="<?php echo $this->get_field_name( 'social_icon' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'social_icon' ); ?>"><?php _e( 'Display Social Icon?' ); ?></label>
        <a href="<?php echo esc_url( home_url('/').'wp-admin/admin.php?page=Quanto&tab=19' );?>"><?php _e( 'Edit Social Icon' )?></a>
    </p>


<?php
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();

	$instance['title'] 	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    $instance['social_icon']      = isset( $new_instance['social_icon'] ) ? (bool) $new_instance['social_icon'] : false;

	return $instance;
}
}
// Class quanto_subscribe_widget ends here

// Register and load the widget
function quanto_social_load_widget() {
	register_widget( 'quanto_social_widget' );
}
add_action( 'widgets_init', 'quanto_social_load_widget' );