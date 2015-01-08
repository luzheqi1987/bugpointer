<?php get_header() ?>
<div id="j">
	<?php 
		//include_once('inc/index-q.php');
		include_once('inc/location.php');
	?>
	<div class="n">
		<div class="newtitle n_s">
	      	<div class="post_date">
		  		<?php if(have_posts()) : while (have_posts()) : the_post();setPostViews(get_the_ID()); ?>
	      		<span class="date_d"><?php the_time('d') ?></span>
	      		<span class="date_y"><?php the_time('Y-m') ?></span>
	      	</div>
	      	<div class="line"></div>
	      	<h2>
	            <a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	            <?php edit_post_link('编辑本文', '  ', '  '); ?>
	            <span class="new">
				          <?php newpost();?>
	            </span>
	      	</h2>
	      	<div class="infotop1">
	       		<span class="info-category-icon">页面</span>
	       		<span class="info-view-icon">你是第<?php echo getPostViews(get_the_ID());?>个围观者</span>
		   		<span class="info-comment-icon"><?php comments_popup_link ('0条评论','1条评论','%条评论'); ?></span>
		   		<span>供稿者：<?php the_author_posts_link(); ?></span>
		   		<?php if(the_tags()){?>
		   		<span class="info-tag-icon"><?php the_tags('标签：', ', ', ''); ?></span>
		   		<?php }?>
	      	</div>
     	</div>
     	<div class="n">
			<?php 
				the_content();
				endwhile;endif;
			?>
		</div>
	</div>
</div>
<?php get_footer() ?>