<?php
class hotPostWidget extends WP_Widget
{
  function hotPostWidget()
  {
    $widget_ops = array('classname' => 'hotPostWidget', 'description' => 'fishy主题定制版热门日志小工具' );
    $this->WP_Widget('hotPostWidget', '热门日志', $widget_ops);
  }
 
  function form($instance)
  {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	$interval = isset($instance['interval']) ? absint($instance['interval']) : 15;
	$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">标题: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

 <p><label for="<?php echo $this->get_field_id('interval'); ?>">时间间隔（天）:</label>
   <input id="<?php echo $this->get_field_id('interval'); ?>" name="<?php echo $this->get_field_name('interval'); ?>" type="text" value="<?php echo $interval; ?>" size="3" /></p>

   <p><label for="<?php echo $this->get_field_id('number'); ?>">文章数目:</label>
   <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php } 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['interval'] = (int)$new_instance['interval'];
	$instance['number'] = (int)$new_instance['number'];
    return $instance;
  } 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
   $title = empty($instance['title']) ? '热门日志' : apply_filters('widget_title', $instance['title']);
   if ( empty( $instance['interval'] ) || ! $interval = absint( $instance['interval'] ) )
 	$interval = 10;
 if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 	$number = 10;?>
  <?php echo $before_widget; ?>
  <?php if ( $title ) echo $before_title . $title . $after_title; ?>
  <ul>
<?php
global $wpdb;
$today = date("Y-m-d H:i:s");
$daysago = date("Y-m-d H:i:s",strtotime(date('Y-m-j H:i:s')) - ($interval * 24 * 60 * 60));  //Today - $days
$result = $wpdb->get_results("SELECT comment_count,ID,post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $number ");
foreach ($result as $topten) {
    $postid = $topten->ID;
    $title = $topten->post_title;
    $commentcount = $topten->comment_count;
    if ($commentcount != 0) {
	?>
 <li><a href="<?php echo get_permalink($postid); ?>"><?php echo $title ?></a></li>
 <?php }}?></ul>
    <?php echo $after_widget;
  } 
}
add_action( 'widgets_init', create_function('', 'return register_widget("hotPostWidget");') );?>
