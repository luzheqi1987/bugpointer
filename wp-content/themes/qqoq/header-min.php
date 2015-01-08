<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico"/>
  <?php include('inc/seo.php'); ?>
  <?php wp_head();?>
  <?php if(current_user_can('level_10')){ ?>
  <link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/admin-i.css" />
  <?php }?>
  <link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.fancybox.css" />
  <link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/jquery.fancybox-buttons.css" />
 </head>
 <body <?php body_class($class); ?>>
  <div id="h_min">
  	<div class="h_log">
  		<div class="h_logo">
  		   <a href="<?php bloginfo('url'); ?>"><img alt="logo" src="<?php echo get_option('logo')?>" /></a>
  	    </div>
  		<?php if(is_user_logged_in()){?>
        <div class="l_n">
		<?php global $current_user;echo qqoq_avatar($current_user->ID);?>
		<div class="l_l_l">
		欢迎<?php echo $current_user->display_name ?>回来<br>
		进入我的 <a href="<?php echo get_page_slug_link('m')?>">[ 个人中心 ]</a> | <a href="<?php echo wp_logout_url(selfURL());?>">[ 退出 ]</a>
		</div>
		</div>
	  <?php }else{?>
	   <div class="l_l">
	    <a class="l_q qb" href="#login">+ 立即登录</a>
	    <a class="l_s" href="<?php echo get_page_slug_link('r')?>">+ 快速注册</a>
	   </div>
	  <?php }?>
	 <?php if(!is_user_logged_in()){?>
	 <div id="login" style="display:none;">
       <?php wp_login_form();?>
	   <i></i>
	   <a class="login_qq" href="<?php echo get_bloginfo('template_url').'/qq_login.php?r='.selfURL();?>"></a>
	   <a class="login_sina" href="<?php echo get_bloginfo('template_url').'/sina_login.php?r='.selfURL();?>"></a>
     </div>
	 <?php }?>
  	</div>
  </div>
  <div class="h_nav">
	  <?php 
		  wp_nav_menu(
		   array(
		    'theme_location'  => 'nav-menu',
		    'container' => '',
			'menu_class' => 'nav',
		   )
		  );
	  ?>
  </div>
  <div id="b">
   <div id="n" class="p0">