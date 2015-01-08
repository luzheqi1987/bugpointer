<div class="widget widget_hot_article">		<h3>热门文章</h3>		<ul>
				<?php $popular = new WP_Query('orderby=comment_count&posts_per_page=10'); ?>   
<?php while ($popular->have_posts()) : $popular->the_post(); ?>   
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo excerpttitle(16);?></a></li>   
<?php endwhile; ?>  
				</ul>
		</div>

