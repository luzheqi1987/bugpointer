<div class="g_s">
       <div class="g_a">
		<ul class="g_se">
		 <li>评论最多</li>
		 <li>最新评论</li>
		 <li>随机文章</li>
		</ul>
	   </div>
	   <div class="g_b">
		<ul>
		 	<?php 
		 		$cposts = get_posts('numberposts=10&orderby=comment_count');
		 			foreach($cposts as $post) :?>
		 		<li><a href="<?php echo get_permalink($post->ID); ?>" title="详细阅读<?php echo $post->post_title;?>"><?php echo $post->post_title?></a></li>
		 	<?php endforeach;?>
		</ul>
		<ul class="g_p">
		<?php
			$gs = array(
				'status' => 'approve',
				'number' => '10',
			);
			$comments = get_comments( $gs );
			foreach ($comments as $comment) {
				$comment_ID = $comment->comment_ID;
				echo "<li>".get_avatar(get_comment_author_email(), 32).$comment->comment_author." 在 《<a class='qfl' href='".get_permalink($comment->comment_post_ID)."'>".get_the_title($comment->comment_post_ID)."</a>》<br /><a href='".get_permalink($comment->comment_post_ID)."#comment-{$comment->comment_ID}' title='查看{$comment->post_title}'>".convert_smilies(strip_tags($comment->comment_content))."</a></li>";
			}
		?> 
		</ul>
		<ul>
		 <?php $myposts = get_posts('numberposts=10&orderby=rand');foreach($myposts as $post1) :?>
		 <li><a href="<?php echo get_permalink($post1->ID); ?>" title="详细阅读<?php echo $post1->post_title;?>"><?php echo $post1->post_title?></a></li>
		<?php endforeach; ?>
		</ul>
	   </div>
</div>