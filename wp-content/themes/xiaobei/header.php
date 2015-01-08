<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php if (is_home() ) {?><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?><?php } else {?><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?> <?php } ?></title>
	<?php if (is_home())
	{
	$description = get_option('swt_description');
	$keywords = get_option('swt_keywords');
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
	elseif (is_single())
	{
     if ($post->post_excerpt) {$description = $post->post_excerpt;} 
	 else {$description = substr(strip_tags($post->post_content),0,240);}
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {$keywords = $keywords . $tag->name . ", ";}
	}
	?>
	<meta name="keywords" content="<?php echo $keywords ?>" />
	<meta name="description" content="<?php echo $description?>" />
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon.ico"/>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery_muchun.js"></script>
	<!--[if IE 6]>
	<link href="<?php bloginfo('template_url'); ?>/ie6.css" rel="stylesheet" type="text/css" />
	<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body>


 <!-- top strip #end -->
		
		
		
		<div id="header">
        	<div id="header_in">
            	
                                
                  <div class="logo"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" ><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="看互联" /></a>
        		  </div>
				  <!-- <div class="poptip" >
    <span class="poptip-arrow poptip-arrow-left" ><em>◆</em><i>◆</i></span>
	<p>每天向目标靠近一步！<br />执行力比策略更重要！</p>
	</div> -->
		
		<?php if (get_option('swt_mtyjh') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/mtyjh.php'); } ?>
		
				
        <?php if (get_option('swt_adb') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/ad_b.php'); } ?>
            
            </div>
        </div> <!-- header #end -->
        


		<div id="nav">
        	<div id="nav_in">
				 	
				<?php wp_nav_menu(array( 'theme_location' => 'header-menu' ) ); ?>		
                                <div class="search"><form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
    <input type="text" value="搜索其实很简单 ^_^" name="s" id="s" class="textfield" onfocus="if (this.value == '搜索其实很简单 ^_^') {this.value = '';}" onblur="if (this.value == '') {this.value = '搜索其实很简单 ^_^';}" x-webkit-speech />
    <input type="image" class="b_search" src="<?php bloginfo('template_url'); ?>/images/b_search.png" alt="Submit button" />
  </form> </div>
                
            </div> 
        </div> <!-- nav #end -->

		
	