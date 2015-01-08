<div id="q">
	<div class="ql">
		<p class="qp">推荐</p>
		<ul>
			<?php 
				$sticky = get_option( 'sticky_posts' );
				$ary = array(
					'posts_per_page' => 8,
					'post__in'    => $sticky,
					'ignore_sticky_posts' => 1
				);
				$the_query = new WP_Query($ary);
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$cats = get_the_category( $post->ID );
					foreach ($cats as $cat) {
						$catid = $cat->term_id;
					}
			?>
			<li><a class="ncat to" href="<?php echo get_category_link($catid) ?>"><?php echo get_cat_name($catid); ?></a><a class="nt to" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile;wp_reset_postdata(); ?>
		</ul>
	</div>
	<div class="qr">
		<p class="qp">最新</p>
		<div class="qr_l">
			<ul>
				<?php 
					$newposts = get_posts('numberposts=2');
					foreach($newposts as $post) : setup_postdata( $post );
				?>
				<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img alt="<?php the_title_attribute(); ?>" class="qqoq" src="<?php echo hot_thumbnail_image() ?>" /></a><p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></li>
				<?php endforeach;wp_reset_postdata(); ?>
			</ul>
		</div>
		<div class="qr_r">
			<ul>
				<?php 
					$new1posts = get_posts('numberposts=9&offset=2');
					foreach($new1posts as $post) : setup_postdata( $post );
				?>
				<li><a class="to" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach;wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>
	<div class="qn">
		<div class="qn_c">
			<?php echo get_option('ad8')?>
		</div>
		<?php qqoq_ad('ad8')?>
	</div>
</div>