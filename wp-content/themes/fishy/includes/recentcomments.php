<?php
class RecentCommentsWidget extends WP_Widget
{
  function RecentCommentsWidget()
  {
    $widget_ops = array('classname' => 'RecentCommentsWidget', 'description' => 'fishy主题定制版最新评论小工具' );
    $this->WP_Widget('RecentCommentsWidget', '最新评论', $widget_ops);
  }
 
  function form($instance)
  {
   $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">标题: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

   <p><label for="<?php echo $this->get_field_id('number'); ?>">评论数目：</label>
   <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="5" /></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['number'] = (int)$new_instance['number'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
   $title = empty($instance['title']) ? '最新评论' : apply_filters('widget_title', $instance['title']);
 if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 	$number = 10;?>
  <?php echo $before_widget; ?>
  <?php if ( $title ) echo $before_title . $title . $after_title; ?>
  <ul>
    <?php
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID,user_id, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,18) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND user_id != '1' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
foreach ($comments as $comment) {
$output .= "\n<li>".get_avatar($comment->comment_author_email, 24). " <a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"" . $comment->post_title . " 上的评论\">". strip_tags($comment->com_excerpt) ."</a><br /><div class='comment_author'>by " . $comment->comment_author . "</div></li>";
}
$output .= $post_HTML;
$output = convert_smilies($output);
echo $output;
?>
	</ul>
    <?php echo $after_widget;
  } 
}
add_action( 'widgets_init', create_function('', 'return register_widget("RecentCommentsWidget");') );?>