<?php
//菜单
register_nav_menus();
//截字
function dm_strimwidth($str ,$start , $width ,$trimmarker ){$output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str); return $output.$trimmarker;};
//title cut
function cut_str($src_str,$cut_length){$return_str='';$i=0;$n=0;$str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {$tmp_str=substr($src_str,$i,1);$ascnum=ord($tmp_str);
		if ($ascnum>=224){$return_str=$return_str.substr($src_str,$i,3); $i=$i+3; $n=$n+2;}
        elseif ($ascnum>=192){$return_str=$return_str.substr($src_str,$i,2);$i=$i+2;$n=$n+2;}
        elseif ($ascnum>=65 && $ascnum<=90){$return_str=$return_str.substr($src_str,$i,1);$i=$i+1;$n=$n+2;}
        else {$return_str=$return_str.substr($src_str,$i,1);$i=$i+1;$n=$n+1;}
    }
    if ($i<$str_length){$return_str = $return_str . '...';}
    if (get_post_status() == 'private'){ $return_str = $return_str . '（private）';}
    return $return_str;};
// 获取当前页链接
function curPageURL() {$pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";$this_page = $_SERVER["REQUEST_URI"];
    if (strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));
    if ($_SERVER["SERVER_PORT"] != "80") {$pageURL .= $_SERVER["SERVER_NAME"] . ":" .$_SERVER["SERVER_PORT"] . $this_page;} 
    else {$pageURL .= $_SERVER["SERVER_NAME"] . $this_page;}
    return $pageURL;};
//支持外链缩略图
if ( function_exists('add_theme_support') )
 add_theme_support('post-thumbnails');
function catch_first_image() {global $post, $posts;$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(empty($first_img)){
		$random = mt_rand(1, 10);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/'.$random.'.jpg';
		//$first_img = "/images/default.jpg";
		}
  return $first_img;};
//自定义头像
add_filter( 'avatar_defaults', 'fb_addgravatar' );
function fb_addgravatar( $avatar_defaults ) {
$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
$avatar_defaults[$myavatar] = '自定义头像';
return $avatar_defaults;};
//评论回复/头像缓存
function weisay_comment($comment, $args, $depth) {$GLOBALS['comment'] = $comment;
	global $commentcount,$wpdb, $post;
     if(!$commentcount) { 
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);
          $page = get_query_var('cpage');
          $cpp=get_option('comments_per_page');
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;
         } else {$commentcount = $cpp * $page + 1;}
     }
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
      <?php $add_below = 'div-comment'; ?>
		<div class="comment-author vcard"><?php if (get_option('swt_type') == 'Display') { ?>
			<?php
				$p = 'avatar/';
				$f = md5(strtolower($comment->comment_author_email));
				$a = $p . $f .'.jpg';
				$e = ABSPATH . $a;
				if (!is_file($e)){ 
				$d = get_bloginfo('wpurl'). '/avatar/default.jpg';
				$s = '40'; 
				$r = get_option('avatar_rating');
				$g = 'http://www.gravatar.com/avatar/'.$f.'.jpg?s='.$s.'&d='.$d.'&r='.$r;
                $avatarContent = file_get_contents($g);
                file_put_contents($e, $avatarContent);
				if ( filesize($e) == 0 ){ copy($d, $e); }
				};
			?>
			<img src='<?php bloginfo('wpurl'); ?>/<?php echo $a ?>' alt='' class='avatar' />
                <?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/comment_gravatar.php'); } ?>
	<div class="floor">
	
	<?php 
	if(!$parent_id = $comment->comment_parent){switch ($commentcount){
     case 2 :echo "沙发";--$commentcount;break;
     case 3 :echo "板凳";--$commentcount;break;
     case 4 :echo "地板";--$commentcount;break;
     default:printf('%1$s楼', --$commentcount);}}
	?>
	</div>
	<strong><?php comment_author_link() ?></strong> <span class="commentmetadata"><?php comment_reply_link(array_merge( $args, array('reply_text' => '[回复]', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span><?php edit_comment_link('编辑','&nbsp;&nbsp;',''); ?></div>
	    <?php if ( $comment->comment_approved == '0' ) : ?>
		<span style="color:#C00; font-style:inherit">您的评论正在等待审核中...</span>
		<br />			
		<?php endif; ?>
		
		<span class="datetime">Post:<?php comment_date('Y-m-d') ?> <?php comment_time() ?> </span><div class="clear"></div> <?php comment_text() ?>
  </div>
<?php
}
function weisay_end_comment() {echo '</li>';};
//登陆显示头像
function weisay_get_avatar($email, $size = 48){
return get_avatar($email, $size);
};
//自定义表情地址
function custom_smilies_src($src, $img){return get_bloginfo('template_directory').'/images/smilies/' . $img;}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);
//pagenavi
function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}
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
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}
};
//读者排行
function xiaobei_readers($out,$timer,$limit){
	global $wpdb;    
	$counts = $wpdb->get_results("SELECT COUNT(comment_author) AS cnt, comment_author,comment_author_url,comment_author_email FROM {$wpdb->prefix}comments WHERE comment_date > date_sub( NOW(), INTERVAL $timer MONTH ) AND comment_approved = '1' AND comment_author_email AND comment_author_url != '".$out."' AND comment_type = ''  AND user_id = '0' GROUP BY comment_author ORDER BY cnt DESC LIMIT $limit");      
	foreach ($counts as $count) {
            $c_url = $count->comment_author_url;
			if ($c_url == '') $c_url = 'javascript:;';
            $mostactive .= '<a rel="nofollow" href="'. $c_url . '" title="' . $count->comment_author .' 留下 '. $count->cnt . ' 个脚印" target="_blank">' . get_avatar($count->comment_author_email, 48, '', $count->comment_author . ' 留下 ' . $count->cnt . ' 个脚印') . '</a>';
        }
        echo $mostactive;
    } 
//边栏评论
function r_comments($outer){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,15) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' AND comment_author != '".$outer."' ORDER BY comment_date_gmt DESC LIMIT 5";
	$comments = $wpdb->get_results($sql);
	$output = $pre_HTML;
	foreach ($comments as $comment) {$output .= "\n<li>".get_avatar( $comment, 30,'',$comment->comment_author)." <a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"发表在： " .$comment->post_title . "\">" .strip_tags($comment->comment_author).":<br/>". strip_tags($comment->com_excerpt)."</a><br /></li>";}
	$output .= $post_HTML;
	echo $output;
};
//调用友情链接
function xiaobei_links($link_type="txt",$get_total=0) {
	global $wpdb;
	$link_select = ($link_type == "txt") ? " = ''" : " != ''";
	$get_total = ($get_total != 0) ? "LIMIT $get_total" : "";
	$request = "SELECT link_id, link_url, link_name, link_image, link_target, link_description, link_visible, link_rating FROM $wpdb->links ";
	$request .= " WHERE $wpdb->links.link_visible = 'Y' AND $wpdb->links.link_image $link_select ";
	$request .= " ORDER BY link_rating DESC, link_id ASC $get_total";
	$links = $wpdb->get_results($request);
	foreach ($links as $link) { //调用菜单
		$output = '';
		if ($link_type == "txt") $output .= '<a target="'.$link->link_target.'" title="'.$link->link_description.'" href="'.$link->link_url.'">'.$link->link_name.'</a>';
		else $output .= '<a target="'.$link->link_target.'" title="'.$link->link_description.'" href="'.$link->link_url.'"><img src="'.$link->link_image.'" alt="'.$link->link_name.'"></a>';
		$output .= ''."\n";
		echo $output;
	}
};
//彩色标签
function colorCloud($text) {$text = preg_replace_callback('|<a (.+?)>|i','colorCloudCallback', $text);return $text;}
function colorCloudCallback($matches) {
	$text = $matches[1];
	$color = dechex(rand(0,16777215));
	$pattern = '/style=(\'|\”)(.*)(\'|\”)/i';
	$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
	return "<a $text>";}
add_filter('wp_tag_cloud', 'colorCloud', 1);
// Anti-Spam
class anti_spam {
  function anti_spam() {
    if ( !current_user_can('level_0') ) {
      add_action('template_redirect', array($this, 'w_tb'), 1);
      add_action('init', array($this, 'gate'), 1);
      add_action('preprocess_comment', array($this, 'sink'), 1);
    }
  }
  function w_tb() {
    if ( is_singular() ) {
      ob_start(create_function('$input','return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
      "textarea$1name=$2w$3$4/textarea><textarea name=\"comment\" cols=\"100%\" rows=\"4\" style=\"display:none\"></textarea>",$input);') );
    }
  }
  function gate() {
    if ( !empty($_POST['w']) && empty($_POST['comment']) ) {
      $_POST['comment'] = $_POST['w'];
    } else {
      $request = $_SERVER['REQUEST_URI'];
      $referer = isset($_SERVER['HTTP_REFERER'])         ? $_SERVER['HTTP_REFERER']         : '隐瞒';
      $IP      = isset($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] . ' (透过代理)' : $_SERVER["REMOTE_ADDR"];
      $way     = isset($_POST['w'])                      ? '手动操作'                       : '未经评论表格';
      $spamcom = isset($_POST['comment'])                ? $_POST['comment']                : null;
      $_POST['spam_confirmed'] = "请求: ". $request. "\n来路: ". $referer. "\nIP: ". $IP. "\n方式: ". $way. "\n內容: ". $spamcom. "\n -- 记录成功 --";
    }
  }
  function sink( $comment ) {
    if ( !empty($_POST['spam_confirmed']) ) {
      if ( in_array( $comment['comment_type'], array('pingback', 'trackback') ) ) return $comment;
      //方法一: 直接挡掉, 將 die(); 前面两斜线刪除即可.
      die();
      //方法二: 标记为 spam, 留在资料库检查是否误判.
      //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
      //$comment['comment_content'] = "[ 小墙判断这是 Spam! ]\n". $_POST['spam_confirmed'];
    }
    return $comment;
  }
}
$anti_spam = new anti_spam();
//评论邮件提醒
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回复:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复完整內容</a></p>
      <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(由于服务器原因,我是不能收到您直接回复的邮件的,如果您还有问题,就到我的网站进行留言.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
//访问计数
function record_visitors(){
	if (is_singular()) {global $post;
	 $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');  
function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
};
// 文章末加版权Feed
function insertFootNote($content) {
	if(is_feed()) {
		$wzbt = get_the_title();
		$wzlj = get_permalink($post->ID);
		$content.= '<p>';
		$content.= '<span style="font-weight:bold;text-shadow:0 1px 0 #ddd;">声明:</span> 本文采用 <a rel="nofollow" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" title="署名-非商业性使用-相同方式共享">BY-NC-SA</a> 协议进行授权 | <a href="'.home_url().'">'.get_bloginfo('name').'</a>';
		$content.= '<br />转载请注明转自《<a rel="bookmark" title="' . $wzbt . '" href="' . $wzlj . '">' . $wzbt . '</a>》';
		$content.= '</p>';
	}
	return $content;
}
add_filter ('the_content', 'insertFootNote');
//no_self_ping
function no_self_ping( &$links ) {
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
	unset($links[$l]);
	}
add_action( 'pre_ping', 'no_self_ping' );
//no_autosave
function no_autosave() {
  wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'no_autosave' );
//隐藏版本更新提示
add_filter('pre_site_transient_update_core', create_function('$a', "return null;"));
//过滤代码的中文符号
remove_filter('the_content', 'wptexturize');
//移除顶部多余信息
function wpbeginner_remove_version() { 
return ; 
} add_filter('the_generator', 'wpbeginner_remove_version');//wordpress的版本号 
remove_action('wp_head', 'index_rel_link');//当前文章的索引 
remove_action('wp_head', 'feed_links_extra', 3);// 额外的feed,例如category, tag页 
remove_action('wp_head', 'start_post_rel_link', 10, 0);// 开始篇 
remove_action('wp_head', 'parent_post_rel_link', 10, 0);// 父篇 
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // 上、下篇. 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );//rel=pre
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );//rel=shortlink 
remove_action('wp_head', 'rel_canonical' ); 
wp_deregister_script('l10n'); 
//添加编辑器快捷按钮
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/js/my_quicktags.js',
        array('quicktags')
    );
    }
//导入主题配置文件
include("includes/theme_options.php");
include("includes/shortcode.php");
//所有设置结束

/* 文章归档功能 by zwwooooo | http://zww.me */
 function zww_archives_list() {
     if( !$output = get_option('zww_archives_list') ){
         $output = '<div id="archives"><p>[<a id="al_expand_collapse" href="#">全部展开/收缩</a>] <em>(注: 点击月份可以展开)</em></p>';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('zww_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('zww_archives_list', ''); // 清空 zww_archives_list
 }
 add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时
/* 文章归档功能结束 by zwwooooo | http://zww.me */




	//自定义侧边栏(Custom Sidebar)
	if( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' =>'Home Sidebar', 
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}
	if( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' =>'List Sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}
	if( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' =>'Single Sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}

	

//自定义导航菜单
if ( function_exists('register_nav_menus') ) {
     register_nav_menus(
      array(
      'header-menu' => __( '顶部导航菜单' ),
	  'footer-menu' => __( '底部导航菜单' ),
       ));
}

//添加widget小工具  '热门文章'
if( function_exists( 'register_sidebar_widget' ) ) {   
    register_sidebar_widget('*热门文章','mb_hot_article'); 
	register_sidebar_widget('*随机文章','mb_random_article');   
	register_sidebar_widget('*分类文章','mb_categories_article');
	register_sidebar_widget('*置顶文章','mb_sticky_article');  
	register_sidebar_widget('*评论内容','mb_sticky_comments'); 
	register_sidebar_widget('*评论之星','mb_sticky_readers'); 
}   
function mb_hot_article() { include(TEMPLATEPATH . '/sidebar/widget_hot_article.php'); }   
function mb_random_article() { include(TEMPLATEPATH . '/sidebar/widget_random_article.php'); }
function mb_categories_article() { include(TEMPLATEPATH . '/sidebar/widget_categories_article.php'); }  
function mb_sticky_article() { include(TEMPLATEPATH . '/sidebar/widget_sticky_article.php'); }   
function mb_sticky_comments() { include(TEMPLATEPATH . '/sidebar/widget_comments.php'); } 
function mb_sticky_readers() { include(TEMPLATEPATH . '/sidebar/widget_readers.php'); }
    
//控制'热门文章'标题字数
function excerpttitle($max_length) {
$title_str = get_the_title();
if (mb_strlen($title_str,'utf-8') > $max_length ) {
$title_str = mb_substr($title_str,0,$max_length,'utf-8').'…';
}
return $title_str;
}   

/**
* 随机文章
*/
function random_posts($posts_num=5,$before='<li>',$after='</li>'){
   global $wpdb;
   $sql = "SELECT ID, post_title,guid
           FROM $wpdb->posts
           WHERE post_status = 'publish' ";
   $sql .= "AND post_title != '' ";
   $sql .= "AND post_password ='' ";
   $sql .= "AND post_type = 'post' ";
   $sql .= "ORDER BY RAND() LIMIT 0 , $posts_num ";
   $randposts = $wpdb->get_results($sql);
   
   $output = '';
   foreach ($randposts as $randpost) {
       $post_title = stripslashes($randpost->post_title);
       $permalink = get_permalink($randpost->ID);
       $output .= $before.'<a href="'
           . $permalink . '"  title="';
       $output .= $post_title . '">' . $post_title . '</a>';
       $output .= $after;
   }
   echo $output;
}


//评论链接跳转处理

add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);
add_filter('comment_text', 'add_redirect_comment_link', 99);
function add_redirect_comment_link($text = ''){
    $text=str_replace('href="', 'href="'.get_option('home').'/?url=', $text);
    $text=str_replace("href='", "href='".get_option('home')."/?url=", $text);
    return $text;
}
add_action('init', 'redirect_comment_link');
function redirect_comment_link(){
    $redirect = $_GET['url'];
    if($redirect){
        if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){
            header("Location: $redirect");
            exit;
        }
        else {
            header("Location: http://127.0.0.2/");
            exit;
        }
    }
}







//添加最新评论小工具，需要插件wp-RecentCommentsoo支持，显示的内容在插件设置中设置，下面的函数只负责将评论插件转化为挂件，可以在小工具中自由放置
class RecentCommentsooWidget extends WP_Widget
{
/*
** 构造函数
** 声明一个数组$widget_ops，用来保存类名和描述，以便在控制面板正确显示工具信息
** $control_ops 是可选参数，用来定义小工具在控制面板显示的宽度和高度
** 最后是关键的一步，调用WP_Widget来初始化我们的小工具
*/
function RecentCommentsooWidget(){
$widget_ops = array('classname'=>'hot_box float','description'=>'显示带头像评论列表');
$control_ops = array('width'=>250,'height'=>300);
$this->WP_Widget(false,'*最新评论*',$widget_ops,$control_ops);
}

function form($instance){
$instance = wp_parse_args((array)$instance,array('title'=>'最新评论'));
$title = htmlspecialchars($instance['title']);
echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
echo '<p>最新评论小工具，显示带头像评论列表。</p>';
}

function update($new_instance,$old_instance){
$instance = $old_instance;
$instance['title'] = strip_tags(stripslashes($new_instance['title']));
return $instance;
}

function widget($args,$instance){
extract($args);
$title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
echo $before_widget;
echo $before_title . $title . $after_title;
?>

		<div class="r_comments">
			<ul>
			<?php r_comments($outer=get_option('swt_outer')); ?>
			</ul>
		</div>

<?php
echo $after_widget;
}
}//评论列表小工具类结束
function RecentCommentsooInit(){
register_widget('RecentCommentsooWidget');
}
add_action('widgets_init','RecentCommentsooInit');
//评论列表小工具结束
?>