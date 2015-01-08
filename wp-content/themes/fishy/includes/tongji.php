<?php
class StatisticsWidget extends WP_Widget
{
  function StatisticsWidget()
  {
    $widget_ops = array('classname' => 'StatisticsWidget', 'description' => 'fishy主题定制版网站统计小工具' );
    $this->WP_Widget('StatisticsWidget', '网站统计', $widget_ops);
  }
 
  function form($instance)
  {
   $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
   $number = esc_attr($instance['number']);
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">标题: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

   <p><label for="<?php echo $this->get_field_id('number'); ?>">建站日期(XXXX-XX-XX)：</label>
   <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="12" maxlength="10" /></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['number'] = $new_instance['number'];
    return $instance;
  }
 
  function widget($args, $instance)
  {global $wpdb;
    extract($args, EXTR_SKIP);
   $title = empty($instance['title']) ? '网站统计' : apply_filters('widget_title', $instance['title']);
 if ( empty( $instance['number'] ) || ! $number = ( $instance['number'] ) )
 	$number = 2012-01-01;?>
  <?php echo $before_widget; ?>
  <?php if ( $title ) echo $before_title . $title . $after_title; ?>
  <ul style="overflow:hidden;">
		<li style="float:left;width:48%;margin-right:5px">日志总数：<?php $count_posts = wp_count_posts(); echo $published_posts = $count_posts->publish;?>篇</li>
		<li style="float:left;width:48%;margin-right:5px">评论总数：<?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?>条</li>
		<li style="float:left;width:48%;margin-right:5px">分类总数：<?php echo $count_categories = wp_count_terms('category'); ?>个</li>
		<li style="float:left;width:48%;margin-right:5px">标签总数：<?php echo $count_tags = wp_count_terms('post_tag'); ?>个</li>
		<li style="float:left;width:48%;margin-right:5px">建站日期：<?php echo $number ;?></li>
		
		<li style="float:left;width:48%;margin-right:5px">网站运行：<?php echo floor((time()-strtotime("$number"))/86400); ?>天</li>
		<li style="float:left;width:48%;margin-right:5px">最后更新：<?php $last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");$last = date('Y-m-d', strtotime($last[0]->MAX_m));echo $last; ?></li>
		</ul>
    <?php echo $after_widget;
  } 
}
add_action( 'widgets_init', create_function('', 'return register_widget("StatisticsWidget");') );?>