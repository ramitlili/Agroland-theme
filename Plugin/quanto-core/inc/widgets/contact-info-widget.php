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

class quanto_contact_info_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'quanto_contact_info_widget',
			// Widget name will appear in UI
			esc_html__( 'Quanto :: Contact Info', 'quanto' ),
			// Widget description
			array(
				'description'	 => esc_html__( 'Add Contact Info', 'quanto' ),
				'classname'		 => 'widget_contact',
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$mobile 		= apply_filters( 'widget_mobile', $instance['mobile'] );
	$email 			= apply_filters( 'widget_email', $instance['email'] );
	$address 		= apply_filters( 'widget_address', $instance['address'] );

	//Remove ' ' , '-', ' - ' from email
	$email 			= is_email( $email );
	$replace 		= array(' ','-',' - ');
	$with 			= array('','','');
	$emailurl 		= str_replace( $replace, $with, $email );

	$mobileurl 	    = str_replace( $replace, $with, $mobile );
	//before and after widget arguments are defined by themes
	echo $args['before_widget'];
    echo '<!-- About Widget Start -->';
    	if( !empty( $title ) || !empty( $address ) ||  !empty( $email ) || !empty( $mobile ) ):

			if ( ! empty( $title ) ){
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo '<div class="vs-widget-about">';
				if( ! empty( $address ) ){
				  echo '<p class="fs-md">';
					  echo wp_kses_post( $address );
				  echo '</p>';
				}
				if( ! empty( $email ) ){
	                echo '<p class="mb-0 link-inherit">';
						echo '<i class="fas fa-paper-plane me-3"></i>';
	                    echo '<a href="'.esc_attr( 'mailto:'.$emailurl ).'">'.esc_html( $email ).'</a>';
	                echo '</p>';
	            }
				if( ! empty( $mobile ) ){
					echo '<p class="mb-0 link-inherit">';
						echo '<i class="fal fa-fax me-3"></i>';
						echo '<a href="'.esc_attr( 'tel:'.$mobileurl ).'">'.esc_html( $mobile ).'</a>';
					echo '</p>';
				}
			    
			echo '</div>';
    	endif;
	echo $args['after_widget'];
    echo '<!-- About Widget End -->';


}

// Widget Backend
public function form( $instance ) {
	//Title
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Contect Us', 'quanto' );
	}

	// Address
	if ( isset( $instance[ 'address' ] ) ) {
		$address = $instance[ 'address' ];
	}else {
		$address = '';
	}

	// E-mail one
	if ( isset( $instance[ 'email' ] ) ) {
		$email = $instance[ 'email' ];
	}else {
		$email = '';
	}
	// Mobile
    if ( isset( $instance[ 'mobile' ] ) ) {
        $mobile = $instance[ 'mobile' ];
    }else {
        $mobile = '';
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
	<p>
        <label for="<?php echo $this->get_field_id( 'address' ); ?>">
            <?php
                _e( 'Address:' ,'quanto');
            ?>
        </label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
    </p>
	<p>
		<label for="<?php echo $this->get_field_id( 'email' ); ?>">
			<?php
				_e( 'Email :' ,'quanto');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'mobile' ); ?>">
			<?php
				_e( 'Mobile :' ,'quanto');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" type="text" value="<?php echo esc_attr( $mobile ); ?>" />
	</p>


<?php
}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();

	$instance['title'] 	= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

	$instance['address'] 	= ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';

	$instance['email'] 	= ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';

	$instance['mobile']  = ( ! empty( $new_instance['mobile'] ) ) ? strip_tags( $new_instance['mobile'] ) : '';
	
	return $instance;
}
}
// Class quanto_subscribe_widget ends here

// Register and load the widget
function quanto_contact_info_load_widget() {
	register_widget( 'quanto_contact_info_widget' );
}
add_action( 'widgets_init', 'quanto_contact_info_load_widget' );