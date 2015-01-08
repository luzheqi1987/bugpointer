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
 </head>
 <body <?php body_class($class); ?>>
  <div id="b">
   <div id="n">
    <div id="l">
	  <div class="l_g">
	    <a href="<?php bloginfo('url'); ?>"><img alt="logo" src="<?php echo get_option('logo')?>" /></a>
		<?php qqoq_ad('logo')?>
	  </div>
	  <?php if(is_user_logged_in()){?>
        <div class="l_x">
		<?php global $current_user;echo qqoq_avatar($current_user->ID);?>
		<div class="l_l_l">
		欢迎<?php echo $current_user->display_name ?>回来<br>
		进入我的 <a href="<?php echo get_page_slug_link('m')?>">[ 个人中心 ]</a> | <a href="<?php echo wp_logout_url(selfURL());?>">[ 退出 ]</a>
		</div>
		</div>
	  <?php }else{?>
	   <div class="l_l l_l_x">
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
	<div id="d">
	 <?php 
	  if(has_nav_menu('nav-menu')){
	  	wp_nav_menu(
		   array(
		    'theme_location'  => 'nav-menu',
		    'container' => '',
			'menu_class' => 'nav',
		   )
	  	);
	  }else{
	  		echo "<ul class='nav'><li><a href='".get_bloginfo('url')."/wp-admin/nav-menus.php'>还没有设置导航菜单，请到后台 外观->菜单 设置一个导航菜单</a></li></ul>";
	  }
	 ?>
	 <div id="search">	
       <div class="search_site">	
			<form action="<?php bloginfo('home'); ?>" method="get" id="searchform">
				<input type="submit" class="button" id="searchsubmit" value=""/>
				<input type="text" value="试试手气..." name="s" id="s" onblur="if(this.value=='') this.value='试试手气...';" onfocus="if(this.value=='试试手气...') this.value='';"/>
			</form>
	   </div>
	 </div>
	</div>