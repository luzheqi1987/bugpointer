<?php
class ActiveReaderWidget extends WP_Widget
{
  function ActiveReaderWidget()
  {
    $widget_ops = array('classname' => 'ActiveReaderWidget', 'description' => 'fishy主题定制版读者墙小工具' );
    $this->WP_Widget('ActiveReaderWidget', '读者墙', $widget_ops);
  }
 
  function form($instance)
  {
   $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	$number = isset($instance['number']) ? absint($instance['number']) : 15;
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">标题: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

   <p><label for="<?php echo $this->get_field_id('number'); ?>">统计时间（天）：</label>
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
   $title = empty($instance['title']) ? '读者墙' : apply_filters('widget_title', $instance['title']);
 if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 	$number = 15;?>
  <?php echo $before_widget; ?>
  <?php if ( $title ) echo $before_title . $title . $after_title; ?>
  <ul>
    <?php
	 global $wpdb;
$counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author,user_id, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL $number DAY ) AND user_id!='1' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author ORDER BY cnt DESC LIMIT 15");
foreach ($counts as $count) {
$c_url = $count->comment_author_url;
if ($c_url == '') $c_url = 'http://gwyjs.com/';
$mostactive .= '<li class="mostactive">' . '<a href="'. $c_url . '" title="' . $count->comment_author . ' ('. $count->cnt . 'comments)">' . get_avatar($count->comment_author_email, 40) . '</a></li>';
}
echo $mostactive;
?>
	</ul>
    <?php echo $after_widget;
  } 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ActiveReaderWidget");') );?>