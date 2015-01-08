<?php
/*
 * Name:表单实时验证
 * Author:老萨
 * Time:2013-4-24
 * 修改日期：2013-11-3
*/
include_once('../../../../wp-config.php');
global $wpdb;
$myrows = $wpdb->get_results( "SELECT user_email,user_login FROM $wpdb->users" ); 
foreach($myrows as $user){
   $login[]=$user->user_login;
   $email[]=$user->user_email;
}
if($_POST['name'] == 'reg_login_name'){
	$name=$_POST["param"];
	if(preg_match("/[\x7f-\xff]/", $name)){
	    echo '登录名不能含有中文';
		 die();
	}elseif(in_array($name,$login)){
	    echo '登录名已经存在';
		die();
	}else{
	    echo 'y';
		die();
	}
}elseif($_POST['name'] == 'reg_email'){
	$emaill=$_POST["param"];
	if(in_array($emaill,$email)){
	    echo '邮箱已经存在';
		die();
	}else{
	    echo 'y';
		die();
	}
}elseif($_POST['name'] == 'post_title'){
	$title=strip_tags(trim($_POST["param"]));
	$db="SELECT post_title FROM $wpdb->posts WHERE post_title = '$title' LIMIT 1";
	if($title=='请输入文章标题'){
      echo '标题不能为空';
	  die();
    }elseif($wpdb->get_var($db)){
      echo '发现有相同标题的文章，请检查是否已经发布过或者修改标题';
	  die();
	}else{
	    echo 'y';
		die();
	}
}
?>