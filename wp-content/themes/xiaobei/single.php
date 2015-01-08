<?php get_header(); ?>
<div id="wrapper" class="clearfix">
	<div id="breadcrumbs" class="con_box clearfix">
		<div class="bcrumbs"><strong><a href="<?php bloginfo('home'); ?>" title="返回首页">home</a></strong>
		<?php the_category(multiple); ?>
		<a><?php the_title(); ?></a>
		</div>
		
		<?php if (get_option('swt_bdshare') == '显示') { ?>
					<?php include(TEMPLATEPATH . '/flash/list_bdshare.php'); ?>
					<?php } else {echo ''; } ?>
					
		
	</div>
 	<div id="art_container clearfix">
 		<div id="art_main1" class="art_white_bg fl"> 
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="art_title clearfix">
			
		        

				<h1 align="center"><?php the_title(); ?></h1>
				<div class="jiange"></div>
				<div class="b2"></div>
				<p class="info" align="center">
				<small>时间 : <?php the_time('y-m-d'); ?> </small>
				<small>栏目 : <?php the_category(', ') ?> </small>
				<small>作者 : <?php the_author(); ?> </small>
				<small>评论 : <?php comments_number('0','1','%'); ?></small>
				<small>点击 : <?php post_views(' ', ' 次'); ?></small>
				<?php edit_post_link( __('[编辑文章]')); ?>
				</p><!-- /info -->  
			</div>
			<div class="article_content">
				
				<?php if (get_option('swt_adr') == '关闭') { ?>
				<?php { echo ''; } ?>
				<?php } else { include(TEMPLATEPATH . '/includes/adr.php'); } ?>
				<div class="clear"></div>
				<?php the_content(); ?> 
				<?php if (get_option('swt_adt') == '关闭') { ?>
				<?php { echo ''; } ?>
				<?php } else { include(TEMPLATEPATH . '/includes/adt.php'); } ?>
				<div class="clear"></div>
            			<?php   $custom_fields = get_post_custom_keys($post_id);
				if (!in_array ('copyright', $custom_fields)) : ?>
				
				<?php the_tags('<p><strong>本文标签</strong>： ', ' , ','</p>' ); ?>
				
				
					<p> 除非注明，文章均为(<a href="<?php bloginfo('home'); ?>"> <?php the_author(); ?> </a>)原创，转载请保留链接: <a href="<?php the_permalink()?>" title=<?php the_title(); ?>><?php the_permalink()?></a></p>
			<?php endif; ?>
				</div><!--正文--> 
			<div class="con_pretext clearfix">
					<ul>
						<li class="first">上一篇：<?php previous_post_link('%link') ?> </li>
						<li class="last">下一篇：<?php next_post_link('%link') ?></li>
					</ul>
			</div><!--上一页 下一页-->              
			<?php if (comments_open()) comments_template( '', true ); ?>
				<?php if (get_option('swt_adc') == '关闭') { ?>
				<?php { echo ''; } ?>
				<?php } else { include(TEMPLATEPATH . '/includes/ad_c.php'); } ?>
				<div class="clear"></div>
		</div><!--内容-->

			<?php endwhile; ?>
	</div>
		<div class="clear"></div>

<?php include_once("sidebar/sidebar_single.php"); ?>

<?php get_footer(); ?>