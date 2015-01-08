<?php get_header(); ?>
<?php include('inc/location.php');?>
<?php
	$current_term = get_queried_object();
	$slug = $current_term->slug;
	$term_id = $current_term->term_id;
	$count = $current_term->count;
	$url = get_term_link( $current_term, 'videos' );
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if (isset($_GET['order']) && $_GET['order'] == "hot") {
		$args = array(
			'paged' => $paged,
			'meta_key' => 'views',
			'orderby' => 'meta_value_num',
			'post_type' => 'video',
			'tax_query' => array(
				array(
					'taxonomy' => 'videos',
					'field' => 'ID',
					'terms' => $term_id
				)
			)
		);
		$current1 = 'class="vcurrent"';
	}elseif (isset($_GET['order']) && $_GET['order'] == "comment") {
		$args = array(
			'paged' => $paged,
			'orderby' => 'comment_count',
			'post_type' => 'video',
			'tax_query' => array(
				array(
					'taxonomy' => 'videos',
					'field' => 'ID',
					'terms' => $term_id
				)
			)
		);
		$current2 = 'class="vcurrent"';
	}else{
		$args = array(
			'paged' => $paged,
			'post_type' => 'video',
			'tax_query' => array(
				array(
					'taxonomy' => 'videos',
					'field' => 'ID',
					'terms' => $term_id
				)
			)
		);
		$current = 'class="vcurrent"';
	}
	query_posts($args);
?>
<div id="j" class="mt20">
	<div class="vl">
		<div class="v_t">
			分类检索
		</div>
		<?php
			$args = array(
				'taxonomy'   => 'videos',
				'title_li'   => "",
				'hide_empty' => 0
			);
  			wp_list_categories( $args );
		 ?>
	</div>
	<div class="vr">
		<div class="v_tab">
			<p class="v_tab_op"><a href="<?php echo $url?>" <?php echo $current ?>>最新</a><a href="<?php echo $url.link_at() ?>order=hot" <?php echo $current1 ?>>最热</a><a href="<?php echo $url.link_at() ?>order=comment" <?php echo $current2 ?>>好评</a></p>
			<p class="v_count">本栏目共有 <?php echo $count?> 个内容</p>
		</div>
		<ul>
		<?php while (have_posts()) : the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" class="vr_img"><img title="<?php the_title() ?>" alt="<?php the_title() ?>" width="160" height="90" src="<?php echo get_post_meta($post->ID,'vimg',true) ?>"><span class="icon_play"></span></a>
				<p class="vtit"><a title="<?php the_title() ?>" class="mv_name" href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
				<p><span class="count"><?php echo getPostViews(get_the_ID());?></span><span class="date"><?php the_time('Y-m-d') ?></span></p>
			</li>
		<?php endwhile; ?>
		</ul>
		<div class="navigation">
			<?php pagination($query_string); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>