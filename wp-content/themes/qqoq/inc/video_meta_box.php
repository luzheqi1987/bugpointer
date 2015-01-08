<?php 
$new_meta_boxes = array(   
    "album" => array(   
        "name" => "album",   
        "std" => "",   
        "title" => "剧集"
    )
);
$albumstr = nl2br(get_option('albums'));
$albums = @explode('<br />',$albumstr);
function new_meta_boxes() {   
    global $post, $new_meta_boxes,$albums; 
    foreach($new_meta_boxes as $meta_box) { 
    	if ($meta_box['name'] == "album") {
	        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);   
	        if(empty($meta_box_value))   
	        $meta_box_value = $meta_box['std'];
	        echo '<div class="admin_album"><p>'.$meta_box['title'].'：'; 
	        echo '<select id="album_field" name="'.$meta_box["name"].'_value">';
	                echo '<option value ="">取消剧集</option>';
	                foreach ((array)$albums as $album) {
	                        $album = trim($album);
	                    ?>
	                    <option value="<?php echo $album?>" <?php selected( $meta_box_value, $album )?>><?php echo $album?></option>
	                <?php }
	        echo '</select></p>';
	        echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />'; 
	        echo '<p>剧集名设置（注：每个剧集名字为一行）';
	        echo '<textarea class="album_area" style="width:100%;height:100px" name="albums"/>'.get_option('albums').'</textarea>';
	        echo '</p><p><button class="button album_btn">增加剧集名</button><span class="spinner qqoq_load"></span></p></div>';
	    }
    }  
    wp_enqueue_script('admin', get_template_directory_uri().'/js/admin.js', false, '1.0.0', false);
    wp_enqueue_style('css', get_template_directory_uri(). '/css/admin.css', false, '1.0.0', 'screen');  
}
function create_meta_box() {    
    if ( function_exists('add_meta_box') ) { 
        add_meta_box( 'new-meta-boxes', '剧集设置', 'new_meta_boxes', 'video', 'side', 'high' ); 
    }   
}  
function save_postdata( $post_id ) {   
    global $post, $new_meta_boxes;  
    foreach($new_meta_boxes as $meta_box) {   
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
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))   
            update_post_meta($post_id, $meta_box['name'].'_value', $data);    
    }   
}  
add_action('admin_menu', 'create_meta_box');   
add_action('save_post', 'save_postdata');  
?>