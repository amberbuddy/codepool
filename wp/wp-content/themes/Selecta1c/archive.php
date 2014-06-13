<?php get_header(); ?>
	<article>  
			
				<div id="content">
				
				<div id="pagetitle">
				   <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				   <?php /* If this is a category archive */ if (is_category()) { ?>
					Category Archives: <?php single_cat_title(); ?>
				   <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					标签&nbsp; ”<?php single_tag_title(); ?>“ &nbsp;下的文章
				   <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					Archive for <?php the_time('F jS, Y'); ?>
				   <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					Archive for <?php the_time('Y年F '); ?>
				   <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				Archive for <?php the_time('Y'); ?>
				   <?php /* If this is an author archive */ } elseif (is_author()) { ?>
					Author Archive
				   <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					Blog Archives
				   <?php } ?> 	</div>      
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post"><div class="post-entry">
						<h2><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<div class="post-meta"> <span>
      <?php the_time('Y.m.j'); ?>
      </span> | <span>
      <?php the_category(', ') ?>
      </span> | <span>
      超过<?php if(function_exists('the_views')) { the_views(); } ?>人围观
      </span> | <span>
      <?php comments_popup_link('还没有评论', '只有1条评论', '已有%条评论'); ?>
      </span> </div>
    <!--.postMeta-->									 					
				
							<div class="post-content">
														
							<?php the_content(__('readmore'));?>
					
			
			
				</div>
					</div> 	</div>	
					<?php endwhile; endif;?> 	      
				
	<nav class="pagenavi cf">
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
							<div id="pagenavi"><?php pagenavi(); ?></div>
			<?php endif; ?>
			
		</nav>					
				</div><!--#end content-->	
		<?php get_sidebar(); ?></article>
		
		<?php get_footer(); ?>
	<!--#end layout-->
	