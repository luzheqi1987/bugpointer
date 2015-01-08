<?php
class TagscloudWidget extends WP_Widget
{
  function TagscloudWidget()
  {
    $widget_ops = array('classname' => 'TagscloudWidget', 'description' => 'fishy主题定制版标签云小工具' );
    $this->WP_Widget('TagscloudWidget', '标签云', $widget_ops);
  }
 
  function form($instance)
  {
   $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
   $num = isset($instance['num']) ? absint($instance['num']) : 15;
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">标题: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  
  <p><label for="<?php echo $this->get_field_id('num'); ?>">标签数目：</label>
   <input id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo $num; ?>" size="3" /></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['num']=$new_instance['num'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
   $title = empty($instance['title']) ? '标签云' : apply_filters('widget_title', $instance['title']);
   if ( empty( $instance['num'] ) || ! $num= absint( $instance['num'] ) )
 	$num=10;?>
  <?php echo $before_widget; ?>
  <?php if ( $title ) echo $before_title . $title . $after_title; ?>
  <div id="tagcloud">
    <?php wp_tag_cloud(array('smallest'=>9,'largest'=>9,'orderby'=>count,'order'=>DESC,'number'=>$num)); ?><script>jQuery(document).ready(function($){
    $('#tagcloud a').each(function(){
        var num=$(this).attr('title').split(' ')[0]; //获取标签里面的title值
        var a=$(this).html()+' <span class="tag_num">'+num+'</span>'; //然后是标签的名插入此标签的文章数
        $(this).html(a); //最后是改变标签名
    });
})</script></div>
    <?php echo $after_widget;
  } 
}
add_action( 'widgets_init', create_function('', 'return register_widget("TagscloudWidget");') );?>