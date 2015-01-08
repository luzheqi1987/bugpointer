<?php get_header(); ?>
	<div id="wrapper" class="clearfix">
 		<div id="art_container clearfix">
 			<div id="art_main" class="fl"> 
					<?php if (get_option('swt_zhiding') == '显示') { ?>
					<?php include(TEMPLATEPATH . '/flash/list_zhiding.php'); ?>
					<?php } else {echo ''; } ?>
					<?php include(TEMPLATEPATH . '/includes/blog.php'); ?>
			</div><!-- art_main end-->
<?php include_once("sidebar/sidebar.php"); ?>

<?php get_footer(); ?>