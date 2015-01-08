<?php get_header(); ?>
	
<div id="wrapper" class="clearfix">

	<div id="breadcrumbs" class="con_box clearfix">
		<div class="bcrumbs"><strong><a href="<?php bloginfo('home'); ?>" title="返回首页">home</a></strong>
		<a><?php the_title(); ?></a>
		</div>
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
				<small>作者 : <?php the_author(); ?> </small>
				<small>评论 : <?php comments_number('0','1','%'); ?></small>
				<small>点击 : <?php post_views(' ', ' 次'); ?></small>
				<?php edit_post_link( __('[编辑文章]')); ?>
				</p><!-- /info -->  
			</div>
			
			<div class="article_content">
				<?php the_content(); ?>
			</div><!--正文-->          
                       
			<?php if (comments_open()) comments_template( '', true ); ?>
		</div><!--内容-->

			<?php endwhile; ?>

	</div>
		<div class="clear"></div>

<?php include_once("sidebar/sidebar_single.php"); ?>

<?php get_footer(); ?>