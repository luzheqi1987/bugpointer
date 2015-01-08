<?php 
    if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
    add_action('admin_init', 'qqoq_init');
    function qqoq_init() {
	if (isset($_GET['page']) && $_GET['page'] == 'admin-s.php') {
		$dir = get_bloginfo('template_directory');
		wp_enqueue_script('adminjquery', $dir . '/js/jquery-1.7.2.min.js', false, '1.0.0', false);
		wp_enqueue_script('slides', $dir . '/js/jquery.slide.js', false, '1.0.0', false);
		wp_enqueue_style('css', $dir . '/css/admin.css', false, '1.0.0', 'screen');
		wp_enqueue_script('thickbox');   
        wp_enqueue_style('thickbox');
		wp_enqueue_script('admin', $dir . '/js/admin.js', false, '1.0.0', false);
	}
    }
    add_action('admin_menu', 'qqoq_function'); 
	$select=array('comment_moderation','waiting_time','ad4_close','ad3_close','tg','qqtid','qqtkey','ad1','ad2','ad3','ad4','ad5','ad6','ad7','close','ad8','logo','logob','category','new','display_model','qqid','qqkey','sinaid','sinakey','qqoq_description','qqoq_keywords','copy');
    foreach($select as $sel){
     if( get_option($sel) == '' ){   
     switch($sel){
      case 'ad3_close':
      case 'ad4_close':
      case 'close':
        $option = 'open';   
	    break;
      case 'ad1':
        $option = '<img alt="ad" src="'.get_bloginfo('template_directory').'/img/ad.png"/>';   
	    break;
	  case 'ad2':
        $option = '<img alt="ad" src="'.get_bloginfo('template_directory').'/img/ad.png"/>';
	    break;
	  case 'ad3':
        $option = '<img alt="ad" src="'.get_bloginfo('template_directory').'/img/ad.gif"/>';
	    break;
	  case 'ad4':
	  case 'ad9':
        $option = '<img alt="ad" src="'.get_bloginfo('template_directory').'/img/ad1.gif"/>';
	    break;
	  case 'ad8':
        $option = '<img alt="ad" src="'.get_bloginfo('template_directory').'/img/ad8.gif"/>';
	    break;
	  case 'logo':
        $option = get_bloginfo('template_directory').'/img/logo.png';
	    break;
	  case 'logob':
        $option = get_bloginfo('template_directory').'/img/flogo.png';
	    break;
	  case 'copy':
        $option = 'Copyright &copy; QQOQ Studio All Rights Reserved.';
	    break;
	  case 'category':
	  	$option = '1';
	    break;
	  case 'tg':
        $option = array(1);
	    break;
	  case 'new':
        $option = array(
           '0' => '幻灯片1标题',
           '1' => '幻灯片1描述,你可以输入相关描述内容。',
           '2' => 'http://www.qqoq.net',
           '3' => get_bloginfo('template_directory').'/img/1.jpg',
           '4' => '幻灯片2标题',
           '5' => '幻灯片2描述,你可以输入相关描述内容。',
           '6' => 'http://www.qqoq.net',
           '7' => get_bloginfo('template_directory').'/img/2.jpg',
           '8' => '幻灯片3标题',
           '9' => '幻灯片3描述,你可以输入相关描述内容。',
           '10' => 'http://www.qqoq.net',
           '11' => get_bloginfo('template_directory').'/img/3.jpg',
           '12' => '幻灯片4标题',
           '13' => '幻灯片4描述,你可以输入相关描述内容。',
           '14' => 'http://www.qqoq.net',
           '15' => get_bloginfo('template_directory').'/img/4.jpg',
        );
	    break;
	  case 'display_model':
	    $option = array(
           '0' => 'cms'
	    );
	    break;
	  case 'qqid':
	  case 'qqkey':
	  case 'qqtid':
	  case 'qqtkey':
	  case 'sinaid':
	  case 'sinakey':
	  case 'qqoq_description':
	  case 'qqoq_keywords':
	  case 'ad5':
	  case 'ad6':
	  case 'ad7':
	  case 'comment_moderation':
	    $option = '';
	    break;
	  case 'waiting_time':
	  	$option = '30';
	    break;
	 }
	 update_option($sel, $option);
	 }
	}
    if(isset($_POST['option_save'])){  
		foreach($select as $sel){
        if($sel=="new" || $sel=="display_model" || $sel=="tg"){
		  $option = $_POST[$sel];
		}else{
          $option = stripslashes($_POST[$sel]); 
		}
        update_option($sel, $option);
		}
    }
    function qqoq_function(){   
        add_theme_page( 'QQOQ主题设置', 'QQOQ主题设置', 'edit_themes',basename(__FILE__), 'content_function');   
    }   
    function content_function(){?>
    <form method="post" name="qqoq_form" id="qqoq_form">
    <div class="main">
    	<div class="cats">
			<table cellspacing="0" cellpadding="0">
				<tr><td class="w50">ID</td><td class="w150">分类名称</td></tr>
				<?php 
					$categories = get_terms( array('category','videos'), 'orderby=count&hide_empty=0' );
					foreach ($categories as $pcats) {
						echo "<tr><td class='w50'>{$pcats->term_id}</td><td class='w150'>{$pcats->name}</td></tr>";
					}
				?>
			</table>
		</div>
	 	<div class="h">
	  		<div class="hl">
	   			<h2>QQOQ主题设置</h2>
	  		</div>
		  	<div class="hr">
		   		<a href="http://www.qqoq.net" target="_blank">+ 模板制作</a>
		  	</div>
	 	</div>
	<div class="n">
	   <div class="hd">
		<ul class="l">
		 <li>广告设置</li>
		 <li>常规设置</li>
		 <li>SEO设置</li>
		 <li>评论设置</li>
		</ul>
	   </div>
	    <div class="bd">
			<ul class="infoList">
			  <p class="ad">
				  <i>幻灯片设置</i>
				  <?php
					$a='0';$b='1';$c='2';$d='3';
					$new = get_option('new');
					for ($i=1; $i <=4 ; $i++) {
				  ?>
				  <span class="hdp">
				  <b>标题：</b><input type="text" value="<?php echo $new[$a]?>" name="new[]" class="m10">
				  <b>描述：</b><input type="text" value="<?php echo $new[$b]?>" name="new[]" class="m10"><br/>
				  <b>链接：</b><input type="text" value="<?php echo $new[$c]?>" name="new[]">
				  <b>图片：</b><input type="text" value="<?php echo $new[$d]?>" name="new[]" class="hdt<?php echo $i?>">
				  </span>
				  <input type="button" name="upload_button" value="图片上传" class="upbottom<?php echo $i?>"/>
				  <span class="adsj">幻灯片<?php echo $i?><br/>尺寸 430px(宽)*200px(高)</span>
				  <?php $a+=4;$b+=4;$c+=4;$d+=4;}?>
			  </p>
	          <p class="ad">
		          <i>AD1广告设置</i>
				  <textarea name="ad1"/><?php echo get_option('ad1'); ?></textarea>
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/>
				  <span class="adsj">尺寸 220px(宽)*96px(高)</span>
			  </p>   
			  <p class="ad">
				  <i>AD2广告设置</i>
				  <textarea name="ad2"/><?php echo get_option('ad2'); ?></textarea>  
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 220px(宽)*96px(高)</span>
			  </p>
			  <p class="ad">
				  <i>AD3广告设置</i>
				  <?php $ad3_close = get_option('ad3_close'); ?>
				  <span class="adclose">
				  	  是否开启广告：
					  <select name="ad3_close">
						  <option value ="close" <?php selected( $ad3_close, close ); ?>>关闭</option>
						  <option value ="open" <?php selected( $ad3_close, open ); ?>>开启</option>
					  </select>
				  </span>
				  <textarea name="ad3"/><?php echo get_option('ad3'); ?></textarea>   
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 972px(宽)*90px(高)</span>
			  </p>
			  <p class="ad">
				  <i>AD4广告设置</i>
				  <?php $ad4_close = get_option('ad4_close'); ?>
				  <span class="adclose">
				  	  是否开启广告：
					  <select name="ad4_close">
						  <option value ="close" <?php selected( $ad4_close, close ); ?>>关闭</option>
						  <option value ="open" <?php selected( $ad4_close, open ); ?>>开启</option>
					  </select>
				  </span>
				  <textarea name="ad4"/><?php echo get_option('ad4'); ?></textarea>   
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 274px(宽)*高度自定</span>
			  </p>
			  <p class="ad">
				  <i>AD5广告设置</i>
				  <textarea name="ad5"/><?php echo get_option('ad5'); ?></textarea>   
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 671px(宽)*高度自定，如果留空则不显示此广告位。</span>
			  </p>
			  <p class="ad">
				  <i>AD6广告设置</i>
				  <textarea name="ad6"/><?php echo get_option('ad6'); ?></textarea>   
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 671px(宽)*高度自定，如果留空则不显示此广告位。</span>
			  </p>
			  <p class="ad">
				  <i>AD7广告设置</i>
				  <textarea name="ad7"/><?php echo get_option('ad7'); ?></textarea>   
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 671px(宽)*高度自定，如果留空则不显示此广告位。</span>
			  </p>
			  <p class="ad">
				  <i>AD8广告设置</i>
				  <textarea name="ad8"/><?php echo get_option('ad8'); ?></textarea>   
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/> 
				  <span class="adsj">尺寸 175px(宽)*288px(高)</span>
			  </p>
			</ul>
			<ul class="infoList">
			  <p class="ad">
				  <i>首页显示模式</i>
				  <?php $display = get_option('display_model');?>
				  <label style="margin-right:100px;">Blog模式 <input type='radio' <?php if($display['0']=='blog'){ echo 'checked="true"';}?> name='display_model[]' value='blog' /></label> 
				  <label>CMS模式 <input type='radio' <?php if($display['0']=='cms'){echo 'checked="true"';}?> name='display_model[]' value='cms' /></label>
			  </p>
			  <p class="ad">
		          <i>头部LOGO</i>
				  <textarea name="logo"/><?php echo get_option('logo'); ?></textarea>
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/>
				  <span class="adsj">无尺寸限制，自行规范</span>
			  </p>   
			  <p class="ad">
		          <i>页脚LOGO</i>
				  <textarea name="logob"/><?php echo get_option('logob'); ?></textarea>
				  <input type="button" name="upload_button" value="图片上传" class="upbottom"/>
				  <span class="adsj">无尺寸限制，自行规范</span>
			  </p>   
			  	<p class="ad cat">
		          	<i>首页栏目显示（CMS模式）</i>
				  	<textarea name="category"/><?php echo get_option('category'); ?></textarea>
				  	<span class="adsj">输入分类的ID，多个ID请用英文逗号（,）分隔。</span>
			  	</p>
			  <p class="ad cat">
				  <i>会员中心投稿栏目设置</i>
				  <?php
				  $arg1 = array(
			       'child_of'      => 0,
			       'parent'        => '',
			       'orderby'       => 'name',
			       'order'         => 'ASC',
			       'hide_empty'    => 0,
			       'hierarchical'  => 1,
			       'exclude'       => '',
			       'include'       => '',
			       'number'        => '',
			       'taxonomy'      => array('category'),
			       'pad_counts'    => false 
		          );
		          $categories1=get_categories($arg1);
		          $cats1=get_option('tg');
			       foreach($categories1 as $category1) {
			       	 if(in_array($category1->term_id, $cats1)){
				        echo "<label><input type='checkbox' checked='true' name='tg[]' value='$category1->term_id' /> ";
				     }else{
		                echo "<label><input type='checkbox' name='tg[]' value='$category1->term_id' /> ";
				     }
				     echo $category1->cat_name;
				     echo '</label>';
			       }
		          ?>
			  </p>
				  <p class="ad">
				  	<i>是否开启会员投稿：</i>
				  <select name="close">
					  <option value ="close" <?php selected( get_option('close'), close ); ?>>关闭</option>
					  <option value ="open" <?php selected( get_option('close'), open ); ?>>开启</option>
				  </select>
				  </p>
			  <p class="ad">
				  <i>登录设置</i>
				  <span class="hdp w760">
				  <b class="ww">QQ登录 APP ID：</b><input type="text" value="<?php echo get_option('qqid')?>" name="qqid" class="m10">
				  <b class="ww">KEY：</b><input type="text" value="<?php echo get_option('qqkey')?>" name="qqkey" class="m10">
				  <a target="_blank" href="http://connect.qq.com/intro/login/" class="wdz">申请地址</a>
				  </span>
				  <span class="hdp w760">
				  <b class="ww">QQ微博 App Key：</b><input type="text" value="<?php echo get_option('qqtid')?>" name="qqtid" class="m10">
				  <b class="ww">App Secret：</b><input type="text" value="<?php echo get_option('qqtkey')?>" name="qqtkey" class="m10">
				  <a target="_blank" href="http://dev.t.qq.com/" class="wdz">申请地址</a>
				  </span>
				  <span class="hdp w760">
				  <b class="ww">新浪登录 App Key：</b><input type="text" value="<?php echo get_option('sinaid')?>" name="sinaid">
				  <b class="ww">App Secret：</b><input type="text" value="<?php echo get_option('sinakey')?>" name="sinakey">
				  <a target="_blank" href="http://open.weibo.com/" class="wdz">申请地址</a>
				  </span>
			  </p>
			  <p class="ad">
				  <i>页脚设置</i>
				  <textarea class="w760" name="copy"/><?php echo get_option('copy'); ?></textarea>
			  </p>
			</ul>
			<ul class="infoList">
			 <p class="ad">
				  <i>SEO描述</i>
				  <textarea class="w760" name="qqoq_description"/><?php echo get_option('qqoq_description'); ?></textarea>
			 </p>
			 <p class="ad">
				  <i>SEO关键词</i>
				  <textarea class="w760" name="qqoq_keywords"/><?php echo get_option('qqoq_keywords'); ?></textarea>
			 </p>
			</ul>
			<ul class="infoList">
				<p class="ad">
				  	<i>评论间隔时间</i>
				  	<span class="hdp">
					  	<span class="lq w620">
						  	<b>时间（秒）：</b><input type="text" value="<?php echo get_option('waiting_time'); ?>" name="waiting_time" class="m10"><span class="cp">再次评论的间隔时间，默认是30秒</span>
					    </span>
				  	</span>
				</p>
				<p class="ad">
				  	<i>评论是否需要审核</i>
				  	<span class="hdp">
					  	<span class="lq w620">
						  	<b>开启审核：</b><input type="checkbox" <?php checked( get_option('comment_moderation'), 1, 1 ); ?> value="1" id="comment_moderation" name="comment_moderation"><span class="cp">评论是否需要审核</span>
					    </span>
				  	</span>
				</p>
			</ul>
	    </div>
	 </div>
	</div>
	<p class="submit">   
	    <input class="button-primary" type="submit" name="option_save" value="保存设置" /> 
	</p>
	</form>
	<script type="text/javascript">
		jQuery(".n").slide({trigger:"click"});
	</script>
    <?php }?>