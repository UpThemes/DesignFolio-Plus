<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */
?>

<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('index-top') ) : ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
