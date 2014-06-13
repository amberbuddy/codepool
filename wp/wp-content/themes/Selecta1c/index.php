<?php get_header(); ?>

<article>
  <div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post">
      <div class="post-entry">
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
        <div class="post-meta"> <span>
          <?php the_time('D,g:h A'); ?>
          </span>&nbsp;·&nbsp;<span>
          <?php if(function_exists('the_views')) { the_views(); } ?>
          Views </span>&nbsp;·&nbsp;<span>
          <?php comments_popup_link('No comment', 'Only 1 comment', '% comments'); ?>
          </span> </div>
        <!--.postMeta-->
        <div class="post-content">
          <?php the_content(__('<span>readmore</span>'));?>
        </div>
      </div>
    </div>
    <?php endwhile; endif;?>
    <nav class="pagenavi cf">
      <?php if (  $wp_query->max_num_pages > 1 ) : ?>
      <div id="pagenavi">
        <?php pagenavi(); ?>
      </div>
      <?php endif; ?>
    </nav>
  </div>
  <!--#end content-->
  <script type="text/javascript">
		$("#loadbar").show();
		$("#loadbar div").animate({width:"50%"});
</script>
  <?php get_sidebar(); ?>
</article>
<?php get_footer(); ?>
