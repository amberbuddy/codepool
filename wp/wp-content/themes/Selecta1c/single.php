<?php get_header(); ?>
<?php $options = get_option('Newer_options'); ?>
	<article>        
				
			<div id="content">
			 <div class="post">					
				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>													
				     <div class="post-entry">
				      
					   <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2> 	
					  	 <div class="post-meta"> <span>
      <?php the_time('D,g:h A'); ?>
      </span>&nbsp;|&nbsp;<span>
      <?php the_category(', ') ?>
      </span>&nbsp;|&nbsp;<span>
      超过<?php if(function_exists('the_views')) { the_views(); } ?>人围观
      </span>&nbsp;|&nbsp;<span>
      <?php comments_popup_link('还没有评论', '只有1条评论', '已有%条评论'); ?>
      </span> </div>
    <!--.postMeta-->				
				        <div class="post-content">									
					        <?php the_content(__('Read More'));?>
						</div>
                        <div class="clear"></div>
					
                        <div class="single_tags">													
					
								
						</div>
						
					<?php comments_template( '', true ); ?>

					
				
				<?php endwhile; endif;?>    
				
				<div class="clear"></div></div></div>
			</div>
		
			
		<div class="clear"></div>  
		
	</article>
	  <?php get_footer(); ?>