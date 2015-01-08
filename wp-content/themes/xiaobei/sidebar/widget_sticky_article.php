<div class="widget widget_sticky_article">		<h3>置顶文章</h3>		<ul>
<?php 
    $sticky = get_option('sticky_posts'); 
    rsort( $sticky );//对数组逆向排序，即大ID在前 
    $sticky = array_slice( $sticky, 0, 5);//输出置顶文章数，请修改5，0不要动，如果需要全部置顶文章输出，可以把这句注释掉 
    query_posts( array( 'post__in' => $sticky, 'caller_get_posts' => 1 ) ); 
    if (have_posts()) :while (have_posts()) : the_post();     
?> 
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo excerpttitle(16);?></a></li>   
<?php    endwhile; endif; ?> 
</ul> 
		</div>
