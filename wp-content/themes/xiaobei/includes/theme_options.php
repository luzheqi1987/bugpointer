<?php
$themename = "xiaobei";
$shortname = "swt";
$categories = get_categories('关闭_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array ( 
array( "name" => $themename." Options",
       "type" => "title"),
//布局样式设置
    array( "name" => "布局样式及个性化",
           "type" => "section"),
    array( "type" => "open"),

	
			
	array(  "name" => "★首页是否显示置顶文章",
			"desc" => "默认关闭",
            "id" => $shortname."_zhiding",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),
			
	array(  "name" => "★选择分类列表样式",
			"desc" => "默认摘要样式，摘要样式带简短摘要内容（自动截取文章头部一定字数）；标题样式仅显示标题及时间。<br />如果列表高度和侧边栏不太协调，可在后台的【设置】=>【阅读】中，设置Blog页面中最多显示篇数",
            "id" => $shortname."_list",
            "type" => "select",
            "std" => "摘要样式",
            "options" => array("摘要样式","标题样式" )),			
			
	array(  "name" => "★内容页是否显示百度分享按钮",
			"desc" => "默认显示（显示在文章内容页右上角）,具备“页面分享功能，图片分享功能，划词分享功能”   ",
            "id" => $shortname."_bdshare",
            "type" => "select",
            "std" => "显示",
            "options" => array("显示", "关闭")),

//每天一句话			
			
	array(  "name" => "是否显示每天一句话",
			"desc" => "默认显示（位于文章Logo旁，全站显示，需要自行更新。）",
            "id" => $shortname."_mtyjh",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "输入一句话内容",
            "desc" => "支持html代码，可用&lt;br/&gt;换行。注意，换行太多会把导航栏目挤变形。",
            "id" => $shortname."_yjhnr",
            "type" => "textarea",
            "std" => '&lt;br/&gt;先付出，再得到。'),

			
			
//SEO设置
    array( "type" => "close"),
	array( "name" => "SEO设置及流量统计",
       "type" => "section"),
	array( "type" => "open"),

	array(	"name" => "描述（Description）",
			"desc" => "",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "输入你的网站描述，一般不超过200个字符"),

	array(	"name" => "关键词（KeyWords）",
            "desc" => "",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "输入你的网站关键字，一般不超过100个字符"),

	array("name" => "统计代码",
            "desc" => "",
            "id" => $shortname."_track_code",
            "type" => "textarea",
            "std" => ""),

//博主信息


    array( "type" => "close"),
	array( "name" => "博主信息",
			"type" => "section"),
	array( "type" => "open"),


	array(  "name" => "是否显示侧边栏博主联系信息",
			"desc" => "默认开启",
            "id" => $shortname."_blogger",
            "type" => "select",
            "std" => "显示",
            "options" => array("显示", "关闭")),
			
       array("name" => "输入QQ号",
            "desc" => "",
            "id" => $shortname."_qq",
            "type" => "text",
            "std" => "输入你的QQ号"),

       array("name" => "输入邮箱地址",
            "desc" => "",
            "id" => $shortname."_email",
            "type" => "text",
            "std" => "输入你的邮箱地址"),

	   array("name" => "输入腾讯微博地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_qqmblog",
            "type" => "text",
            "std" => "http://t.qq.com/muchun8"),

       array("name" => "输入新浪微博地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_sinamblog",
            "type" => "text",
            "std" => "http://weibo.com/muchunonway"),

       array("name" => "输入腾讯邮件订阅ID",
            "desc" => "",
            "id" => $shortname."_emailid",
            "type" => "text",
            "std" => "输入腾讯邮件订阅ID"),


       array("name" => "输RSS订阅地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_blogrss",
            "type" => "text",
            "std" => "http://www.kanhulian.com/feed"),
			
//博主介绍			
			
	array(  "name" => "是否显示侧边栏博主介绍",
			"desc" => "默认显示（必须要开启上面的“显示侧边栏博主联系信息”后，这个功能才生效，否则无法显示）",
            "id" => $shortname."_info",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "输入公告内容",
            "desc" => "支持html代码，可用&lt;br/&gt;换行",
            "id" => $shortname."_information",
            "type" => "textarea",
            "std" => '请输入博主介绍（支持html代码，可用&lt;br/&gt;换行）'),
			
//浮动qq邮件列表图标

			
       array("name" => "输QQ邮件列表订阅地址(包含http://)",
            "desc" => "",
            "id" => $shortname."_rsssub",
            "type" => "text",
            "std" => "把你的QQ邮件列表订阅地址填入这里"),

       array("name" => "输入QQ邮件列表订阅提示语",
            "desc" => "",
            "id" => $shortname."_rss",
            "type" => "textarea",
            "std" => "Hello，欢迎使用邮箱订阅博客。你，一定会喜欢我！"),


//读者排行设置
    array( "type" => "close"),
	array( "name" => "读者排行设置",
			"type" => "section"),
	array( "type" => "open"),

       array("name" => "输入您的昵称(只能输入一个)",
            "desc" => "让侧边栏的【读者排行】和【最新评论】不显示您的头像及内容",
            "id" => $shortname."_outer",
            "type" => "text",
            "std" => "输入您的昵称"),

       array("name" => "输入排行期限",
            "desc" => "如：输入 3 ,表示调用3个月内评论最多的读者头像",
            "id" => $shortname."_timer",
            "type" => "text",
            "std" => "3"),

       array("name" => "输入显示个数",
            "desc" => "如：输入 12 ,将显示12个读者头像,建议输入4的倍数",
            "id" => $shortname."_limit",
            "type" => "text",
            "std" => "12"),

//广告设置
    array( "type" => "close"),
	array( "name" => "广告设置",
			"type" => "section"),
	array( "type" => "open"),
	
	array(  "name" => "是否显示正文右上角广告",
			"desc" => "默认关闭",
            "id" => $shortname."_adr",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),

	array(	"name" => "输入正文右上角广告代码",
            "desc" => "",
            "id" => $shortname."_adrc",
            "type" => "textarea",
            "std" => '<a href="请在这里插入广告代码'),

	array(  "name" => "是否显示正文底部广告",
			"desc" => "默认关闭",
            "id" => $shortname."_adt",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),

	array(	"name" => "输入正文底部广告代码",
            "desc" => "",
            "id" => $shortname."_adtc",
            "type" => "textarea",
            "std" => '请在这里插入广告代码'),
 
	array(  "name" => "是否显示评论框下方广告",
			"desc" => "默认关闭",
            "id" => $shortname."_adc",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),

	array(	"name" => "输入评论框下方广告代码",
            "desc" => "",
            "id" => $shortname."_ad_c",
            "type" => "textarea",
            "std" => '请在这里插入广告代码'),

	array(  "name" => "是否显示侧边栏底部广告",
			"desc" => "默认关闭",
            "id" => $shortname."_ads",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),

	array(	"name" => "输入侧边栏底部广告代码",
            "desc" => "",
            "id" => $shortname."_ad_s",
            "type" => "textarea",
            "std" => '请在这里插入广告代码'),
			
	array(  "name" => "是否显全站顶部banner广告",
			"desc" => "默认关闭",
            "id" => $shortname."_adb",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),
					
	array(	"name" => "输入全站顶部banner广告代码",
            "desc" => "",
            "id" => $shortname."_ad_b",
            "type" => "textarea",
            "std" => '请在这里插入广告代码'),

	array(	"type" => "close") 
);
function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
}
add_theme_page($themename." Options", "xiaobei主题选项", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.'主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.'主题已重新设置</strong></p></div>';
?>
<div class="wrap rm_wrap">
<div id="icon-themes" class="icon32"><br></div>
<h2><?php echo $themename; ?>主题设置</h2>
<p>当前使用主题: xiaobei |设计者: <a href="http://www.kanhulian.com" target="_blank">小北</a> | <a href="http://www.kanhulian.com" target="_blank">主题更新及问题反馈</a> 
<?php
function show_category() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { //调用菜单
		$output = '<span>'.$category->name."(<em>".$category->term_id.'</em>)</span>';
		echo $output;
	}
}//栏目列表结束
?> 
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?> 
<?php break;case "close": ?>
</div>
</div>
<br /> 
<?php break; case "title": ?>
<?php break; case 'text': ?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; case 'textarea': ?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div> 
 </div> 
<?php break;case 'select': ?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php break; case "checkbox": ?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; case "section": $i++; ?>
<div class="rm_section">
<div class="rm_title"><h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="保存设置" />
</span><div class="clearfix"></div></div>
<div class="rm_options">
<?php break; }} ?>
<span class="show_id">
<p><strong>小北提示：</strong><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=915177271&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:915177271:51" alt="点击这里给我发消息" title="点击这里给我发消息"/ align="middle"></a></p>
<p>此版本为BLOG版，不久后将发布CMS版本，如有需要，请留意我的动态。主题是完全免费的，有时间我会更新，如果发现有BUG或者是有好的想法和建议，请到我的qq空间留言。</p>
<p><strong>注意</strong>：安装主题或者是恢复主题默认设置之后，请把左边的5个“保存设置”都点一下。</p>

<p><font color=#ff0000> ★</font><strong>联系方式</strong>：</p>
<p>QQ：（<font size=2 color=#ff0000>915177271</font>），欢迎大家加我为好</p>
<p>博客：<a href="http://www.kanhulian.com" target="_blank">kanhulian.com</a></p>
</span>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" class="button-primary" value="恢复默认设置" /> <font color=#ff0000>提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
<input type="hidden" name="action" value="reset" />
</p></form></div>
<?php } ?>
<?php
function mytheme_wp_head() { 
	$stylesheet = get_option('swt_alt_stylesheet');
	if($stylesheet != ''){?>
		<link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" />
<?php }
} 
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

?>