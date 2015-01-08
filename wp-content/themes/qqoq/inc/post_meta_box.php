<?php
//创建头条字段
$headline_meta_boxes = array(   
    "headline" => array(   
        "name" => "headline",   
        "std" => "",   
        "title" => "头条"
    )
);
//文章头条面板显示
function headline_meta_boxes() {   
    global $post,$headline_meta_boxes; 
    foreach($headline_meta_boxes as $meta_box) { 
    	if ($meta_box['name'] == "headline") {  
	        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);   
	        if(empty($meta_box_value))   
	        $meta_box_value = $meta_box['std'];
	        echo '<div class="admin_'.$meta_box["name"].'"><p>'.$meta_box['title'].'：'; 
	        echo '<select id="'.$meta_box["name"].'_field" name="'.$meta_box["name"].'_value">';
	        echo '<option value ="" '.selected( $meta_box_value, "",0 ).'>取消头条</option>';
	        echo '<option value ="1" '.selected( $meta_box_value, "1",0 ).'>设为头条</option>';
	        echo '</select></p>';
	        echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />'; 
	        echo '</div>';
	    }
    } 
}
//创建面板
function create_headline_meta_box() {    
    if ( function_exists('add_meta_box') ) { 
        //文章头条 
        add_meta_box( 'headline-meta-boxes', '头条', 'headline_meta_boxes', 'post', 'side', 'high' ); 
    }   
}  
//保存数据
function save_headline_postdata( $post_id ) {   
    global $post,$headline_meta_boxes; 
    foreach($headline_meta_boxes as $meta_box) {   
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {   
            return $post_id;   
        }   
  
        if ( 'page' == $_POST['post_type'] ) {   
            if ( !current_user_can( 'edit_page', $post_id ))   
                return $post_id;   
        }    
        else {   
            if ( !current_user_can( 'edit_post', $post_id ))   
                return $post_id;   
        }   
        $data = $_POST[$meta_box['name'].'_value'];   
        if($data == "")   
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
        //elseif(get_post_meta($post_id, $meta_box['name'].'_value') == "")   
            //add_post_meta($post_id, $meta_box['name'].'_value', $data, true);   
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))   
            update_post_meta($post_id, $meta_box['name'].'_value', $data);    
    }   
}  

//触发
add_action('admin_menu', 'create_headline_meta_box');   
add_action('save_post', 'save_headline_postdata');  
?>