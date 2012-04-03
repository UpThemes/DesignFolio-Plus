<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */

get_header(); 
the_breadcrumb();
?>
<div class="cl">&nbsp;</div>
<div id="main-sub">
  <div class="shell">
  <div class="cl">&nbsp;</div>
    <?php get_sidebar(); ?>
      <div id="content">
      <h2 class="pagetitle search">Search Results</h2>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="post">
            <div class="cl">&nbsp;</div>
                        <div class="postmetadata">
                            <p class="comments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?></p>
                        </div>
            <small><?php the_time('F j') ?></small>
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
              <div class="cl">&nbsp;</div>
              <div class="entry">
                <?php the_content('<span>More &raquo;</span>'); ?>
              </div>
            <?php endwhile; ?>
          </div>
          <div class="cl">&nbsp;</div>
        </div>
        <div class="cl">&nbsp;</div>
      <?php else : ?>
        <h2 class="center">No posts found. Try a different search?</h2>
      <?php endif; ?>
          <div class="navigation-blog">
      <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>
  </div>
  <div class="cl">&nbsp;</div>
</div>
<div class="cl">&nbsp;</div>
<?php get_footer(); ?>
