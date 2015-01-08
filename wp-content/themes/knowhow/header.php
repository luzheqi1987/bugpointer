<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta content="width=device-width,minimum-scale=1,maximum-scale=1" name="viewport">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta name="keywords"  content="bug，pointer，指针，异常，错误" />
<meta name="description"  content="bug指针，还有你不知道的bug嘛"/>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body <?php body_class(); ?>>


	    <?php global $user_ID, $user_identity, $user_level ?>
	    <?php if ( $user_ID ) : ?>
		<div class="loginx">
	    <!--欢迎您回来，--> <?php echo $user_identity ?><a href="<?php bloginfo('url') ?>/wp-admin/">后台管理</a><a href="<?php bloginfo('url') ?>/wp-admin/post-new.php">发表文章</a><a href="<?php bloginfo('url') ?>/wp-admin/profile.php">编辑资料</a><a href="<?php echo wp_logout_url(home_url()); ?>">退出</a>
	    <ul>
		<li></li>
		<?php if ( $user_level >= 1 ) : ?>
		<li></li>
		<?php endif // $user_level >= 1 ?>
		<li></li>
		<li></li>
	    </ul>
       </div>
	    <?php elseif ( $user_level >= 0) : ?>
				<div class="login">
		<table border="0" align="center"> 
  <tr><td>
        <li>
          <form name="loginform" id="loginform" action="<?php bloginfo('url') ?>/wp-login.php" method="post">
			<p class="login-username">
                <label for="user_login">用户名:</label>
                <input type="text" name="log" id="user_login" class="input" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" tabindex="10">
                <span class="login-password">
                <label for="user_pass">密码:</label>
                <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" tabindex="20">
                </span><span class="login-remember">
                <label>
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" checked="checked">
                记住我</label>
              </span><span class="login-submit">
              <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="登录 »" tabindex="100">
              <a href="<?php bloginfo('url') ?>/wp-login.php?action=lostpassword" rel="nofollow">忘记密码?</a> <a href="<?php bloginfo('url') ?>/wp-register.php" rel="nofollow">注册</a>
              <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
              </span></p>
		  </form>
            </ul>
        </li>            	
	    <?php endif // get_option('users_can_register') ?>
  </td></tr></table>
         </div>

<!-- #site-container -->
<div id="site-container" class="clearfix">


<!-- #primary-nav-mobile -->



<nav id="primary-nav-mobile">



<a class="menu-toggle clearfix" href="#"><i class="icon-reorder"></i></a>



<?php wp_nav_menu( array('theme_location' => 'primary-nav', 'container' => false, 'menu_class' => 'clearfix', 'menu_id' => 'mobile-menu', )); ?>



</nav>



<!-- /#primary-nav-mobile -->



<!-- #header -->



<header id="site-header" class="clearfix" role="banner">



<div class="container">







<!-- #logo -->



  <div id="logo">



    <?php if (is_front_page()) { ?><h1><?php } ?>



      <a title="<?php bloginfo( 'name' ); ?>" href="<?php echo home_url(); ?>">



      <?php if (of_get_option('st_logo')) { ?>



      <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo of_get_option('st_logo'); ?>">



      <?php } else { ?>



      <?php bloginfo( 'name' ); ?>



      <?php } ?>



      </a>



     <?php if (is_front_page()) { ?></h1><?php } ?>



  </div>



<!-- /#logo -->
<!-- #primary-nav -->



<nav id="primary-nav" role="navigation" class="clearfix">



  <?php if ( has_nav_menu( 'primary-nav' ) ) { ?>



    <?php wp_nav_menu( array('theme_location' => 'primary-nav', 'container' => false, 'menu_class' => 'nav sf-menu clearfix' )); ?>



  <?php } ?>



  </nav>



<!-- #primary-nav -->




</div>



</header>



<!-- /#header -->



		<?php dynamic_sidebar( 'st_ggao_widgets' ); ?>




<!-- #live-search -->



    <div id="live-search">



    <div class="container">



    <div id="search-wrap">



      <form role="search" method="get" id="searchform" class="clearfix" action="<?php echo home_url( '/' ); ?>">



        <input type="text" onFocus="if (this.value == '<?php echo of_get_option('st_search_text'); ?>') {this.value = '';}" onBlur="if (this.value == '')  {this.value = '<?php echo of_get_option('st_search_text'); ?>';}" value="<?php echo of_get_option('st_search_text'); ?>" name="s" id="s" autocapitalize="off" autocorrect="off" autocomplete="off" />



        <i class="live-search-loading icon-spinner icon-spin"></i>



        <button type="submit" id="searchsubmit">



                <i class='icon-search'></i><span><?php _e("Search", "framework") ?></span>



        </button>



      </form>



      </div>



    </div>



    </div>



<!-- /#live-search -->