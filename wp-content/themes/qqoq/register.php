<?php
/*
Template Name: 注册页面
*/
?>
<?php if(!is_user_logged_in()){?>
<?php get_header(); ?>
<div id="r">
 <div class="r_t">
  <h3>注册帐号</h3><span>Register</span>
 </div>
 <div class="r_c">
  <div class="r_l">
   <div class="r_v"><em></em> 橘黄色部分为必填</div>
   <form class="info" method="post" action="?action=qqoq">
    <p><span class="r_s r_b_s">登&nbsp;&nbsp;录&nbsp;&nbsp;名</span><input nullmsg="请输入登录名，登录名只作为登录时使用" datatype="s" name="reg_login_name" type="text" value="" ajaxurl="<?php bloginfo('template_url'); ?>/inc/oq.php"/><span class="Validform_checktip"></span></p>
    <p><span class="r_s r_b_s">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</span><input nullmsg="请输入昵称，昵称用于在本站显示" datatype="*" name="reg_name" type="text" value="" /><span class="Validform_checktip"></span></p>
  <p><span class="r_s r_b_s">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</span><input datatype="*6-16" errormsg="密码范围在6~16位之间！" nullmsg="请设置密码！" type="password" name="reg_pw" value="" /><span class="Validform_checktip"></span></p>
    <p><span class="r_s r_b_s">再输一遍</span><input datatype="*" recheck="reg_pw" errormsg="您两次输入的账号密码不一致！" nullmsg="请再输入一次密码！" type="password" name="reg_tpw" value="" /><span class="Validform_checktip"></span></p>
    <p><span class="r_s r_b_s">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</span><input nullmsg="请输入邮箱，必须填写，可用于找回密码" datatype="e" type="text" name="reg_email" value="" ajaxurl="<?php bloginfo('template_url'); ?>/inc/oq.php" /><span class="Validform_checktip"></span></p>
    <p><span class="r_s">网&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址</span><input ignore="ignore" datatype="url" type="text" name="reg_url" value="" /><span class="Validform_checktip"></span></p>
    <p class="m0"><span class="r_s">描&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;述</span><textarea name="reg_des" onKeyDown="gbcount(this.form.reg_des,this.form.remain);" onKeyUp="gbcount(this.form.reg_des,this.form.remain);"></textarea></p>
    <p class="m1">
    <span>你还可以输入</span>
    <input class="max" disabled name="remain" value="140">
    <span>字</span>
    </p>
    <input type="hidden" name="random_pass" value="<?php echo wp_create_nonce('qqoq_pass');?>"/>
    <p class="m2"><input class="reg_save" type="submit" name="reg_save" value="确认注册" /><span style="margin-left:30px;" id="msgdemo"></span></p>
   </form>
  </div>
  <div class="r_r">
   <div class="r_r_r">已有帐号？</div>
   <span class="r_r_s"></span>
   <div class="r_r_l">
    <a class="r_r_l_q qb" href="#login">+ 立即登录</a>
    <a class="r_r_l_d" href="<?php echo get_bloginfo('template_url').'/qq_login.php?r='.get_bloginfo('url');?>"><img src="<?php bloginfo('template_directory'); ?>/img/icon_qq.png" alt="qq_login"></a>
    <a class="r_r_l_d" href="<?php echo get_bloginfo('template_url').'/sina_login.php?r='.get_bloginfo('url');?>"><img src="<?php bloginfo('template_directory'); ?>/img/icon_sina.png" alt="sina_login"></a>
   </div>
   <div class="r_r_a">
      <span class="r_r_p">随便看看</span>
    <div class="g_b r_r_pd">
      <ul>
     <?php $myposts = get_posts('numberposts=10&orderby=rand');foreach($myposts as $post) :?>
     <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,37); ?></a></li><?php endforeach; ?>
    </ul>
    </div>
   </div>
  </div>
 </div>
</div>
<?php get_footer(); ?> 
<?php }else{
  wp_redirect( home_url() );
  exit;
}?>