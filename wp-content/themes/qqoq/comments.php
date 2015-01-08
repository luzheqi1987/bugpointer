<?php  
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // 如果文章有密码
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // 且密码不匹配
			echo '<p class="nocomments">必须输入密码，才能查看评论！</p>';
			return;
		}
	}
?>
<div id="respond_box">
	<div id="respond" class="ncom">
		<?php 
			$current_userid = get_current_user_id();
			$current_username =  get_user_meta($current_userid, 'first_name', true);
			$current_userurl = get_author_posts_url($current_userid);
		?>
		<div class="qqoq-avatar">
			<a href="<?php echo $current_userurl; ?>" title="<?php echo $current_username ?>" target="_blank"><?php echo qqoq_avatar(get_current_user_id()) ?></a>
		</div>
		<div class="qqoq-comment">
			<a title="<?php echo $current_username ?>" href="<?php echo $current_userurl; ?>" target="_blank" class="comment-name"><?php echo $current_username ?></a>
			<form class="qform" method="post" action="">
				<div class="comment-form" contenteditable="true"></div>
				<div class="comment-info c100">
					<div class="coml">
						<div class="smiley">
							<div class="smp">
								<?php include('inc/smiley.php'); ?>
							</div>
						</div>
						<a class="sm"></a>
						<span>小提示：直接粘贴图片到输入框试试</span>
					</div>
					<div class="comr">
						<div class="loadcom Validform_loading">努力发送中...</div>
						<input type="submit" class="comment-submit" value="提交评论"/>
						<input type="hidden" class="qqoq_nonce" name="nonce" value="<?php echo wp_create_nonce('qqoq_comment'.$post->ID);?>"/>
						<input type="hidden" name="postid" value="<?php echo $post->ID;?>"/>
						<input class="replyid" type="hidden" name="replyid" value="0"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="com">
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=qqoq_comment&end-callback=qqoq_end_comment&max_depth=3'); ?>
	</ol>
</div>