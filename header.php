<?php

/**
 * @package WordPress
 * @subpackage DesignFolio+
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.flow.1.0.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-func.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/Museo_Sans_500_400.font.js" type="text/javascript"></script>
<script type="text/javascript"><!--
Cufon.replace('h2, h3');
--></script>

<?php
global $up_options;
?>

<style type="text/css">

<?php if($up_options->linkcolor){ ?>
a{ color: <? echo $up_options->linkcolor; ?>}
<?php } ?>

<?php if($up_options->hovercolor){ ?>
a:hover{ color: <? echo $up_options->hovercolor; ?>}
<?php } ?>

<?php if($up_options->activecolor){ ?>
a:active{ color: <? echo $up_options->activecolor; ?>}
<?php } ?>

<?php if($up_options->logo){ ?>
h1#logo a{ background-image: url("<? echo bloginfo('template_url') . "/timthumb/timthumb.php?w=292&h=62&zc=1&src=" . $up_options->logo; ?>");}
<?php } ?>

<?php if(is_home()){ ?>

  <?php if($up_options->bgimage_homepage){ ?>
  .heading{ background-image: url(<? echo $up_options->bgimage_homepage; ?>)}
  .breadcrumb{ background: <? echo $up_options->bgcolor; ?> }
  <?php } 
        if($up_options->bgcolor){ ?>
  .heading, .breadcrumb{ background-color: <? echo $up_options->bgcolor; ?>}
  <?php } ?>

<?php } else { ?>
  
  <?php if($up_options->bgimage_inner){ ?>
  .heading,
  .breadcrumb{ background-image: url(<? echo $up_options->bgimage_inner; ?>)}
  <?php }
      if($up_options->bgcolor){?>
  .breadcrumb{ background: <? echo $up_options->bgcolor; ?> }
  <?php } 
        if($up_options->bgcolor){ ?>
  .heading, .breadcrumb{ background-color: <? echo $up_options->bgcolor; ?>}
  <?php } ?>
  
<?php } ?>

<?php if($up_options->welcome_text_color){?>
.heading h2.welcome{ color: <?php echo $up_options->welcome_text_color; ?> }
<?php } ?>

</style>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

</head>
  <body class="<?php thematic_body_class(); ?>">
    <div id="header">
      <div class="shell">
        <div class="cl">&nbsp;</div>
        <h1 id="logo"><a href="<?php echo get_option('home'); ?>/"><?php echo bloginfo('title') . " // " . bloginfo('description'); ?></a></h1>       
        <ul class="navigation">
          <li><a href="<?php bloginfo('home') ?>">Home</a></li>
          <?php wp_list_pages__design_folio(); /*wp_list_pages('title_li=&link_after=<span class="hide-if-no-js">|</span>');*/ ?>
        </ul>
        <div class="cl">&nbsp;</div>
      </div>
    </div>