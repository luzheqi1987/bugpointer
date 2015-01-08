<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
include_once('inc/qq.php');
include_once('inc/sina.php');
include_once('inc/vote.php');
include_once('inc/function/types_video.php');
include_once('inc/admin-s.php');
include_once('inc/VideoUrlParser.class.php');
include_once('inc/button/button.php');
include_once('inc/create-page.php');
include_once('inc/post_meta_box.php');
include_once('inc/video_meta_box.php');
add_filter( 'pre_option_link_manager_enabled', '__return_true' );  
register_nav_menu( 'nav-menu', '导航菜单');
if ( function_exists('register_sidebar') ){
    register_sidebar(array(
    'name' => '首页',
    'before_widget' => '<div class="g_s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
    ));
    register_sidebar(array(
    'name' => '列表页',
    'before_widget' => '<div class="g_s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
    ));
    register_sidebar(array(
    'name' => '内容页',
    'before_widget' => '<div class="g_s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
    ));
} 
class QQOQ_hot_Widget extends WP_Widget { 
	function QQOQ_hot_Widget() {
		$widget_ops = array('description' => '分别显示评论最多、最新评论、随机文章等文章排行，调用10篇。');
	    parent::WP_Widget(false,$name='QQOQ热门文章',$widget_ops); 
	}
	function form($instance) {
		
	}
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
	function widget($args, $instance) {
		include(TEMPLATEPATH . '/inc/widget/hot.php');
	}
}
register_widget('QQOQ_hot_Widget');
add_theme_support( 'custom-background' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'medium', '140', '100', true ); 
add_image_size( 'm', '110', '110', true ); 
add_image_size( 'b', '350', '160', true ); 
function qqoq_load_theme() {   
    global $pagenow,$wpdb;
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {  
        $val = array('thumbnail_size_w','thumbnail_size_h','medium_size_w','medium_size_h','large_size_w','large_size_h');
        foreach( $val as $value ) {
            update_option($value,0);
        }
        $role = get_role( 'subscriber' );
        $role->add_cap('upload_files');
        $role->add_cap('publish_posts'); 
        qqoq_add_page('个人中心','m','profile.php');   
        qqoq_add_page('注册页面','r','register.php');
        Create_vote_table();
        $var = $wpdb->query("SELECT openid FROM $wpdb->users");
        if(!$var){
            $wpdb->query("ALTER TABLE $wpdb->users ADD openid varchar(50)");
        }
        $var1 = $wpdb->query("SELECT uid FROM $wpdb->users");
        if(!$var1){
         $wpdb->query("ALTER TABLE $wpdb->users ADD uid varchar(50)");
        }
    }
} 
add_action( 'load-themes.php', 'qqoq_load_theme' );
function custom_smilies_src($img_src,$img,$siteurl) {
return get_bloginfo('template_directory').'/img/smilies/'.$img;
}
add_filter('smilies_src','custom_smilies_src',1,10);
if ( !isset( $wpsmiliestrans ) ) {
    $wpsmiliestrans = array(
        ':大眼:' => '1.gif',
        ':可爱:' => '2.gif',
        ':大笑:' => '3.gif',
        ':坏笑:' => '4.gif',
        ':害羞:' => '5.gif',
        ':发怒:' => '6.gif',
        ':折磨:' => '7.gif',
        ':快哭了:' => '8.gif',
        ':大哭:' => '9.gif',
        ':白眼:' => '10.gif',
        ':晕:' => '11.gif',
        ':流汗:' => '12.gif',
        ':困:' => '13.gif',
        ':腼腆:' => '14.gif',
        ':惊讶:' => '15.gif',
        ':憨笑:' => '16.gif',
        ':色:' => '17.gif',
        ':得意:' => '18.gif',
        ':骷髅:' => '19.gif',
        ':囧:' => '20.gif',
        ':睡觉:' => '21.gif',
        ':眨眼:' => '22.gif',
        ':亲亲:' => '23.gif',
        ':疑问:' => '24.gif',
        ':闭嘴:' => '25.gif',
        ':难过:' => '26.gif',
        ':淡定:' => '27.gif',
        ':抗议:' => '28.gif',
        ':鄙视:' => '29.gif',
        ':猪头:' => '30.gif',
        
    );
}
function newpost(){
  $t1=$post->post_date;
  $t2=date("Y-m-d H:i:s");
  $diff=(strtotime($t2)-strtotime($t1))/7200;
  if($diff<24){echo '<img src="'.get_bloginfo('template_directory').'/img/new.png" alt="较新的文章" title="较新的文章" />';}
}
/**
 * 获取会员头像
 * @author 老萨
 * @version  1.0
 * @since  QQOQ 2.0
 * @param integer $userid 用户ID.
 * @param integer $size 头像尺寸（默认为40）.
 * @return html
 */
function qqoq_avatar($userid,$size="40"){
    $userimg = get_user_meta($userid, 'userapi', true);
    $username = get_user_meta($userid, 'nickname', true);
    if (!$userimg) {
    	$userimg = get_bloginfo('template_directory')."/img/userimg.png";
    }else{
    	$userimg = $userimg['userimg'];
    }
    $img = '<img width="'.$size.'" height="'.$size.'" class="avatar" src="'.$userimg.'" alt="'.$username.'">';
    return $img;
}
function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;                         
$next = $paged + 1; 
$range = 5;
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
    echo "<div class='pagination'>";
    echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='fir_las'>最前</a>":"";
    echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='page_previous'>« 上一页</a>":"";       
    for ($i=1; $i <= $pages; $i++){
    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
    echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
    }
    }
    echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='page_next'>下一页 »</a>" :"";
    echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='fir_las'>最后</a>":"";
    echo "</div>\n";
    }
}
function par_pagenavi($range = 9){
 global $paged, $wp_query;
 if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
 if($max_page > 1){if(!$paged){$paged = 1;}
 if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 首页 </a>";}
 previous_posts_link(' 上一页 ');
    if($max_page > $range){
  if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
  if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
  for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
  if($i==$paged)echo " class='current'";echo ">$i</a>";}}
 elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
  for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
 next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 尾页 </a>";}}
}
function catch_first_image($size = 'full') {
    global $post;
    $first_img = '';
    if (has_post_thumbnail($post->ID)) {
        $first_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$size);
        $first_img = $first_img[0];
    }else{
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches [1] [0];
        if(empty($first_img)){
            $random = mt_rand(1, 20);
            $first_img = get_bloginfo('template_directory').'/img/random/tb'.$random.'.jpg';
        }
    }
    return $first_img;
}
function hot_thumbnail_image() {
    global $post;
    $first_img = '';
    if (has_post_thumbnail($post->ID)) {
        $first_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'b');
        $first_img = $first_img[0];
    }else{
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches [1] [0];
        if(empty($first_img)){
            $first_img = get_bloginfo('template_directory').'/img/big.gif';
        }
    }
    return $first_img;
}
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}
function getPostViews($postID){   
    $count_key = 'views';   
    $count = get_post_meta($postID, $count_key, true);   
    if($count==''){   
    delete_post_meta($postID, $count_key);   
    add_post_meta($postID, $count_key, '0');   
    return "0";   
    }   
    return $count;   
    }   
    function setPostViews($postID) {   
    $count_key = 'views';   
    $count = get_post_meta($postID, $count_key, true);   
    if($count==''){   
    $count = 0;   
    delete_post_meta($postID, $count_key);   
    add_post_meta($postID, $count_key, '0');   
    }else{   
    $count++;   
    update_post_meta($postID, $count_key, $count);   
    }   
}
add_filter('the_content', 'pirobox_gall_replace');
 function pirobox_gall_replace ($content){
 global $post;
 $pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
 $replacement = '<a$1href=$2$3.$4$5 class="qimg" data-fancybox-group="gallery"$6>$7</a>';
 $content = preg_replace($pattern, $replacement, $content);
 return $content;
 }
function utf8_strlen($string = null) {
preg_match_all("/./us", $string, $match);
return count($match[0]);
}

/**
 * 获取评论总数(以父级为标准)
 * @author 老萨
 * @version  1.0
 * @since  QQOQ 2.0
 */
function comment_parent_number(){
	global $post;	
	return get_comments("post_id={$post->ID}&parent=0&status=approve&count=true");
}
$GLOBALS['comment_order'] = get_option('comment_order');//获取评论排序

/**
 * 评论回复
 * @author 老萨
 * @version  1.0
 * @since  QQOQ 2.0
 */
function qqoq_comment($comment, $args, $depth) {
	global $nnum,$qqoq_depth;
	$comment_num = comment_parent_number() + 1;
	if ($comment->user_id) {
		$userinfo = get_userdata( $comment->user_id);
		$username = $userinfo->display_name;
		$userurl = $userinfo->user_url;
		$userimg = qqoq_avatar($comment->user_id);
	}else{	
		$username = $comment->comment_author;
		$userurl = $comment->comment_author_url;
		$userimg = get_avatar($comment->comment_author_email,'50');
	}
	if (!$comment->comment_parent){//如果为父级，$nnum（楼层数递增）
		$nnum ++;
	}
	if ($GLOBALS['comment_order'] == 'asc') {//如果评论的排序为升序（即以旧的评论排在前面）
		if (!$comment->comment_parent) {
			$qqoq_depth1 = $nnum." 楼";
		}else{	
			$qqoq_depth1 = $nnum."楼 - 楼中楼";
		}
	}else{	//如果评论的排序为降序（即以新的评论排在前面）
		if (!$comment->comment_parent) {
			$qqoq_depth = $comment_num - $nnum;
			$qqoq_depth1 = $qqoq_depth." 楼";
		}else{	
			$qqoq_depth1 = $qqoq_depth."楼 - 楼中楼";
		}
	}
	
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="qqoq-com">
		<div class="qqoq-avatar">
			<a target="_blank" title="<?php echo $username ?>" href=""><?php echo $userimg?></a>
		</div>
		<div class="qqoq-comment">
			<span class="qqoq-depth"><?php echo $qqoq_depth1 ?></span>
			<a class="comment-name" target="_blank" href="<?php echo $userurl;?>" title="<?php echo $username ?>"><?php echo $username; ?></a>
			<div class="comment-content">
				<?php comment_text() ?>
			</div>
			<div class="comment-info">
				<span class="comment-time"><?php comment_date('Y年m月d日');comment_time(' h:i:s') ?></span>
				<span class="reply" data-id="<?php comment_ID() ?>"><i class="qqoq-icon r-icon1"></i>回复</span>
				<span class="c-reply"><i class="qqoq-icon a-icon1"></i>取消回复</span>
			</div>
		</div>
	</div>
<?php
}
function qqoq_end_comment() {
        echo '</li>';
}
?>
<?php
function qqoq_ad($ad_name){
    if(current_user_can('level_10')){
      echo "<a class=\"qb ".$ad_name."\" href=\"#q".$ad_name."\">编辑".$ad_name."</a>";
    }
}
function hide_admin_bar($flag) {
return false;
}
add_filter('show_admin_bar','hide_admin_bar');
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');
remove_action('wp_head', 'wlwmanifest_link'); 
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    unset ($existing_mimes);//禁止上传任何文件
    $existing_mimes['jpg']='image/jpeg';//允许用户上传jpg，gif，png文件
    $existing_mimes['png']='image/png';
    $existing_mimes['bmp']='image/bmp';
    $existing_mimes['gif']='image/gif';
    return $existing_mimes;
}
function enable_more_buttons($buttons) {    
$buttons[] = 'hr';    
$buttons[] = 'fontselect';    
$buttons[] = 'sup';
$buttons[] = 'sub';      
$buttons[] = 'wp_adv';
$buttons[] = 'image';
return $buttons;  
}  
add_filter("mce_buttons", "enable_more_buttons");
add_editor_style('css/editor-post.css');
function custom_dashboard_help() {
    echo base64_decode('PHA+UVFPUeS4u+mimOeugOWNleS9v+eUqOivtOaYjjwvcD48cD48b2w+PGxpPuS4quS6uuS4reW/g+mhtemdouiuvue9ru+8muaWsOW7uuS4gOS4qumhtemdou+8jOWIq+WQjeS4um3vvIzmqKHmnb/pgInmi6nigJznlKjmiLfkuK3lv4PigJ08L2xpPjxsaT7ms6jlhozpobXpnaLorr7nva7vvJrmlrDlu7rkuIDkuKrpobXpnaLvvIzliKvlkI3kuLpy77yM5qih5p2/6YCJ5oup4oCc5rOo5YaM6aG16Z2i4oCdPC9saT48bGk+5Li76aKY5pu05paw6K6w5b2V6K+36K6/6ZeuPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9J2h0dHA6Ly93d3cucXFvcS5uZXQvcXFvcS10aGVtZS11cGRhdGUtcmVjb3JkLmh0bWwnPuWumOaWuee9keermTwvYT48L2xpPjxsaT7kuozmrKHlvIDlj5HmiJblrprlgZror7fkuI7miJHogZTns7vvvIxFbWFpbDogd29AY2FvbmliaS5jb20mbmJzcDsmbmJzcDsmbmJzcDtRUTogMjM2MDU2NDcxPC9saT48L29sPjwvcD4=');   
}
function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('custom_help_widget', base64_decode('5qyi6L+O5L2/55SoUVFPUeS4u+mimA=='), 'custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets');
function example_remove_dashboard_widgets() {
    global $wp_meta_boxes;

    // 以下这一行代码将删除 "快速发布" 模块
    //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

    // 以下这一行代码将删除 "引入链接" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

    // 以下这一行代码将删除 "近期评论" 模块
    //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);

    // 以下这一行代码将删除 "近期草稿" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);

    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);

    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

    // 以下这一行代码将删除 "概况" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );
function qqoq_reg(){
	global $wpdb;
	$userinfo=get_userdata(get_current_user_id());
	if($_GET['action'] =='qqoq_post'){
	    switch($userinfo->roles[0]){
	    case 'administrator':
	    case 'editor':
	    case 'author':
	    case 'Super Admin':
	    case 'contributor':
	      $post_status= 'publish';
	      break; 
	    case 'subscriber':
	      $post_status= 'pending';
	      break;
	    }
	    $title=strip_tags(trim($_POST['post_title']));
	    $content=stripslashes(trim($_POST['post_content']));
	    $categorys=$_POST['post_category'];
	    $tags=preg_split('#\s+#',$_POST['post_tags']);
	    global $wpdb;
	    $db="SELECT post_title FROM $wpdb->posts WHERE post_title = '$title' LIMIT 1";
	      if ($wpdb->get_var($db)){
	        $info = array('info'=>'发现有相同标题的文章，请检查是否已经发布过或者修改标题','status'=>'n');
	        echo json_encode($info);
	        die();
	      }elseif($title=='' || $title=='请输入文章标题'){
	        $info = array('info'=>'标题不能为空','status'=>'n');
	        echo json_encode($info);
	        die();
	      }elseif($categorys==''){
	        $info = array('info'=>'请选择栏目','status'=>'n');
	        echo json_encode($info);
	        die();
	      }elseif($content==''){
	        $info = array('info'=>'内容不能为空','status'=>'n');
	        echo json_encode($info);
	        die();
	      }else{
	         $submitdata=array(
	          'post_title'        =>$title,
	          'post_content' =>$content,
	          'tags_input'      =>$tags,
	          'post_category'  =>$categorys,
	          'post_status'   => $post_status
	         );
	         $post_id = wp_insert_post($submitdata);
	         if ( is_wp_error( $post_id ) ) {
	           echo $user_id->get_error_message();
	         }
	         else {
	            $info = array('info'=>'文章发布成功','status'=>'y','q'=>'qqoq','url'=>get_page_slug_link('m'));
	            echo json_encode($info);
	            die();
	         }
	      }
	}
	if($_GET['action'] =='qqoq_info'){
	    $infoname=strip_tags(trim($_POST["qqoq_name"]));
	    $infoemail=strip_tags(trim($_POST["qqoq_email"]));
	    $infourl=strip_tags(trim($_POST["qqoq_url"]));
	    $infodes=strip_tags(trim($_POST["qqoq_des"]));
	    if(utf8_strlen($infodes)>140){
	        $info = array('info'=>'描述不能超过140字','status'=>'n');
	        echo json_encode($info);
	        die();
	    }
	    $art=array(
	      'ID' => $userinfo->ID,
	      'display_name' => $infoname,
	      'user_email' => $infoemail,
	      'user_url' => $infourl,
	      'description' => $infodes
	    );
	    $user_id=wp_update_user($art);
	    if ( is_wp_error( $user_id ) ) {
	        echo $user_id->get_error_message();
	    }
	    else {
	        $info = array('info'=>'资料修改成功','status'=>'y');
	        echo json_encode($info);
	        die();
	    }
	}
	if($_GET['action'] =='qqoq_pass'){
	    $pass=strip_tags(trim($_POST["qqoq_pw"]));
	    if(strlen($pass)<6){
	        $info = array('info'=>'密码不能小于6位','status'=>'n');
	        echo json_encode($info);
	        die();
	    }
	    if(strlen($pass)>16){
	        $info = array('info'=>'密码不能大于16位','status'=>'n');
	        echo json_encode($info);
	        die();
	    }
	    $user_id = wp_set_password($pass,$userinfo->ID);
	    if ( is_wp_error( $user_id ) ) {
	        $info = array('info'=>$user_id->get_error_message(),'status'=>'n');
	        echo json_encode($info);
	        die();
	    }else{
	        $info = array('info'=>'密码修改成功','status'=>'y');
	        echo json_encode($info);
	        die();
	    }
	}
	if($_GET['action'] =='qqoq'){
	    if (!wp_verify_nonce( $_POST['random_pass'], "qqoq_pass")) {   
	        $info = array('info'=>'大哥，不要这样。','status'=>'n');
	        echo json_encode($info);
	        die();   
	    }
	    $login_name=strip_tags(trim($_POST['reg_login_name']));
	    $display_name = strip_tags(trim($_POST['reg_name']));
	    $pass = strip_tags(trim($_POST['reg_pw']));
	    $tpass = strip_tags(trim($_POST['reg_tpw']));
	    $reg_email = strip_tags(trim($_POST['reg_email']));
	    $reg_url = strip_tags(trim($_POST['reg_url']));
	    $reg_des = strip_tags(trim($_POST['reg_des']));
	    $userdata=array(
	      'ID' => '',
	      'user_login' => $login_name,
	      'display_name' => $display_name,
	      'user_pass' => $pass,
	      'user_email' => $reg_email,
	      'user_url' => $reg_url,
	      'description' => $reg_des,
	      'role' => get_option('default_role'),
	      'first_name' => $display_name
	    );
	    if (preg_match("/[\x7f-\xff]/", $login_name)){
	        $info = array('info'=>'登录名不能含有中文','status'=>'n');
	        echo json_encode($info);
	        die();
	    }
	    if(strlen($pass)<6){
	        $info = array('info'=>'密码不能小于6位','status'=>'n');
	        echo json_encode($info);
	         die();
	    }
	    if(strlen($pass)>16){
	        $info = array('info'=>'密码不能大于16位','status'=>'n');
	        echo json_encode($info);
	         die();
	    }
	    if(utf8_strlen($reg_des)>140){
	        $info = array('info'=>'描述不能超过140字','status'=>'n');
	        echo json_encode($info);
	         die();
	    }
	    $user_id = wp_insert_user( $userdata );
	    if ( is_wp_error( $user_id ) ) {
	        $info = array('info'=>$user_id->get_error_message(),'status'=>'n');
	        echo json_encode($info);
	         die();
	    }else{
	        wp_set_auth_cookie($user_id,true,false);
	        $info = array('info'=>'注册成功！请用新帐号登录','status'=>'y','q'=>'qqoq','url'=>get_page_slug_link('m'));
	        echo json_encode($info);
	         die();
	    }    
	}
	if($_POST['action'] =='comment'){
		$post_content = $_POST['con'];
		$nonce = $_POST['nonce'];
		$comment_post_ID = $_POST['postid'];
		$user_ID = get_current_user_id();
		$comment_parent = $_POST['replyid'];
		$comment_author_IP = GetIP();
		$comment_approved = get_option('comment_moderation');
		if(!is_user_logged_in()){
			$info = array('info'=>'请登录后再操作！','status'=>'n');
	        echo json_encode($info);
	        exit;
		}elseif (!wp_verify_nonce( $nonce, 'qqoq_comment'.$comment_post_ID)) {  
	        $info = array('info'=>'出错了 ，请稍后再试！','status'=>'n');
	        echo json_encode($info);
	        exit; 
	    }elseif (empty($post_content)) {
	    	$info = array('info'=>'内容不能为空！','status'=>'n');
	        echo json_encode($info);
	        exit; 
	    }else{
		    $comment_content = preg_replace('/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/', '[img=$1]',stripslashes($post_content));
		    $commentdata = compact('comment_approved','comment_post_ID', 'comment_author_IP','comment_content','comment_parent', 'user_ID');
		    $comment_id = wp_new_comment( $commentdata ); 
		    if ( is_wp_error( $comment_id ) ) {
		        $info = array('info'=>$comment_id->get_error_message(),'status'=>'n');
		        echo json_encode($info);
		        exit;
		    }else{	
		    	$info = array('info'=>'感谢您的评论!','status'=>'y');
		        echo json_encode($info);
		        exit;
		    }
		}
	}

}
add_action('init', 'qqoq_reg');
function qqoq_comment_images($content){
	$content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
	return $content;
}
add_filter('comment_text', 'qqoq_comment_images');
function qqoq_album(){
    if($_POST['action'] =='album'){
        $album = $_POST['album'];
        if(update_option('albums',$album)){
            $albumstr = nl2br(get_option('albums'));
            $albums = @explode('<br />',$albumstr);
            krsort($albums);
            foreach ($albums as $album) {
                $album = trim($album);
                $a .= '<option value ="'.$album.'">'.$album.'</option>';
            }
            $a .= '<option value =""></option>';
            echo $a;
        }else{
            echo "0";
        }
        exit;
    }
}
add_action('admin_init', 'qqoq_album');
function get_page_slug_link($page_name){
    global $wpdb;
    $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."' AND post_status = 'publish' AND post_type = 'page'");
    $pageurl = get_page_link($page_id);
    return $pageurl;
}
function vimg($post_id){
    global $post;
    if ($post->post_type == 'video') { 
        $vimg = get_post_meta($post_id,'vimg',true);
        if(empty($vimg)){
            $videodata = get_post($post_id);
            $vurl = $videodata->post_content;
            $info = VideoUrlParser::parse($vurl);
            $vimg1 = $info['img'];
            if (empty($vimg1)) {
                $random = mt_rand(1, 20);
                $vimg1 = get_bloginfo('template_directory').'/img/random/tb'.$random.'.jpg';
            }
            update_post_meta($post_id, 'vimg', $vimg1);
        }
    }
}
add_action('save_post', 'vimg');
function link_at(){
    if ( get_option('permalink_structure') != '' ){
          return "?";
    }else{
          return "&";
    }
}
$my_theme = wp_get_theme();
add_action( 'admin_notices', 'action_admin_notice_update' );
function action_admin_notice_update() {
    global $my_theme;
    $version=@fopen(base64_decode('aHR0cDovL3d3dy5xcW9xLm5ldC92ZXJzaW9uLnBocA=='),"r");
    $ver=@fgets($version);
    @fclose($version);
    if((int)$my_theme->Version < (int)$ver){
        echo "<div style='
        background-color: #F3383F;
        border-radius: 3px 3px 3px 3px;
        border-style: solid;
        border-width: 2px;
        color: #FFFFFF;
        margin: 35px 10px 15px;
        padding: 10px;
        -moz-box-shadow: 0px 0px 4px #bbb; /* FF3.5+ */
        -webkit-box-shadow: 0px 0px 4px #bbb; /* Saf3.0+, Chrome */
        box-shadow: 0px 0px 4px #bbb; /* Opera 10.5, IE9, Chrome 10+ */
        '>".base64_decode('57O757uf5qOA5rWL5Yiw5Li76aKY5bey5pu05paw5Yiw77ya').$ver.base64_decode('54mI5pys77yMIOivt+iBlOezuzxhIGhyZWY9J2h0dHA6Ly93d3cucXFvcS5uZXQnPiDkvZzogIUgPC9hPuabtOaWsO+8jOasoui/juWKoOWFpVFR576k6K6o6K6677yaMjkzNzcwODczPC9kaXY+');
    }
}
function comment_mail_notify($comment_id){
    $comment=get_comment($comment_id);
    $parent_id=$comment->comment_parent?$comment->comment_parent:'';
    $spam_confirmed=$comment->comment_approved;
    if(($parent_id!='')&&($spam_confirmed!='spam')){
        $wp_email = 'Your E-mail'.preg_replace('#^www\.#','',strtolower($_SERVER['SERVER_NAME']));
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 ['.get_option("blogname").'] 的留言有了回应';
        $message = '<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
                    <p>'.trim(get_comment($parent_id)->comment_author).', 您好!</p>
                    <p>您曾在《'.get_the_title($comment->comment_post_ID).'》的留言:<br />'.trim(get_comment($parent_id)->comment_content).'</p>
                    <p>'.trim($comment->comment_author).' 给您的回复:<br />'.trim($comment->comment_content).'<br /></p>
                    <p>您可以点击 <a href="'.htmlspecialchars(get_comment_link($parent_id)).'">查看回复完整內容</a></p>
                    <p>欢迎再度光临 <a href="'.get_option('home').'">'.get_option('blogname').'</a></p>
                    <p>(此邮件由系统自动发送，请勿回复.)</p>
                    </div>';
        $from="From: \"" . get_option('blogname') . "\"<$wp_email>";
        $headers = "$from\nContent-Type:text/html;charset=" . get_option('blog_charset') . "\n";
        wp_mail($to,$subject,$message,$headers);
    }
}
add_action('comment_post','comment_mail_notify');
function utf8Substr($str, $from, $len){
    return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
    '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
    '$1',$str);
}
function seo_post($post_id){
    global $post;
     $description = get_post_meta($post_id, 'description_value', true);
     $keywords = get_post_meta($post_id, 'keywords_value', true);
     if (empty($description)) {
        if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
            $post_content = $result['1'];
        }else {
            $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
            $post_content = $post_content_r['0'];
        }
        $description = utf8Substr($post_content,0,220); 
        update_post_meta($post_id,"description_value",$description); 
     }
     if (empty($keywords)) {
        $post_type = $post->post_type;
        if ($post_type == 'post') {
            $tax = 'post_tag';
        }elseif ($post_type == 'video') {
            $tax = 'video_tags';
        }
        $tags = wp_get_object_terms($post_id, $tax);
        foreach ($tags as $tag ) {
            $keywords = $keywords . $tag->name . ",";
        }
        update_post_meta($post_id,"keywords_value",$keywords);
     }
}
add_action('save_post', 'seo_post');
function deletehtml($description) {
    $description = trim($description);
    $description = strip_tags($description,"");
    return ($description);
}
add_filter('category_description', 'deletehtml');
add_filter('videos_description', 'deletehtml');
function selfURL(){  
    $pageURL = 'http';
    $pageURL .= (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?"s":"";
    $pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    return $pageURL;      
}
function GetIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }else if(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }else{
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);
    return $cip;
}
function appkey_scripts(){
    echo "<script>\n";
    echo "var qqtkey = '".get_option('qqtid')."';\n";
    echo "var sinakey = '".get_option('sinaid')."';\n";
    echo "var waiting_time = '".get_option('waiting_time')."';\n";
    echo "</script>\n";
}
add_action( 'wp_head', 'appkey_scripts' );
function do_post($url, $data) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_POST, TRUE );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt ( $ch, CURLOPT_URL, $url );
	$ret = curl_exec ( $ch );
	curl_close ( $ch );
	return $ret;
}
function get_url_contents($url) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_URL, $url );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	return $result;
}
?>