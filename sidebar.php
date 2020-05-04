<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'primary-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="col-md-12 col-lg-4 widget-area" role="complementary">
<div class="row">
	<?php dynamic_sidebar( 'primary-sidebar' ); ?>
</div>
	
</div><!-- #secondary -->
