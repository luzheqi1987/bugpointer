
<div class="sticky_list">
			<ul>
			
<?php 
    $sticky = get_option('sticky_posts'); 
    rsort( $sticky );//对数组逆向排序，即大ID在前 
    $sticky = array_slice( $sticky, 0, 1);//输出置顶文章数，请修改10，0不要动，如果需要全部置顶文章输出，可以把这句注释掉 
    query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) ); 
    if (have_posts()) :while (have_posts()) : the_post();     
?>			   			
		
			<li>
			<h2><span class="date fr"><?php post_views(' ', '<small> ℃ </small>'); ?> | <?php the_time('Y-m-d') ?></span> <span class="zhiding">[置顶]</span><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"> <?php echo cut_str($post->post_title,60); ?></a>			</h2>
			</li>
					
<?php    endwhile; endif; ?> 	
			</ul> 
			</div>