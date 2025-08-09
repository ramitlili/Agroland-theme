<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container_class = $this->get_render_attribute_string( '_wrapper' );
$container_inner_class = $this->get_render_attribute_string( 'container_inner' );
?>
<div <?php echo $container_class; ?>>haha
	<div <?php echo $container_inner_class; ?>>
		<?php $this->print_children(); ?>
	</div>
</div>