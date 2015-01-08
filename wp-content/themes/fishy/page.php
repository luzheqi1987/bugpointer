<?php get_header(); ?>	
	<section id="content">
	<?php while ( have_posts() ) : the_post() ?>
		<article id="post-<?php the_ID(); ?>" class="single-entry-body" >
			<hgroup>
				<h1 class="entry-title" style="text-align:center;"><?php the_title(); ?></h1>
			</hgroup>
			<div class="entry-meta" style="margin-bottom:5px;">
				<span class="date"><time datetime="<?php the_time('Y-m-d') ?>" pubdate>日期：<?php the_time('Y-m-d') ?> / </time></span>
                <span class="author">作者：<?php the_author_posts_link(); ?> / </span>
                <?php edit_post_link( __( 'Edit', 'fishy' ), "<span class=\"meta-sep\">/</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
            </div>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>					
		</article>
		<?php endwhile; ?>
		<?php comments_template('', true); ?>						
	</section>			
<?php get_sidebar(); ?>	
<?php get_footer(); ?>