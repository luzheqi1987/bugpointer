<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title>
		<?php
        if ( is_single() ) { single_post_title();print '| ';bloginfo('name'); }
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print '| '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' - Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' - Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); } ?>
	</title>
 
    <?php
	if(is_home()||is_page())
		{
		$description = "";
		$keywords = "";
	    }
	elseif (is_single())
		{
		$description =  mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200, "…");
		if($keywords == '') {
        $tags = wp_get_post_tags($post->ID);    
        foreach ($tags as $tag ) { $keywords = $keywords . $tag->name . ", ";}
			$keywords = rtrim($keywords, ', '); }
		}
	elseif (is_category()) 
		{
		$description = category_description();
		$keywords = single_cat_title('', false);
		}
	elseif (is_tag())
		{
		$description = tag_description();
		$keywords = single_tag_title('', false);
		}
	$description = trim(strip_tags($description));
	$keywords = trim(strip_tags($keywords));
	?>
	<meta name="keywords" content="<?php echo $keywords; ?>" /> 
	<meta name="description" content="<?php echo $description; ?>" />
	<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_url')?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" 
		title="<?php printf( __( '%s latest posts', 'fishy' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" 
		title="<?php printf( __( '%s latest comments', 'fishy' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/menu.css" />
	<script type="text/javascript" src="<?php bloginfo('template_url')?>/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url')?>/js/menu.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url')?>/comments-ajax.js"></script>
    <?php if(is_singular() )	wp_enqueue_script(	'comment-reply'	); ?> 
    <?php wp_head(); ?>
</head> 
<body>
<div id="wrapper">
		<div id="w-loading"><div></div></div>
		<script type="text/javascript">jQuery("#w-loading div").animate({width:"33%"});</script>
    <header id="header">
		<div id="search-box">
			<div id="search-from" class="clearfix">
				<form name="formsearch" method="get" action="<?php bloginfo('home'); ?>">
					<label><input type="text" name="s" id="search-txt" value="" /></label>
					<input type="submit" id="search-btn" value="搜索" />
				</form>
			</div>
		</div>
		<hgroup>
			<h1 id="blog-title"><span><a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a></span></h1>
			<h2 id="blog-description"><?php bloginfo( 'description' ) ?></h2>
		</hgroup>
	</header> 
	<?php wp_nav_menu(array('theme_location'=>'primary','menu'=>'top_menu','container_id'=>'menu','link_before'=>'<span>','link_after'=>'</span>',));?> 
    <div id="wrap">