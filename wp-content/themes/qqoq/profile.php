<?php
/*
Template Name: 用户中心
*/
?>
<?php if(is_user_logged_in()){?>
<?php get_header(); ?>
<div id="m" class="main">
<div class="m_l">
 <ul>
  <li>我的文章</li>
  <?php if (get_option('close') == 'open') {?>
  <li>发布文章</li>
  <?php } ?>
  <li>资料修改</li>
  <li>密码修改</li>
  <li>登录绑定</li>
 </ul>
</div>
<div class="m_r">
 <div class="m_r_t"><h2>个人中心</h2><span>Profile</span></div>
 <div class="m_r_b">
  <ul class="m_se">
   <li>
     <?php include_once('inc/profile/a.php');?>
   </li>
  </ul>
  <?php if (get_option('close') == 'open') {?>
  <ul>
   <li>
     <?php include_once('inc/profile/b.php');?>
   </li>
  </ul>
  <?php } ?>
  <ul>
   <li>
     <?php include_once('inc/profile/c.php');?>
   </li>
  </ul>
  <ul>
   <li>
     <?php include_once('inc/profile/d.php');?>
   </li>
  </ul>
  <ul>
   <li>
     <?php include_once('inc/profile/e.php');?>
   </li>
  </ul>
</div>
</div>
</div>
<?php get_footer(); ?>
<?php }else{
 wp_redirect( home_url() );
 exit;
}?>