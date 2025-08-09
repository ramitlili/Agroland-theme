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
*   Creating Newsletter Widget
***************************************/

class quanto_newsletter_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
    		// Base ID of your widget
    		'quanto_newsletter_widget',
    		// Widget name will appear in UI
    		esc_html__( 'Agroland :: Newsletter', 'agroland' ),
    		// Widget description
    		array(
				'description' 	              => esc_html__( 'Add farm newsletter', 'agroland' ),
				'classname'		              => 'widget_newsletter',
                'customize_selective_refresh' => true,
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$placeholder 	= apply_filters( 'widget_placeholder', $instance['placeholder'] );


	// before and after widget arguments are defined by themes
	echo $args['before_widget'];

    if ( ! empty( $title ) ){
        echo $args['before_title'] . $title . $args['after_title'];
    }
	
	echo '<p>';
		echo esc_html__( 'Sign up for updates on sustainable farming.', 'agroland' );
	echo '</p>';
	
	echo '<form class="newsletter-form footer-newsletter">';
		echo '<span class="form-icon"><i class="fal fa-envelope"></i></span>';
		echo '<input class="form-control" type="email" placeholder="'.esc_attr( $placeholder ).'" required >';
			echo '<button type="submit" class="vs-btn mask-style1">';
                echo esc_html__( 'Subscribe','quanto' );
			echo '</button>';
	echo '</form>';

	echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
	//Title
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Join Our Sustainable Newsletter', 'agroland' );
	}

	// Placeholder Text
	if ( isset( $instance[ 'placeholder' ] ) ) {
		$placeholder = $instance[ 'placeholder' ];
	}else{
		$placeholder = __( 'Your Email Address', 'quanto' );
	}

// Widget admin form
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
		<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>">
			<?php
				_e( 'Placeholder:' ,'quanto' );
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="text" value="<?php echo esc_attr( $placeholder ); ?>" />
	</p>
<?php
	}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    	$instance 					= array();
    	$instance['title'] 			= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    	$instance['placeholder']  	= ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( $new_instance['placeholder'] ) : '';

    	return $instance;
	}
} // Class quanto_subscribe_widget ends here


// Register and load the widget
function quanto_newsletter_load_widget() {
	register_widget( 'quanto_newsletter_widget' );
}
add_action( 'widgets_init', 'quanto_newsletter_load_widget' );