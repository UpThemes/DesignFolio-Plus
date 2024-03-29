<?php

/**
 * @package WordPress
 * @subpackage DesignFolio+
 */

// Include UpThemes Framework
require_once("admin/admin.php");

function the_breadcrumb() {
  
  if(class_exists('bcn_breadcrumb_trail'))
  {
    //Make new breadcrumb object
    $breadcrumb_trail = new bcn_breadcrumb_trail;
    //Setup our options
    //Set the home_title to Blog
    $breadcrumb_trail->opt['home_title'] = "Home";
    $breadcrumb_trail->opt['separator'] = " / ";
    //Set the current item to be surrounded by a span element, start with the prefix
    $breadcrumb_trail->opt['current_item_prefix'] = '</p><p><span class="current"><em>';
    //Set the suffix to close the span tag
    $breadcrumb_trail->opt['current_item_suffix'] = '</em></span>';
    //Fill the breadcrumb trail
    $breadcrumb_trail->fill();
    //Display the trail
    
  }
  ?>
  <div class="breadcrumb">
    <div class="shell">
      <p>
      <?php
        if (isset($breadcrumb_trail)) {
          $breadcrumb_trail->display();
        }
      ?>
      </p>
    </div>
  </div>
  <?php
}
function mytheme_comment($comment, $args, $depth) { 
  $GLOBALS['comment'] = $comment; 
?>
<ol class="commentlist">
    <li class="comment">
      <div class="comment-container">
        <div class="cl">&nbsp;</div>
      <div class="author-avatar">
        <div class="comment-author"><?php echo get_avatar($comment->comment_author_email, $size='90'); ?></div>
      </div>
      <div class="comment-body-sub">
          <div class="commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s, %2$s'), get_comment_time(), get_comment_date('F j') ) ?></a>
            <?php edit_comment_link(__('(Edit)'),'  ','') ?>
        </div>
            <div class="comment-author"><?php printf(__('%s <span class="says">says:</span>'), get_comment_author_link()) ?></div>
            <?php if ($comment->comment_approved == '0') : ?><em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
          <?php endif; ?>
          <?php comment_text() ?>
          <div class="reply">
          <?php comment_reply_link(array_merge($args, array("reply_text"=>"Reply", "depth"=>$depth, "max_depth"=>15))) ?>
          </div>
      </div>
        <div class="cl">&nbsp;</div>  
      </div>
    </li>
</ol>
<?php 

}

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}


function wp_list_pages__design_folio() {
  $html = wp_list_categories('title_li=&echo=0');
  $html = str_replace('</a></li>', '</a></li>', $html);
  $html = preg_replace('~</a>\</li>$~', '</a></li>', $html);
  echo $html;
}

if(function_exists('automatic_feed_links')){
  automatic_feed_links();
}
                   
if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h2 class="widgettitle">',
    'after_title' => '</h2>',
  ));
  register_sidebar(array(
    'name' => 'Above Content - Homepage',
    'id' => 'index-top',
    'before_widget' => '<div class="content-item twitter">',
    'after_widget' => '</div>'
  ));
}

if ( function_exists('register_sidebar') )
  register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '',
        'after_title' => '',
    ));


// Generates semantic classes for BODY element
function thematic_body_class( $print = true ) {
  global $wp_query, $current_user;

  // It's surely a WordPress blog, right?
  $c = array('wordpress');

  // Applies the time- and date-based classes (below) to BODY element
  thematic_date_classes( time(), $c );

  // Generic semantic classes for what type of content is displayed
  is_front_page()  ? $c[] = 'home'       : null; // For the front page, if set
  is_home()        ? $c[] = 'blog'       : null; // For the blog posts page, if set
  is_archive()     ? $c[] = 'archive'    : null;
  is_date()        ? $c[] = 'date'       : null;
  is_search()      ? $c[] = 'search'     : null;
  is_paged()       ? $c[] = 'paged'      : null;
  is_attachment()  ? $c[] = 'attachment' : null;
  is_404()         ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character

  // Special classes for BODY element when a single post
  if ( is_single() ) {
    $postID = $wp_query->post->ID;
    the_post();

        // Adds post slug class, prefixed by 'slug-'
        $c[] = 'slug-' . $wp_query->post->post_name;

    // Adds 'single' class and class with the post ID
    $c[] = 'single postid-' . $postID;

    // Adds classes for the month, day, and hour when the post was published
    if ( isset( $wp_query->post->post_date ) )
      thematic_date_classes( mysql2date( 'U', $wp_query->post->post_date ), $c, 's-' );

    // Adds category classes for each category on single posts
    if ( $cats = get_the_category() )
      foreach ( $cats as $cat )
        $c[] = 's-category-' . $cat->slug;

    // Adds tag classes for each tags on single posts
    if ( $tags = get_the_tags() )
      foreach ( $tags as $tag )
        $c[] = 's-tag-' . $tag->slug;

    // Adds MIME-specific classes for attachments
    if ( is_attachment() ) {
      $mime_type = get_post_mime_type();
      $mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
        $c[] = 'attachmentid-' . $postID . ' attachment-' . str_replace( $mime_prefix, "", "$mime_type" );
    }

    // Adds author class for the post author
    $c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author_login()));
    rewind_posts();
  }

  // Author name classes for BODY on author archives
  elseif ( is_author() ) {
    $author = $wp_query->get_queried_object();
    $c[] = 'author';
    $c[] = 'author-' . $author->user_nicename;
  }

  // Category name classes for BODY on category archvies
  elseif ( is_category() ) {
    $cat = $wp_query->get_queried_object();
    $c[] = 'category';
    $c[] = 'category-' . $cat->slug;
  }

  // Tag name classes for BODY on tag archives
  elseif ( is_tag() ) {
    $tags = $wp_query->get_queried_object();
    $c[] = 'tag';
    $c[] = 'tag-' . $tags->slug;
  }

  // Page author for BODY on 'pages'
  elseif ( is_page() ) {
    $pageID = $wp_query->post->ID;
    $page_children = wp_list_pages("child_of=$pageID&echo=0");
    the_post();

        // Adds post slug class, prefixed by 'slug-'
        $c[] = 'slug-' . $wp_query->post->post_name;

    $c[] = 'page pageid-' . $pageID;
    $c[] = 'page-author-' . sanitize_title_with_dashes(strtolower(get_the_author('login')));
    // Checks to see if the page has children and/or is a child page; props to Adam
    if ( $page_children )
      $c[] = 'page-parent';
    if ( $wp_query->post->post_parent )
      $c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;
    if ( is_page_template() ) // Hat tip to Ian, themeshaper.com
      $c[] = 'page-template page-template-' . str_replace( '.php', '-php', get_post_meta( $pageID, '_wp_page_template', true ) );
    rewind_posts();
  }

  // Search classes for results or no results
  elseif ( is_search() ) {
    the_post();
    if ( have_posts() ) {
      $c[] = 'search-results';
    } else {
      $c[] = 'search-no-results';
    }
    rewind_posts();
  }

  // For when a visitor is logged in while browsing
  if ( $current_user->ID )
    $c[] = 'loggedin';

  // Paged classes; for 'page X' classes of index, single, etc.
  if ( ( ( $page = $wp_query->get('paged') ) || ( $page = $wp_query->get('page') ) ) && $page > 1 ) {
    $c[] = 'paged-' . $page;
    if ( is_single() ) {
      $c[] = 'single-paged-' . $page;
    } elseif ( is_page() ) {
      $c[] = 'page-paged-' . $page;
    } elseif ( is_category() ) {
      $c[] = 'category-paged-' . $page;
    } elseif ( is_tag() ) {
      $c[] = 'tag-paged-' . $page;
    } elseif ( is_date() ) {
      $c[] = 'date-paged-' . $page;
    } elseif ( is_author() ) {
      $c[] = 'author-paged-' . $page;
    } elseif ( is_search() ) {
      $c[] = 'search-paged-' . $page;
    }
  }
  
  // A little Browser detection shall we?
  $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
  
  // Mac, PC ...or Linux
  if ( preg_match( "/Mac/", $browser ) ){
      $c[] = 'mac';
    
  } elseif ( preg_match( "/Windows/", $browser ) ){
      $c[] = 'windows';
    
  } elseif ( preg_match( "/Linux/", $browser ) ) {
      $c[] = 'linux';

  } else {
      $c[] = 'unknown-os';
  }
  
  // Checks browsers in this order: Chrome, Safari, Opera, MSIE, FF
  if ( preg_match( "/Chrome/", $browser ) ) {
      $c[] = 'chrome';

      preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
      $ch_version = 'ch' . str_replace( '.', '-', $matches[1] );      
      $c[] = $ch_version;

  } elseif ( preg_match( "/Safari/", $browser ) ) {
      $c[] = 'safari';
      
      preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
      $sf_version = 'sf' . str_replace( '.', '-', $matches[1] );      
      $c[] = $sf_version;
      
  } elseif ( preg_match( "/Opera/", $browser ) ) {
      $c[] = 'opera';
      
      preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
      $op_version = 'op' . str_replace( '.', '-', $matches[1] );      
      $c[] = $op_version;
      
  } elseif ( preg_match( "/MSIE/", $browser ) ) {
      $c[] = 'msie';
      
      if( preg_match( "/MSIE 6.0/", $browser ) ) {
          $c[] = 'ie6';
      } elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
          $c[] = 'ie7';
      } elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
          $c[] = 'ie8';
      }
      
  } elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
      $c[] = 'firefox';
      
      preg_match( "/Firefox\/(\d)/si", $browser, $matches);
      $ff_version = 'ff' . str_replace( '.', '-', $matches[1] );      
      $c[] = $ff_version;
      
  } else {
      $c[] = 'unknown-browser';
  }
  
  

  // Separates classes with a single space, collates classes for BODY
  $c = join( ' ', apply_filters( 'body_class',  $c ) ); // Available filter: body_class

  // And tada!
  return $print ? print($c) : $c;
}

// Generates semantic classes for each post DIV element
function thematic_post_class( $print = true ) {
  global $post, $thematic_post_alt;

  // hentry for hAtom compliace, gets 'alt' for every other post DIV, describes the post type and p[n]
  $c = array( 'hentry', "p$thematic_post_alt", $post->post_type, $post->post_status );

  // Author for the post queried
  $c[] = 'author-' . sanitize_title_with_dashes(strtolower(get_the_author('login')));

  // Category for the post queried
  foreach ( (array) get_the_category() as $cat )
    $c[] = 'category-' . $cat->slug;

  // Tags for the post queried; if not tagged, use .untagged
  if ( get_the_tags() == null ) {
    $c[] = 'untagged';
  } else {
    foreach ( (array) get_the_tags() as $tag )
      $c[] = 'tag-' . $tag->slug;
  }

  // For password-protected posts
  if ( $post->post_password )
    $c[] = 'protected';

  // For sticky posts
  if (is_sticky())
     $c[] = 'sticky';

  // Applies the time- and date-based classes (below) to post DIV
  thematic_date_classes( mysql2date( 'U', $post->post_date ), $c );

  // If it's the other to the every, then add 'alt' class
  if ( ++$thematic_post_alt % 2 )
    $c[] = 'alt';

    // Adds post slug class, prefixed by 'slug-'
    $c[] = 'slug-' . $post->post_name;

  // Separates classes with a single space, collates classes for post DIV
  $c = join( ' ', apply_filters( 'post_class', $c ) ); // Available filter: post_class

  // And tada!
  return $print ? print($c) : $c;
}

// Define the num val for 'alt' classes (in post DIV and comment LI)
$thematic_post_alt = 1;

// Generates semantic classes for each comment LI element
function thematic_comment_class( $print = true ) {
  global $comment, $post, $thematic_comment_alt, $comment_depth, $comment_thread_alt;

  // Collects the comment type (comment, trackback),
  $c = array( $comment->comment_type );

  // Counts trackbacks (t[n]) or comments (c[n])
  if ( $comment->comment_type == 'comment' ) {
    $c[] = "c$thematic_comment_alt";
  } else {
    $c[] = "t$thematic_comment_alt";
  }

  // If the comment author has an id (registered), then print the log in name
  if ( $comment->user_id > 0 ) {
    $user = get_userdata($comment->user_id);
    // For all registered users, 'byuser'; to specificy the registered user, 'commentauthor+[log in name]'
    $c[] = 'byuser comment-author-' . sanitize_title_with_dashes(strtolower( $user->user_login ));
    // For comment authors who are the author of the post
    if ( $comment->user_id === $post->post_author )
      $c[] = 'bypostauthor';
  }

  // If it's the other to the every, then add 'alt' class; collects time- and date-based classes
  thematic_date_classes( mysql2date( 'U', $comment->comment_date ), $c, 'c-' );
  if ( ++$thematic_comment_alt % 2 )
    $c[] = 'alt';

  // Comment depth
  $c[] = "depth-$comment_depth";

  // Separates classes with a single space, collates classes for comment LI
  $c = join( ' ', apply_filters( 'comment_class', $c ) ); // Available filter: comment_class

  // Tada again!
  return $print ? print($c) : $c;
}

// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
function thematic_date_classes( $t, &$c, $p = '' ) {
  $t = $t + ( get_option('gmt_offset') * 3600 );
  $c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
  $c[] = $p . 'm' . gmdate( 'm', $t ); // Month
  $c[] = $p . 'd' . gmdate( 'd', $t ); // Day
  $c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
}

?>