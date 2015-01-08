<?php 
/**
 * Name:评价系统
 * Author:老萨
 * Time:2013-10-13
 * last Modified:2014-02-12 增加文章投票功能
 */
//创建投票数据表 :'前缀_post_vote'
function Create_vote_table(){   
    global $wpdb;   
    $table_name = $wpdb->prefix . 'post_vote';   
    if( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) :   
    $sql = " CREATE TABLE `".$wpdb->prefix."post_vote` (
      `id` BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,  
      `user` INT NOT NULL ,  
      `post` INT NOT NULL ,  
      `rating` varchar(10),  
      `mac` varchar(40)  
     ) ENGINE = MYISAM DEFAULT CHARSET=utf8;";   
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');   
        dbDelta($sql);   
    endif;   
}
function add1_vote(){  
    if (isset($_POST['action']) && $_POST['action'] == 'vote') {
    	$v = new vote();
    	$post_id = $_POST['postid'];
    	$grade = $_POST['grade'];
    	if ($post_id != 0) {
	    	if ($grade == "like") {
	    		$grade = "like";
	    	}elseif($grade == "bad"){
	    		$grade = "bad";
	    	}
	    	if (!$v->is_vote($post_id)) {
	    		if($v->add_vote($post_id,$grade)){
	    			$json1['status'] = "y";
	    		}else{
	    			$json1['status'] = "n";
	    		}
	    	}else{	
	    		$json1['status'] = "n";
	    	}
	    	$json = array_merge_recursive($json1,$v->vote_stat($post_id));
	    }else{	
	    	$json['status'] = "n";
	    }	
    	header("Content-Type: application/json");
    	echo json_encode($json);
    	exit;
    }
}
add_action('init','add1_vote'); 
//视频投票
function get_vote(){
	global $post;
	$n = new vote();
	if ($n->is_vote($post->ID)) {
		if ($n->get_vote($post->ID) == "like") {
			echo '<a id="score" class="my_assess" style="display:block" href="javascript:;"><span>我的评价是：</span><i class="icon_good"></i><span>顶</span></a>';
		}elseif($n->get_vote($post->ID) == "bad"){
			echo '<a id="score" class="my_assess" style="display:block" href="javascript:;"><span>我的评价是：</span><i class="icon_bad"></i><span>踩</span></a>';
		}
	}else{
		echo '<a id="score_good" data-grade="like" data-postid="'.$post->ID.'" class="btn_good" href="javascript:;"><i class="icon_good"></i><span>顶</span></a>
              <a id="score_bad" data-grade="bad" data-postid="'.$post->ID.'" class="btn_bad" href="javascript:;"><i class="icon_bad"></i><span>踩</span></a>
              <a id="score" class="my_assess" style="display:none" href="javascript:;"></a>';
	}
}
//文章投票
function get_post_vote($postid){
	$n = new vote();
	$pct = $n->vote_stat($postid);
	if ($pct["pct_like"] != "0%") {
		$pct_like = $pct["pct_like"];
	}else{	
		$pct_like = "";
	}
	if ($pct["pct_bad"] != "0%") {	
		$pct_bad = $pct["pct_bad"];
	}else{	
		$pct_bad = "";
	}
	echo '<span class="dm_1" style="width:'.$pct_like.';">'.$pct_like.'</span><span class="dm_2" style="width:'.$pct_bad.';">'.$pct_bad.'</span>';
}
class vote{
    function userid(){
    	global $current_user;
		get_currentuserinfo();
		return $current_user->ID;
    }
	function check_user($postid) {
		global $wpdb;
		$user_check = "select 'user' from ".$wpdb->prefix."post_vote where post='$postid' and user='{$this->userid()}'";
		if($wpdb->query($user_check)){
			return true;
		}else{
			return false;
		}
	}
	function check_mac($postid) {
		global $wpdb;
		//$mac = new GetMacAddr("QQOQ");
		//$mac = $mac->mac_addr;
		$mac = GetIP();
		$mac_check = "select 'mac' from ".$wpdb->prefix."post_vote where post='$postid' and mac='$mac'";
		if($wpdb->query($mac_check)){
			return true;
		}else{
			return false;
		}
	}
	function add_vote($postid,$rating) {
		global $wpdb;
		//$mac = new GetMacAddr("QQOQ");
		//$mac = $mac->mac_addr;
		$mac = GetIP();
		if ($mac == 'unknown') {
			return false;
		}else{
			$insert = "insert into ".$wpdb->prefix."post_vote (user,post,rating,mac) values('{$this->userid()}','{$postid}','{$rating}','{$mac}')";
			if($wpdb->query($insert))
				return true;
			else
				return false;
		}
	}
	function is_vote($postid) {
		if(is_user_logged_in()){
			if ($this->check_user($postid) || $this->check_mac($postid)) {
				return true;
			}else{
				return false;
			}
		}else{
			if ($this->check_mac($postid)) {
				return true;
			}else{
				return false;
			}
		}
	}
	function get_vote($postid) {
		global $wpdb;
		//$mac = new GetMacAddr("QQOQ");
		//$mac = $mac->mac_addr;
		$mac = GetIP();
			if ($this->check_mac($postid)) {
				$query =  "select `rating` from ".$wpdb->prefix."post_vote where post='$postid' and mac='{$mac}'";
				return $wpdb->get_var($query);
			}elseif(is_user_logged_in() && $this->check_user($postid)){
				$query =  "select `rating` from ".$wpdb->prefix."post_vote where post='$postid' and user='{$this->userid()}'";
				return $wpdb->get_var($query);
			}
	}
	function get_vote_like_num($postid) {
		global $wpdb;
		$query =  "select count(*) from ".$wpdb->prefix."post_vote where post='$postid' and rating='like'";
		$num = $wpdb->get_var($query);
		return $num;
	}
	function get_vote_bad_num($postid) {
		global $wpdb;
		$query =  "select count(*) from ".$wpdb->prefix."post_vote where post='$postid' and rating='bad'";
		$num = $wpdb->get_var($query);
		return $num;
	}
	function vote_stat($postid) {	
			//like总数
			$like = $this->get_vote_like_num($postid);
			//bad总数
			$bad = $this->get_vote_bad_num($postid);
			//投票总数
			$sum = $like + $bad;
			//like占百分比
			$pct_like = @round($like / $sum * 100);
			//bad占百分比
			$pct_bad = 100-$pct_like;
			//评分
			$grade = number_format((10 * $pct_like) / 100 + (1 * $pct_bad) / 100,1);
			$info = array(
				'like' 	   => $like,
				'bad'  	   => $bad,
				'sum'  	   => $sum."评价",
				'pct_like' => $pct_like."%",
				'pct_bad'  => $pct_bad."%",
				'grade'    => $grade
			);	
		return $info;
	}
}
?>