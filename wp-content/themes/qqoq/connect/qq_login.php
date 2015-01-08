<?php  
/**
 * Name:QQ登录
 * Author:老萨
 * Time:2013-12-22
 */
include_once('../../../../wp-config.php');
$scope = 'get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo';
$appid = get_option('qqid');
$login = new qq();
$login->login($appid,$scope,get_bloginfo('template_directory').'/connect/qq_callback.php');
?>