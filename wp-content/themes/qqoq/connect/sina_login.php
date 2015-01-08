<?php  
/**
 * Name:QQ登录
 * Author:老萨
 * Time:2013-12-22
 */
include_once('../../../../wp-config.php');
$appid =get_option('sinaid');
$login = new sina();
$login->login($appid,get_bloginfo('template_directory').'/connect/sina_callback.php');
?>