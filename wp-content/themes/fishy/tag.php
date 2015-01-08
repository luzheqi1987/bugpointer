<?php get_header(); ?>
	<section id="content">
		<h1 class="page-title">Tag Archives:<span><?php single_tag_title() ?></span></h1>
		<?php while ( have_posts() ) : the_post() ?>
        <article id="post-<?php the_ID(); ?>" class="index-entry-body" >
			<hgroup class="index-entry-hgroup">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</hgroup>
            <div class="entry-meta">
                <span class="date"><time datetime="<?php the_time('Y-m-d') ?>" pubdate>日期：<?php the_time('Y-m-d') ?> / </time></span>
                <span class="author">作者：<?php the_author_posts_link(); ?> / </span>
                <span class="cats">分类：<?php echo get_the_category_list(', '); ?> / </span>
                <span class="tags">标签：<?php the_tags('',', ','') ?></span>
                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'fishy' ), __( '1 Comment', 'fishy' ), __( '% Comments', 'fishy' ) ) ?></span>
                <?php edit_post_link( __( 'Edit', 'fishy' ), "<span class=\"meta-sep\">/</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
            </div>
			<div class="entry-content">
				<div class="thumbnail">  
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<img src="<?php bloginfo('template_url'); ?>/images/random/<?php echo rand(1,10)?>.jpg" style="padding:4px;border:1px #ececec solid;" alt="<?php the_title(); ?>"/>
					</a>
					<span class="shadowimg236"></span>
				</div>
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 450, "…");?>
			</div>
        </article> 
		<?php endwhile; ?>
	<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
         <div id="nav-below" class="navigation">
              <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'fishy' )) ?></div>
              <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'fishy' )) ?></div>
         </div>
	<?php } ?>
</section>
<?php get_sidebar();?>	
<?php get_footer();?> 