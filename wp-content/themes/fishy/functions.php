<?php
add_action( 'widgets_init', 'my_unregister_widgets' );   
function my_unregister_widgets() {    
    unregister_widget( 'WP_Widget_Calendar' );      
    unregister_widget( 'WP_Widget_Meta' );   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );     
    unregister_widget( 'WP_Widget_RSS' ); 
	unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Nav_Menu_Widget' );   
}
require_once ( get_stylesheet_directory() . '/includes/random.php' );
require_once ( get_stylesheet_directory() . '/includes/hot.php' );
require_once ( get_stylesheet_directory() . '/includes/recentcomments.php' );
require_once ( get_stylesheet_directory() . '/includes/activereader.php' );
require_once ( get_stylesheet_directory() . '/includes/tongji.php' );
require_once ( get_stylesheet_directory() . '/includes/admin.php' );
require_once ( get_stylesheet_directory() . '/includes/tagscloud.php' );
register_nav_menu( 'primary', 'Primary Menu' );
/* -----------------------------------------------
<<小牆>> Anti-Spam v1.6a by Willin Kan.
*/
//建立黑匣子
class anti_spam {
function anti_spam() {
add_action( 'comment_form', array( &$this, 'w_tb' ) );
add_filter( 'preprocess_comment', array( &$this, 'gate' ) ); }
//設欄位
function w_tb() { echo '<textarea name="comments" cols="100%" rows="8" style="display: none;"></textarea>'; }
//檢查
function gate( $commentdata ) {
$is_ping = in_array($commentdata['comment_type'], array('pingback', 'trackback'));
if ( $is_ping ) {
add_filter('pre_comment_approved',create_function('','return "spam";'));
$commentdata['comment_content'] = "[ 小牆懷疑這可能是 Spam! ]\n" . $commentdata['comment_content'] ;
}
if ( $_POST['comments'] != '' ) {
add_filter('pre_comment_approved',create_function('','return "spam";'));
$commentdata['comment_content'] = "[ 小牆判斷這是 Spam! ]\n" . substr($commentdata['comment_content'],0,50) . "...." ;
}
return $commentdata;
} }
$anti_spam = new anti_spam();
// -- END ----------------------------------------

/* comment_mail_notify v1.0 by willin kan. (無勾選欄) */   
 function comment_mail_notify($comment_id) {    
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.    
  $comment = get_comment($comment_id);    
  $comment_author_email = trim($comment->comment_author_email);    
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';    
  $to = $parent_id ? trim(get_comment($parent_id)->comment_author_email) : '';    
  $spam_confirmed = $comment->comment_approved;    
  if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email) && ($comment_author_email == $admin_email)) {    
    /* 上面的判斷式,決定發出郵件的必要條件:   
    ($parent_id != '') && ($spam_confirmed != 'spam'): 回覆的, 而且不是 spam 才可發, 必需!!   
    ($to != $admin_email) : 不發給 admin.   
    ($comment_author_email == $admin_email) : 只有 admin 的回覆才可發.   
    可視個人需求修改以上條件.   
    */   
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.    
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';    
    $message = ' 
<div style="margin-right:170px;width:100%">
<div style="border:1px black solid;color:white;padding:15px;background:black;margin:0 auto;width:700px;-moz-border-radius:8px 8px 0 0;webkit-border-radius:8px 8px 0 0;border-radius:8px 8px 0 0;" >您曾在[<a style="text-decoration:none;color:#66ff00" href="' . get_option('home') . '">' . get_option('blogname') . '</a>]上的留言有新的回复啦！</div>
      <div style="background:#3ea4d5 ;margin:0 auto;width:700px; border:1px solid black; color:black;padding:0 15px;line-height:25px;-moz-border-radius:0 0 8px 8px;webkit-border-radius:0 0 8px 8px;border-radius:0 0 8px 8px;">     
      <p style=" padding:0;">' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>    
      <p style=" padding:0;">您在《' . get_the_title($comment->comment_post_ID) . '》发表的评论:</p>
      <p style="background:white;margin:0 25px;padding:5px 15px;-moz-border-radius:5px;webkit-border-radius:5px;border-radius:5px;">'. trim(get_comment($parent_id)->comment_content) . '</p>    
      <p style="padding:0;">' . trim($comment->comment_author) . ' 给您的回复:</p>
      <p style="background:white;margin:0 25px;padding:5px 15px;-moz-border-radius:5px;webkit-border-radius:5px;border-radius:5px;">'    
       . trim($comment->comment_content) . '<br /></p>    
      <p style=" padding:0;">您可以点击 <a style="text-decoration:underline;color:black" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复完整內容</a></p>    
      <p style=" padding:0;">欢迎您下次光临 <a style="text-decoration:underline;color:black" href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>    
      <p style=" padding:0;">(此邮件由系统自动发出, 请不要回复哦!)</p>    
    </div></div>';    
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";    
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";    
    wp_mail( $to, $subject, $message, $headers );    
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing    
  }    
}    
add_action('comment_post', 'comment_mail_notify');

// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'fishy') . get_query_var('paged');
    }
} // end get_page_number
/* Comments */
function yotheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	global $commentcount;
	$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );
	$cpp=get_option('comments_per_page');
	if(!$commentcount) { 
		if ($page > 1) {
		$commentcount = $cpp * ($page - 1);
		} else {
		$commentcount = 0;
		}
	}
?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<?php echo get_avatar($comment,$size='40',$default='<path_to_url>' ); ?>
		<div class="cite">
			<strong id="comment_author">
					<?php echo get_comment_author_link(); ?>
			</strong>
			<?php _e(' Says:', 'yotheme'); ?><br />
			<span><?php if(!$parent_id = $comment->comment_parent) {printf(__('#%1$s', 'yotheme'), ++$commentcount);} ?> <a href="#comment-<?php comment_ID() ?>"><?php comment_date(__('Y年m月d日', 'yotheme')) ?> <?php comment_time() ?></a> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?> <?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<p class="waiting"><?php _e('Your comment is awaiting moderation.') ?></p>
		<?php endif; ?>
		<?php comment_text() ?>
	</div>
<?php } // end custom_comments
 
// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings
// Register widgetized areas
if ( function_exists('register_sidebar') )
    // Area 1
    register_sidebar( array (
    'name' => 'Primary Widget Area',
    'id' => 'primary_widget_area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
 
    // Area 2
    register_sidebar( array (
    'name' => 'Secondary Widget Area',
    'id' => 'secondary_widget_area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
register_sidebar( array (
    'name' => 'footer Widget Area',
    'id' => 'footer_widget_area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
// end register widgetized areas
?>
