<?php get_header();?>
	<div id="h">
	 <?php qqoq_ad('new')?>
	 <div class="h_l">
	   <ul class="h_c">
			   	<?php 
			   	    $new = get_option('new');
			   	    $a='0';$b='1';$c='2';$d='3';//$a标题;$b描述;$c链接;$d图片
			   	    for ($i=1; $i <=4 ; $i++) { 
			   	?>
				<li>
					<a href="<?php echo $new[$c]?>">
						<img width="110" height="110" title="<?php echo $new[$a]?>" alt="<?php echo $new[$a]?>" src="<?php echo $new[$d]?>"/>
                        <span><?php echo $new[$a]?></span>
						<div class="h_se"><?php echo $new[$b]?></div>
					</a>
				</li>
				<?php $a+=4;$b+=4;$c+=4;$d+=4; }?>
        </ul>
		<ul class="h_tu">
		<?php $a='0';$b='1';$c='2';$d='3'; for ($i=1; $i <=4 ; $i++) {?>			
         <li><a title="<?php echo $new[$a]?>" href="<?php echo $new[$c]?>"><img width="430" height="200" title="<?php echo $new[$a]?>" alt="<?php echo $new[$a]?>" class="qqoq" src="<?php echo $new[$d]?>" /></a></li>   
		<?php $a+=4;$b+=4;$c+=4;$d+=4; }?>
        </ul>
	 </div>
	 <div class="h_r">
	    <div class="h_r_t">
	    	<?php 
	    		$args = array(
	    			'posts_per_page' => 1,
					'post_type' => 'post',
					'meta_query' => array(
						array(
							'key' => 'headline_value',
							'value' => '1',
						)
					)
				 );
				$posts = get_posts( $args );
				if (empty($posts)) {
					$title = "头条新闻";
					$permalink = "";
					$content = "请到文章编辑里设置文章头条";
				}else{	
					$title = $posts[0]->post_title;
					$permalink = get_permalink($posts[0]->ID);
					$content = mb_strimwidth(strip_tags($posts[0]->post_content), 0, 200,"...","utf-8");
				}
	    	?>
	    	<a href="<?php echo $permalink ?>"><?php echo $title ?></a>
	    </div>
	    <div class="h_r_b">
	    	<?php echo $content; ?>
	    </div>
	    <div class="ding">
	    	<a class="good" data-postid="<?php echo $posts[0]->ID ?>" data-grade="like" href="javascript:;"><b>+1</b><i class="ding_good"></i>顶</a>
	    	<a class="bad" data-postid="<?php echo $posts[0]->ID ?>" data-grade="bad" href="javascript:;"><b>-1</b><i class="ding_bad"></i>踩</a>
	    	<div class="dm">
	    		<span class="nvote">不要重复投票哦。</span>
	    		<?php get_post_vote($posts[0]->ID);?>
	    	</div>
	    </div>
	 </div>
	</div>
	<?php include_once('inc/index-q.php'); ?>
	<div id="i">
	  <div class="i_l"></div>
	  <div class="i_r">
	   <a class="ml"></a>
	   <a class="mr"></a>
	    <ul>
    	<?php 
    	    $args = array(
    	    	'post_type'=>'video',
    	    	'posts_per_page' => '14'
            );
			$loop = new WP_Query($args);
			while ( $loop->have_posts() ) : $loop->the_post();
			$url = get_permalink().link_at().'ID='.get_the_ID();
		?>
		 <li><a class="qb fancybox.ajax" href="<?php echo $url; ?>"><img alt="<?php the_title();?>" src="<?php echo get_post_meta(get_the_ID(),'vimg',true);?>" width="125" height="90" /><i></i></a></li>
		<?php endwhile;wp_reset_query(); ?>
		</ul>
	  </div>
	</div>
	<?php
	 	 $ad3_close = get_option('ad3_close');
	 	 if ($ad3_close == 'open') {
	?>
	<div id="ad">
	 	<?php echo get_option('ad3');qqoq_ad('ad3');?>
	</div>
	<?php } ?>
	<div id="j">
	 <?php 
	    $display = get_option('display_model');
        if($display['0']=='blog'){
        	include('inc/blog.php');
        }else{
        	include('inc/cms.php');
        }
	 ?>
	 <?php get_sidebar(); ?>
	</div>
	<div id="o">
	  <div class="o_t">
	   <h2 class="o_b">热门围观</h2>
	  </div>
      <div class="o_o">
	    <ul>
	    	<?php 
	    		$hots = array(
	    	    	'posts_per_page' => '8',
	    	    	'meta_key'       => 'views',
	    	    	'orderby'        => 'meta_value_num'
	            );
	            $shows = get_posts( $hots );
	            foreach ($shows as $post) {
	            	setup_postdata( $post );
	    	?>
		 	<li><a title="<?php the_title();?>" href="<?php the_permalink();?>"><img alt="<?php the_title();?>" src="<?php echo catch_first_image('m') ?>" class="qqoq" /></a><p class="o_p"><a target="_blank" href="<?php the_permalink();?>"><?php the_title();?></a></p></li>
		 	<?php }wp_reset_postdata(); ?>
		</ul>
	  </div>
	</div>
  <?php get_footer(); ?>