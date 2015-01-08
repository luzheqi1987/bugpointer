<?php

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'st_custom_cat_widgets' );


// Register widget.
function st_custom_cat_widgets() {
	register_widget( 'st_custom_cat_widget' );
}

// Widget class.
class st_custom_cat_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function st_custom_cat_widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'st_custom_cat_widget', 'description' => __('A widget that displays the categories with style.', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'st_custom_cat_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'st_custom_cat_widget', __('Custom Category Widget', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;
				?>
                            
                <?php
$args=array(
  'orderby' => 'name',
  'order' => 'ASC'
  );
$categories=get_categories($args);
echo '<ul>';
 foreach($categories as $category) { 
    echo '<li><div><span>'. $category->count . '</span><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( 'View all posts in %s', 'framework' ), $category->name ) . '" ' . '>' . $category->name.'</a> </div></li> ';
 } 
echo '</ul>';
?>
		
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Knowledge Base Categories'		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>


	
	<?php
	}
}
?>