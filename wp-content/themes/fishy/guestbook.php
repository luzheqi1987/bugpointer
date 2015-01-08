<?php
	/*
	Template Name: Guestbook
	*/
?>
<?php get_header(); ?>	
	<section id="content">
	<?php while ( have_posts() ) : the_post() ?>
		<article id="post-<?php the_ID(); ?>" class="single-entry-body" >
			<hgroup>
				<h1 class="entry-title" style="text-align:center;"><?php the_title(); ?></h1>
			</hgroup>
			<div class="entry-meta" style="margin-bottom:5px;">
				<!--<span class="date"><time datetime="<?php the_time('Y-m-d') ?>" pubdate>日期：<?php the_time('Y-m-d') ?> / </time></span>
                <span class="author">作者：<?php the_author_posts_link(); ?> / </span>
                <span class="cats">分类：<?php echo get_the_category_list(', '); ?> / </span>
                <span class="tags">标签：<?php the_tags('',', ','') ?></span>
                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'fishy' ), __( '1 Comment', 'fishy' ), __( '% Comments', 'fishy' ) ) ?></span>
                <?php edit_post_link( __( 'Edit', 'fishy' ), "<span class=\"meta-sep\">/</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>-->
            </div>
			<div class="entry-content">
				<div id="single-ads" style="margin-bottom:5px;"><!--<script type="text/javascript">/*640*60，创建于2012-7-9*/ var cpro_id = 'u975141';</script><script src="http://cpro.baidu.com/cpro/ui/c.js" type="text/javascript"></script>--></div>
				<?php the_content(); ?>
			</div>					
			<!--<div class="entry-utility-single">
				<p style="text-indent:0px;margin-bottom:0px;">本篇文章由 <a href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>" ><?php the_author();?> </a>
				撰写，如非注明转载，本站文章均为原创。<br/> 
				转载本站文章请注明来源：<a href="<?php the_permalink();?>" title="<?php the_title();?>" ><?php the_permalink(); ?></a><br/>
				如果喜欢本篇文章，欢迎点击下面捐赠按钮，您的支持将是我最大的动力，谢谢！</p>
			</div>-->
			<!--<div id="ding"><a target="_blank" href="https://me.alipay.com/zhuomuyouyi" >
				<img alt="支付宝捐赠按钮" border="0" src="http://gwyjs.com/wp-content/uploads/2012/04/alipay.jpg"/></a>
			</div>-->
		</article>
		<?php endwhile; ?>
		<div class="navigation-single">
			<!--<div class="nav-previous-single">[上一篇]:<?php if (get_previous_post()) : ?><?php previous_post_link('%link', '%title') ?><?php else: ?>
			<?php _e('亲，没有上一篇啦!'); ?><?php endif; ?></div>
			<div class="nav-next-single">[下一篇]:<?php if (get_next_post()) : ?><?php next_post_link('%link','%title') ?><?php else: ?>
			<?php _e('亲，没有下一篇啦!'); ?><?php endif; ?></div>-->
		</div>				
		<div id="wumiiDisplayDiv"></div>
		<?php comments_template('/guestcomments.php', true); ?>						
	</section>			
<?php get_sidebar(); ?>	
<?php get_footer(); ?>