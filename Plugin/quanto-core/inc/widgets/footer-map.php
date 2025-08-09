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
*Creating Map Widget
***************************************/

class quanto_map_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'quanto_map_widget',
			// Widget name will appear in UI
			esc_html__( 'Agroland :: Map', 'quanto' ),
			// Widget description
			array(
				'description'	 => esc_html__( 'Add Map', 'quanto' ),
				'classname'		 => '',
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );

	//before and after widget arguments are defined by themes
	echo $args['before_widget'];

		if ( ! empty( $title ) ){
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo '<div class="quanto-map">';
			echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583088354!2d-74.11976389828038!3d40.697663748695746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1612886249367!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
		echo '</div>';

	echo $args['after_widget'];


}

// Widget Backend
public function form( $instance ) {
	//Title
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Get Direction', 'quanto' );
	}


?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
			<?php
				_e( 'Title:' ,'quanto');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>


<?php
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();

	$instance['title'] 	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

	return $instance;
}
}
// Class quanto_subscribe_widget ends here

// Register and load the widget
function quanto_map_load_widget() {
	register_widget( 'quanto_map_widget' );
}
add_action( 'widgets_init', 'quanto_map_load_widget' );