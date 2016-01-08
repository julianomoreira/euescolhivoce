<?php 
if ( ! is_active_sidebar( 'content_sidebar' ) ) {
	return;
}
?>
<aside id="sidebar" class="sidebar">
	<?php dynamic_sidebar( 'content_sidebar' ); ?>
</aside>