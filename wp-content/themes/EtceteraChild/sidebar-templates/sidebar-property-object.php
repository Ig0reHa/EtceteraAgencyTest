<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'property-object-sidebar' ) ) {
	return;
}

?>

<div class="col-md-4 widget-area" id="property-object-sidebar" role="complementary">
	<?php dynamic_sidebar( 'property-object-sidebar' ); ?>
</div>