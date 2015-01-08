<?php  
/**
 * Name:QQ登录回调处理
 * Author:老萨
 * Time:2013-12-22
 */
include_once('../../../wp-config.php');
$appid = get_option('qqid');
$appkey = get_option('qqkey');
$callback = new qq();
$callback->callback($appid,$appkey,get_bloginfo('template_directory').'/qq_callback.php');
$callback->get_openid();
$callback->qq_cb();
?>