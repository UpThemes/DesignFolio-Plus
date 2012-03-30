<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */

get_header(); 
the_breadcrumb();

?>


<div id="main-sub">
	<div class="shell">
		<div class="cl">&nbsp;</div>
		<?php get_sidebar('sidebar-left'); ?>
		<div id="content">
			<div class="post">
				<h2 class="caption"><?php the_title(); ?></h2>
				<div class="cl">&nbsp;</div>
				<div class="entry article">
					<?php the_content(); ?>
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				</div>
		</div>
	</div>
	<div class="cl">&nbsp;</div>
</div>
	
</div>
	<div class="cl">&nbsp;</div>
<?php get_footer(); ?>