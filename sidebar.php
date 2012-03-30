<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */
?>

	<div id="sidebar">
		<ul>
			<li>
				<div class="search-form">
					<form action="<?php echo get_option('home'); ?>/" method="get">
						<span class="search"><input type="text" name="s" value="<?php 
							echo
								isset ($_GET['s']) ?
								htmlspecialchars(get_magic_quotes_gpc() ? stripslashes($_GET['s']) : $_GET['s'])
									:'Search'
					 ?>" class="blink" title="Search" /></span>
					 	<input type="submit" class="btn" />
					</form>
				</div>
			</li>
			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>			
          
      <li>
        <div class="categories">
          <h2 class="widgettitle">Categories</h2>
					  <ul>
              <?php wp_list_categories('title_li='); ?>
            </ul>
          </h2>
        </div>
      </li>
      
			<?php endif; ?>
			<?php wp_reset_query(); ?>
		</ul>
	</div>

