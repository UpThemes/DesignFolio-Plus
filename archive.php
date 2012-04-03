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
    <?php get_sidebar('sidebar-left'); ?>
      <div id="content">
        <?php if(isset($breadcrumb_trail)){ ?>
          <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
          <?php /* If this is a category archive */ if (is_category()) { ?>
          <h1 class="pagetitle"><?php single_cat_title(); ?></h1>
          <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
          <h1 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
          <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
          <h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          <h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          <h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
          <h1 class="pagetitle">Author Archive</h1>
          <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
          <h1 class="pagetitle">Blog Archives</h1>
          <?php } ?>
        <?php } ?>

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
              <?php the_content('<span>Continue Reading ' . get_the_title() . ' &raquo;</span>'); ?>
            </div>
            <div class="cl">&nbsp;</div>
          </div>

    <?php endwhile; ?>

    <div class="navigation-blog">
      <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
      <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>
  <?php else :

    if ( is_category() ) { // If this is a category archive
      printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
    } else if ( is_date() ) { // If this is a date archive
      echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
    } else if ( is_author() ) { // If this is a category archive
      $userdata = get_userdatabylogin(get_query_var('author_name'));
      printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
    } else {
      echo("<h2 class='center'>No posts found.</h2>");
    }
    get_search_form();

  endif;
?>

  </div>
</div>
</div>
<div class="cl">&nbsp;</div>
<?php get_footer(); ?>
