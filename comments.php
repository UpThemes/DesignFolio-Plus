<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<div class="content-item">
	<div class="cl">&nbsp;</div>
<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('No Comments', '1 Comments', '% Comments' );?></h3>
	<div class="rss-feed">
		<?php post_comments_feed_link('Subscribe to this Comment’s RSS Feed') ?>
	</div>
	<div class="cl">&nbsp;</div>
</div>	
	<div class="post-comments">
		<?php wp_list_comments('type=comment&style=ol&callback=mytheme_comment'); ?>
	</div>
	
	<div class="cl">&nbsp;</div>
	<div class="navigation-blog">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">
<div class="cl">&nbsp;</div>
<h3><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h3>

<div class="cancel-comment-reply">
	<small class="cancel"><?php cancel_comment_reply_link('Don`t Reply'); ?></small>
</div>



<div class="cl">&nbsp;</div>
<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<div class="cl">&nbsp;</div>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="respond-name">
	
<?php if ( is_user_logged_in() ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>


	<div class="cl-form">&nbsp;</div>
	<span class="text-field-bg"><input type="text" name='author' class="text-field" alt="" id="author" value="<?php echo esc_attr($comment_author); ?>" size="400" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></span><label for="respond-name">Name <?php if ($req) /*echo "(required)"*/; ?></label>
	<div class="cl-form">&nbsp;</div>								
	<span class="text-field-bg"><input type="text" name="email" id="email" class="text-field" alt="" value="<?php echo esc_attr($comment_author_email); ?>" size="400" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></span><label for="email">Email <?php if ($req) /*echo "(required)"*/; ?></label>
	<div class="cl-form">&nbsp;</div>							
	<span class="text-field-bg"><input type="text" class="text-field" alt="" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="400" tabindex="3" /></span><label for="respond-url">Website URL</label>
	<div class="cl-form">&nbsp;</div>	


<!--<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>-->
<!--
<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="400" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>-->

<!--<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>-->

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<!--<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>-->

<span class="textarea-bg"><textarea name="comment" id="comment" rows="10" cols="50" tabindex="4"></textarea></span>		
	
	<div class="cl-form">&nbsp;</div>	
	
<p>You are allowed to use tags like &lt;a href=”” title=””&gt;&lt;/a&gt; or &lt;abbr>&lt;/abbr&gt; or even &lt;blockquote&gt;&lt;/blockquote&gt;</p>
	
	<input type="submit" class="submit" id="submit" tabindex="5" value="Submit Comment"/>
	
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>
<div class="cl">&nbsp;</div>
<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>
