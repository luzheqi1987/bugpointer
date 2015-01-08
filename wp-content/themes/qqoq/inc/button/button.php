<?php 
function my_title( $atts, $content = null ) {   
  return '<p class="my_title">'.$content.'</p>';   
}
add_shortcode( 't', 'my_title' ); 
add_action('init', 'custom_button');
function custom_button() {   
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {   
        return;   
    }   
    if ( get_user_option('rich_editing') == 'true' ) {   
        add_filter( 'mce_external_plugins', 'add_plugin' );   
        add_filter( 'mce_buttons', 'register_button' );   
    }   
}
function register_button( $buttons ) {   
    array_push( $buttons, "|", "t" );
    return $buttons;   
}
function add_plugin( $plugin_array ) {   
   $plugin_array['t'] = get_bloginfo( 'template_url' ) . '/inc/button/button.js';
   return $plugin_array;   
}
?>