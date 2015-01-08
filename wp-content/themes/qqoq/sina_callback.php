<?php  
/**
 * Name:QQ登录回调处理
 * Author:老萨
 * Time:2013-12-22
 */
include_once('../../../wp-config.php');
$appid = get_option('sinaid');
$appkey = get_option('sinakey');
$callback = new sina();
$callback->callback($appid,$appkey,get_bloginfo('template_directory').'/sina_callback.php');
$callback->sina_cb();
?>