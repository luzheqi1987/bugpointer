<?php
 if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
 die ('Please do not load this page directly. Thanks!');
?>
<div class="po">
<p class="sp">
 <i class="sb">投稿须知</i>
 <?php 
   if($roles=='Q2' || $roles=='管理员'){
    echo ' 请遵守国内各种法律法规、遵守中华文明道德规范，发布有质量的文章，发现有恶意投递者一律删号。你目前的等级是['.$roles.']，投递文章直接通过无须审核。请珍惜您的等级，不要出现违规行为不然会做降级处理。';
   }elseif($roles=='Q1'){
    echo '请遵守国内各种法律法规、遵守中华文明道德规范，发布有质量的文章，发现有恶意投递者一律删号。你目前的等级是[Q1]，投递文章需管理员审核后方才通过，文章状态可以到“我的文章”查看。';
   }
 ?>
</p>
<form class="info" method="post" action="?action=qqoq_post">
<input type="text" ajaxurl="<?php bloginfo('template_url'); ?>/inc/oq.php" id="post-title" onfocus="if(this.value=='请输入文章标题') this.value='';" onblur="if(this.value=='') this.value='请输入文章标题';" name="post_title" datatype="*" value="请输入文章标题"/><span class="Validform_checktip"></span>
<p>
<i>所属分类</i>
<?php
	   $arg = array(
	    'type'          => 'post',
	    'child_of'      => 0,
	    'parent'        => '',
	    'orderby'       => 'name',
	    'order'         => 'ASC',
	    'hide_empty'    => 0,
	    'hierarchical'  => 1,
	    'exclude'       => '',
	    'include'       => '',
	    'number'        => '',
	    'taxonomy'      => array(category),//videos视频栏目
	    'pad_counts'    => false );
?>
<?php
  //$categories=get_categories($arg);
  $categories=get_option('tg');
	foreach($categories as $k=>$category) {
		if($k==0){
		  echo "<label><input datatype='*' type='radio' name='post_category[]' value='$category' /> ";
		}else{
		  echo "<label><input type='radio' name='post_category[]' value='$category' /> ";
		}
		echo get_cat_name($category);
		echo '</label>';
	}
?>
<span class="Validform_checktip"></span>
</p>
<p id="tag"><i>标签（多个标签请使用空格分开）</i>
<textarea id="post_tags" name="post_tags"></textarea>
<?php 
  $args = array(
  	'unit' => 'px',
  	'smallest' => '12',
  	'largest' => '12',
  	'number' => '20',
    'taxonomy'  => array('post_tag'), //video_tags 视频标签
  ); 
?>
<span id="tag-cloud"><?php wp_tag_cloud($args); ?></span>
</p>
<?php 
wp_enqueue_script('post');
wp_enqueue_media( array( 'post' => $post_id ) );
wp_editor( '', 'post_content', $settings = array(
                    'quicktags'=>1,
                    'tinymce'=>1,
                    'media_buttons'=>1,
                    'textarea_rows'=>0,
                    'editor_class'=>"textareastyle",
                    'editor_css'=>'<link type="text/css" rel="stylesheet" href="'.get_bloginfo(template_directory).'/css/editor.css">'
) ); ?>
<input id="sub" type="submit" name="post_submit" value="发布文章" />
<input id="reset" type="reset"  value="重置内容">
<span class="ajax" id="msgdemo"></span>
<input type="hidden" name="submit_posts_ajax" id="submit_posts_ajax" value="qqoq"/>
</form>
</div>