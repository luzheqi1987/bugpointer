<?php
class RandomPostWidget extends WP_Widget
{
  function RandomPostWidget()
  {
    $widget_ops = array('classname' => 'RandomPostWidget', 'description' => 'fishy主题定制版随机日志小工具' );
    $this->WP_Widget('RandomPostWidget', '随机日志', $widget_ops);
  }
 
  function form($instance)
  {
   $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
	$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">标题: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>

   <p><label for="<?php echo $this->get_field_id('number'); ?>">文章数目：</label>
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
 
     $title = empty($instance['title']) ? '随机文章' : apply_filters('widget_title', $instance['title']);
 if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 	$number = 10;
 
    $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true,'orderby'=>rand ) ) );
	if ($r->have_posts()) : ?>
 <?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
 <?php endif; wp_reset_query();?>
 <?php }}
add_action( 'widgets_init', create_function('', 'return register_widget("RandomPostWidget");') );?>