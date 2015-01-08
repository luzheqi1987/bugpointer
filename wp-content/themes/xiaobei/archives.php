<?php
/*
Template Name: archives
*/
?>
<?php get_header(); ?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/archives.js"></script>
	
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
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="article_content">
				<?php zww_archives_list(); ?>
			</div><!--正文-->          
                       
			
		</div><!--内容-->

			<?php endwhile; ?>

	</div>
		<div class="clear"></div>

<?php include_once("sidebar/sidebar_single.php"); ?>

<?php get_footer(); ?>