<?php
/**
 * @package WordPress
 * @subpackage DesignFolio+
 */

get_header(); 

global $up_options;
?>

<div class="heading">
<div class="shell">
  <div class="slider">

    <div id="prevNext">
      <div class="jFlowPrev">&laquo;</div>
      <div class="jFlowNext">&raquo;</div>
    </div>
    <!-- end #prevNext -->

    <div class="slider-cont">

      <div id="slider">
    
		<?php
		global $up_options;
		$count==0;
		$id = get_cat_id($up_options->portfolio);
		if(!$up_options->portfolio_number)
			$showposts = "&showposts=".$up_options->portfolio_number;
		$q = "cat=" . $id . $showposts;
		$portfolio = new WP_Query();  
		$portfolio->query($q);
		while($portfolio->have_posts()) : $portfolio->the_post();
			$category = get_the_category(); 
        ?>
        
          <div class="slidecontainer">

						<a href="<?php the_permalink(); ?>">
							<?php if(get_post_meta($post->ID, 'featured-image', true)){ ?>
              <?php echo '<img src="' . get_bloginfo('template_url') . '/timthumb/timthumb.php?src=' . get_post_meta($post->ID, 'featured-image', true) . '&w=580&h=350&zc=1\'" alt="' . get_the_title() . '"/>'; ?>
              <?php } elseif(catch_that_image()){?>
              <img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" />
              <?php } ?>
            </a>
                        
          </div>
          
				<?php
					$count++;
					endwhile;
				?>
        
        </div><!-- /#slider -->
        
        <div id="controller"> 
        <?php
					$count = $count-1;
          while($i <= $count): ?>
            <span class="jFlowControl"><?php echo $i; ?></span>
        <?php
          $i++;
          endwhile;
        ?>
        </div><!-- /#controller -->
        
    </div>

  </div>
  
  <div class="slider-two">
  	<div class="inner">
			<?php
				while($portfolio->have_posts()) : $portfolio->the_post();
				$category = get_the_category(); 
			?>
			<div class="container">
			<?php echo '<div class="category"><span>' . $category[0]->cat_name . '</span></div>'; ?>
			<?php echo '<h2 class="title">' . get_the_title() . '</h2>'; ?>
			<?php echo '<div class="description">' . get_the_excerpt() . '</div>'; ?>
			</div>
			<?php endwhile; ?>
    </div>
  </div>

</div>

<div id="main">
  <div class="shell">
    <div class="cl">&nbsp;</div>
    <?php get_sidebar('sidebar-left'); ?>
    <div id="content">
      <?php get_sidebar('index-top'); ?>
      <?php if ($up_options->flickr) { ?>
      <div class="content-item">
        <h2>more from the portfolio</h2>
        <div class="portfolio-items">
          <div class="cl">&nbsp;</div>
          <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=6&display=latest&size=s&layout=x&source=user&user=<?php echo $up_options->flickr; ?>"></script>
          <div class="cl">&nbsp;</div>
        </div>
      </div>
      <?php } ?>
      <div class="content-posts">
        <h2>
          <?php _e('Latest Blog Posts'); ?>
        </h2>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php if (in_category('portfolio')) continue; ?>
        <div class="post">
          <div class="cl">&nbsp;</div>
          <div class="postmetadata">
              <p class="comments"><?php comments_popup_link('0 comments', '1 comment', '% comments'); ?></p>
          </div>
          <div class="meta"> <span class="date">
            <?php the_time('F j'); ?>
            </span>
          </div>
          <?php if(get_post_meta($post->ID, 'featured-image', true)){ ?>
          <div class="post-image"> <?php echo '<img src="' . get_bloginfo('template_url') . '/timthumb/timthumb.php?src=' . get_post_meta($post->ID, 'featured-image', true) . '&w=580&h=160&zc=1\'" alt="' . get_the_title() . '"/>'; ?> </div>
          <?php } ?>
          <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
          <div class="cl">&nbsp;</div>
          <div class="entry">
            <?php the_content('<span>Continue Reading ' . get_the_title() . ' &raquo;</span>'); ?>
          </div>
          <div class="cl">&nbsp;</div>
        </div>
        <?php endwhile; ?>
        <?php else : ?>
        <h3 class="center">
          <?php _e('Not Found'); ?>
        </h3>
        <p class="center">
          <?php _e('Sorry, but you are looking for something that isn\'t here.'); ?>
        </p>
        <?php endif; ?>
      </div>
      <div class="cl">&nbsp;</div>
      <div class="navigation-blog">
        <div class="alignleft">
          <?php next_posts_link('&laquo; Older Entries') ?>
        </div>
        <div class="alignright">
          <?php previous_posts_link('Newer Entries &raquo;') ?>
        </div>
      </div>
      <div class="cl">&nbsp;</div>
    </div>
    <div class="cl">&nbsp;</div>
  </div>
</div>
<div class="cl">&nbsp;</div>
<?php get_footer(); ?>
