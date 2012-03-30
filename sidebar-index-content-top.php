<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */
?>

  <div class="content-item">
    <h2>Nothing to Display</h2>
  </div>

<?php 	/* Widgetized sidebar, if you have the plugin installed. */
    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>



<?php endif; ?>
<?php wp_reset_query(); ?>


