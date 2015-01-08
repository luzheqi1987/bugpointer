<div id="g">
<?php
    if(is_home()){
	 $sidebar='首页';
	}elseif(is_category()){
	 $sidebar='列表页'; 
	}elseif(is_single()){
	 $sidebar='内容页'; 
	}
?>
<?php if (!dynamic_sidebar($sidebar)){
	include_once('inc/widget/hot.php');
}?>
  <div class="g_g">
  <div class="g_s">
  		<h3>标签云集</h3>
	    <ul class="g_t">
		 <?php wp_tag_cloud('smallest=12&largest=12&unit=px&number=50&orderby=count&order=RAND');?>
		</ul>
  </div>
  <?php
	 $ad4_close = get_option('ad4_close');
	 if ($ad4_close == 'open') {
  ?>
  <div class="g_ad">
   <?php echo get_option('ad4');?>
  </div>
  <?php qqoq_ad('ad4');} ?>
  </div>

</div>