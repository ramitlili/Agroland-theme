<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$widget_class = $this->get_render_attribute_string( '_wrapper' );
$widget_container_class = $this->get_render_attribute_string( 'widget_container' );
?>
<div <?php echo $widget_class; ?>>haha
	<div <?php echo $widget_container_class; ?>>
		<?php $this->render_content(); ?>
	</div>
</div>