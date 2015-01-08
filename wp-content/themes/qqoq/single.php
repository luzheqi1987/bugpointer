<?php get_header();?>
<?php include('inc/location.php');?>
<div id="j">
    <div id="f">
	 <div class="n">
	    <div class="newtitle n_s">
          <div class="post_date">
          <?php if(have_posts()) : while (have_posts()) : the_post();setPostViews(get_the_ID()); ?>
            <span class="date_d"><?php the_time('d') ?></span>
            <span class="date_y"><?php the_time('Y-m') ?></span>
          </div>
          <div class="line"></div>
          <h1>
              <a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              <?php edit_post_link('编辑本文', '  ', '  '); ?>
              <span class="new">
                  <?php newpost();?>
              </span>
          </h1>
          <div class="infotop1">
            <span class="info-category-icon"><?php the_category(', ') ?></span>
            <span class="info-view-icon">你是第<?php echo getPostViews(get_the_ID());?>个围观者</span>
          <span class="info-comment-icon"><?php comments_popup_link ('0条评论','1条评论','%条评论'); ?></span>
          <span>供稿者：<?php the_author_posts_link(); ?></span>
          <?php if(the_tags()){?>
          <span class="info-tag-icon"><?php the_tags('标签：', ', ', ''); ?></span>
          <?php }?>
          </div>
      </div>
	 <div class="n_n">
       <?php the_content(); ?>
	 </div>

	 <div class="quote">
	 	<div class="quote1">
		 	<div class="quote_desc">
		 	    <?php 
		 			if(get_the_author_meta("description") != ""){
		 				the_author_meta("description");
		 			}else{
		 				echo "这家伙很懒，什么都没写！";
		 			}
		 		?>
		 	    <p class="author_meta">—— <?php the_author_meta("display_name");?></p>
		    </div>
		    <div class="quote2"></div>
	    </div>
	    <div class="quote3">
	    	<?php echo qqoq_avatar($post->post_author,'80');?>
	    </div>
	 </div>

	<?php  
	 	$tag = get_the_terms($post->ID,'post_tag');
	 	if(!empty($tag)){
	 		foreach ($tag as $tags) {
           		$arr[] = $tags->term_id;
         	}
         	$args = array(
          		'posts_per_page' => 6,
          		'post__not_in' => array($post->ID),
          		'orderby' => 'rand',
          		'tax_query' => array(
		            array(
		              'taxonomy' => 'post_tag',
		              'terms' => $arr,
		            )
          		)
         	);
         	$query = new WP_Query( $args );
	 		if ($query->have_posts()) {
	?>
	<div class="relt">你可能也喜欢<span>Related Posts</span></div>
	<div class="related">
	 	<?php
         	$i = 1;
         	while ( $query->have_posts() ) : $query->the_post();
         	$i == 6?$pdn = "class='pdn'" : $pdn = "";
          	echo "<li ".$pdn."><a href=".get_permalink()."><span><img alt='".get_the_title()."' src='".catch_first_image('m')."'/></span>".get_the_title()."</a></li>";
          	$i++;
         	endwhile;wp_reset_query();
        ?>
	</div>
	<?php }}?>
	 <div class="relt">众说纷纭<span>Comments</span></div>
	 <div class="p">
	  <?php comments_template(); ?>
	 </div>
	 </div>
	</div>
	<?php endwhile; endif; ?>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>