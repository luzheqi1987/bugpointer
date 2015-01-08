<?php
 if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
 die ('Please do not load this page directly. Thanks!');
 $qq = $wpdb->get_results("SELECT openid FROM $wpdb->users WHERE ID=$userinfo->id");
 $sina = $wpdb->get_results("SELECT uid FROM $wpdb->users WHERE ID=$userinfo->id");
if (empty($qq[0]->openid)) {
	$qq_status = "<span style='color:#fc6440;'>亲，您还没有绑定QQ哦，快点来绑定吧。直接点击QQ图标绑定哦。</span>";
	$is_qq = "<div class='no'></div>";
}else{
	$qq_status = "<span style='color:#82C83C;'>亲，您已经绑定QQ了哦，尽情体验一键登录的快感吧。</span>";
	$is_qq = "<div class='yes'></div>";
}
if (empty($sina[0]->uid)) {
	$sina_status = "<span style='color:#fc6440;'>亲，您还没有绑定新浪微博哦，快点来绑定吧。直接点击新浪微博图标绑定哦。</span>";
	$is_sina = "<div class='no'></div>";
}else{
	$sina_status = "<span style='color:#82C83C;'>亲，您已经绑定新浪微博了哦，尽情体验一键登录的快感吧。</span>";
	$is_sina = "<div class='yes'></div>";
}
?>
<div class="seo">
<p class="sp"><i class="sb">温馨提示</i>为了方便您登录本站，请使用您的QQ或新浪微博帐号绑定本站帐号，下次便可以体验一键登录的快感。</p>
<div class="qq_bd">
	<a href="<?php echo get_bloginfo('template_url').'/connect/qq_login.php?r='.selfURL();?>"><img alt="qq_login" src="<?php bloginfo('template_directory'); ?>/img/icon_qq.png"></a>
	<?php echo $is_qq?>
	<span><?php echo $qq_status;?></span>
</div>
<div class="sina_bd">
	<a href="<?php echo get_bloginfo('template_url').'/connect/sina_login.php?r='.selfURL();?>"><img alt="sina_login" src="<?php bloginfo('template_directory'); ?>/img/icon_sina.png"></a>
	<?php echo $is_sina?>
	<span><?php echo $sina_status;?></span>
</div>
</div>