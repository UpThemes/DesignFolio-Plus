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
          <div class="cl">&nbsp;</div>
          <small class="wide"><?php the_time('F j, Y') ?></small>
          <p class="comments single-page-comment">
            <span><?php comments_popup_link('0', '1', '%'); ?></span>
            <strong><?php comments_popup_link('Comments', 'Comments', 'Comments'); ?></strong>
          </p>
          <div class="cl">&nbsp;</div>
          <h2 class="caption"><?php the_title(); ?></h2>
          <div class="cl">&nbsp;</div>
          <div class="entry article">
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
              <?php the_tags( '
                  <div class="postmetadata">
                    <div class="tags">
                      <div class="tags-bottom">
                        <p>Tags: ', ', ', 
                  '
                      </p>
                    </div>
                  </div>
                </div>'
              ); ?>
            <div class="entry">
              <!--<p class="postmetadata alt">
                <small>
                    This entry was posted
                    <?php /* This is commented, because it requires a little adjusting sometimes.
                      You'll need to download this plugin, and follow the instructions:
                      http://binarybonsai.com/wordpress/time-since/ */
                      /* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
                    on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
                    and is filed under <?php the_category(', ') ?>.
                    You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.
        
                    <?php if ( comments_open() && pings_open() ) {
                      // Both Comments and Pings are open ?>
                      You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.
        
                  <?php } elseif ( !comments_open() && pings_open() ) {
                    // Only Pings are Open ?>
                    Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.
        
                  <?php } elseif ( comments_open() && !pings_open() ) {
                    // Comments are open, Pings are not ?>
                    You can skip to the end and leave a response. Pinging is currently not allowed.
        
                  <?php } elseif ( !comments_open() && !pings_open() ) {
                    // Neither Comments, nor Pings are open ?>
                    Both comments and pings are currently closed.
        
                  <?php } edit_post_link('Edit this entry','','.'); ?>
      
                </small>
              </p>-->

            </div>
          </div>
          <div class="cl">&nbsp;</div>
          <?php comments_template(); ?>
          <div class="cl">&nbsp;</div>
        </div>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
  </div>
<div class="cl">&nbsp;</div>
<?php get_footer(); ?>
