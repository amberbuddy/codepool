<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<title>
<?php
        /*
       * Print the <title> tag based on what is being viewed.
       */
        global $page, $paged;

        wp_title('|', true, 'right');

        // Add the blog name.
        bloginfo('name');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page()))
            echo " | $site_description";

        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'android'), max($paged, $page));

        ?>
</title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Posts" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - All Comments" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="Shortcut Icon" href="<?php bloginfo('template_directory');?>/images/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
<!--[if IE 6]>
<html id="ie6" class="is_ie" <?php language_attributes(); ?>>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="is_ie" <?php language_attributes(); ?>>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/hack/ie7.css" type="text/css" media="all" />
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="is_ie" <?php language_attributes(); ?>>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>	
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="is_ie" <?php language_attributes(); ?>>
<![endif]-->
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>

</head>
<body <?php body_class(); ?>>
<header>  

  <div class="header-inner">
    <h1><a href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>" class="logo">
      <?php bloginfo('name');?>
      </a></h1>
    
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu','menu_id'=>'nav','container'=>'ul')); ?>
    
	
  </div>

</header>

