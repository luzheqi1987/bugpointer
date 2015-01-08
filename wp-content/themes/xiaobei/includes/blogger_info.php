<div class="widget feed-mail">


	<div class="box">
		<ul id="contact-li">
			<li class="qq"><a rel="nofollow" target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo stripslashes(get_option('swt_qq')); ?>" title="有急事请Q我">QQ联系</a></li>
			<li class="email"><a rel="nofollow" target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=f0ZOSk5ISE1ITj8ODlEcEBI" style="text-decoration:none;" title="意见反馈">意见反馈</a></li>
			<li class="qqmblog"><a rel="nofollow" target="_blank" href="<?php echo stripslashes(get_option('swt_qqmblog')); ?>" title="收听我的腾讯微博">腾讯微博</a></li>
			<li class="sinamblog"><a rel="nofollow" target="_blank" href="<?php echo stripslashes(get_option('swt_sinamblog')); ?>" title="收听我的新浪微博">新浪微博</a></li>
			<li class="rss"><a rel="nofollow" target="_blank" href="<?php echo get_option('swt_blogrss'); ?>" title="通过RSS订阅我的博客">RSS订阅</a></li>
		</ul>
	</div>
		<form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">
			<input type="hidden" name="t" value="qf_booked_feedback">
			<input type="hidden" name="id" value="cafc73e1affa08c8138154147122dbe983cb0a89bf40fff1">
			<input id="to" onfocus="if (this.value == '输入QQ邮箱 订阅博客') {this.value = '';}" onblur="if (this.value == '') {this.value = '输入QQ邮箱 订阅博客';}" value="输入QQ邮箱 订阅博客" name="to" type="text" class="feed-mail-input"><input class="feed-mail-btn" type="submit" value="订阅">

		</form>
		<?php if (get_option('swt_info') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/info.php'); } ?>
		<div class="clear"></div>
</div>