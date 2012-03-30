<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */
 
global $up_options;
?>

	<div id="footer">
		<div class="shell">
			<div class="cl">&nbsp;</div>
			<div class="footer-nav">
				<h2>navigate</h2>
				<ul>
					<?php wp_list_pages('title_li=&number=6'); ?>
				</ul>
			</div>
      
        <?php if ($up_options->flickr) { ?>
				<div class="footer-gallery">
					<h2>Recent Portfolio Items</h2>
				    <div class="footer-gallery-images">
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=4&display=latest&size=s&layout=x&source=user&user=<?php echo $up_options->flickr; ?>"></script>
					</div>
				</div>
        <?php } ?>

			<div class="footer-copyright">
				<h2>Copyright Notice</h2>
				<p><?php if($up_options->footer_text){ echo $up_options->footer_text; } else { echo _e('Copyright 2009 Me. All Rights Reserved.'); } ?></p>
			</div>
			<div class="cl">&nbsp;</div>
		</div>
	</div>

</body>
</html>