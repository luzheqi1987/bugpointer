<?php 
global $select;
$c = '这里提供快捷的广告代码更换模式，如需更丰富的设置模式（如：上传图片等）请到<a href="'.get_bloginfo('url').'/wp-admin/themes.php?page=admin-s.php">后台设置面板</a>设置';
foreach($select as $sel){
	switch($sel){
      case 'ad1':
        $title = "广告AD1设置";
	    $content = $c.'<br>尺寸：220px(宽)*96px(高)';
	    break;
	  case 'ad2':
        $title = "广告AD2设置";
	    $content = $c.'<br>尺寸：220px(宽)*96px(高)';
	    break;
	  case 'ad3':
        $title = "广告AD3设置";
	    $content = $c.'<br>尺寸：972px(宽)*90px(高)';
	    break;
	  case 'ad4':
        $title = "广告AD4设置";
	    $content = $c.'<br>尺寸：318px(宽)，高度自定';
	    break;
	  case 'ad5':
        $title = "广告AD5设置";
	    $content = $c.'。<a style="color:#0F820C">如果留空则不显示此广告位。</a><br>尺寸：799px(宽),高度自定';
	    break;
	  case 'ad6':
        $title = "广告AD6设置";
	    $content = $c.'。<a style="color:#0F820C">如果留空则不显示此广告位。</a><br>尺寸：799px(宽),高度自定';
	    break;
	  case 'ad7':
        $title = "广告AD7设置";
	    $content = $c.'。<a style="color:#0F820C">如果留空则不显示此广告位。</a><br>尺寸：799px(宽),高度自定';
	    break;
	  case 'ad8':
        $title = "广告AD8设置";
	    $content = $c.'<br>尺寸：175px(宽)*288px(高)';
	    break;
	  case 'logo':
        $title = "顶部LOGO设置";
	    $content = '这里提供快捷的LOGO代码更换模式，如需更丰富的设置模式（如：上传图片等）请到<a href="/wp-admin/themes.php?page=admin-s.php">后台设置面板</a>设置';
	    break;
	  case 'logob':
        $title = "页脚LOGO设置";
	    $content = '这里提供快捷的LOGO代码更换模式，如需更丰富的设置模式（如：上传图片等）请到<a href="/wp-admin/themes.php?page=admin-s.php">后台设置面板</a>设置<br>尺寸：建议170px(宽) * (高)70px';
	    break;
	  case 'copy':
        $title = "版权设置";
	    $content = '这里提供快捷的版权代码更换模式，请保留本主题版权信息以示对我们的尊重和支持，若需去版权请联系主题作者。';
	    break;
	  case 'category':
        $title = "分类显示设置";
	    $content = '这里提供快捷的首页分类显示更换模式，请从右边勾选需要在首页显示的分类，如果为空则默认显示系统原有的‘未分类’。';
	    break;
	  case 'new':
        $title = "最新显示设置";
	    $content = '这里提供快捷的分类最新文章显示更换模式，请从右边勾选需要在首页显示的分类，如果为空则默认显示系统原有的‘未分类’。';
	    break;
	 }
?>
<div id="q<?php echo $sel?>" style="display:none;">
<form method="post" name="qqoq_form" class="qqoq_form" action="<?php bloginfo('home'); ?>/wp-admin/options.php">
<?php if($sel=='new'){
	$a='0';$b='1';$c='2';$d='3';
	$new = get_option('new');
	for ($i=1; $i <=4 ; $i++) { 
?>
    <div class="new<?php echo $i ?>">
    	<i>幻灯片<?php echo $i ?>设置</i>
    	<span>标题：</span><input class="il ib" type="text" name="new[]" value="<?php echo $new[$a]?>" />
    	<span>描述：</span><input class="ib" type="text" name="new[]" value="<?php echo $new[$b]?>" />
    	<span>链接：</span><input class="il" type="text" name="new[]" value="<?php echo $new[$c]?>" />
    	<span>图片：</span><input type="text" name="new[]" value="<?php echo $new[$d]?>" />
    </div>
<?php $a+=4;$b+=4;$c+=4;$d+=4; }?>
<?php wp_nonce_field('update-options'); ?>   
<input type="hidden" name="action" value="update" />   
<input type="hidden" name="page_options" value=<?php echo $sel?> />
<input type="submit" name="option_save_<?php echo $sel?>" class="nb" value="保存设置" />
<?php }else{?>
 <div class="adw">
 <i><?php echo $title?></i>
 <span><?php echo $content?></span>
 </div>
<form method="post" name="qqoq_form" class="qqoq_form" action="<?php bloginfo('home'); ?>/wp-admin/options.php">
       <textarea  name="<?php echo $sel;?>" class="qqad"/><?php echo get_option($sel); ?></textarea>  
	   <?php wp_nonce_field('update-options'); ?>   
       <input type="hidden" name="action" value="update" />   
       <input type="hidden" name="page_options" value=<?php echo $sel?> />
	   <input type="submit" name="option_save_<?php echo $sel?>" class="sub" value="保存设置" />
</form>
<?php }?>
</div>
<?php }?>