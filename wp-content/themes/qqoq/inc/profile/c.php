<?php
 if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
 die ('Please do not load this page directly. Thanks!');
?>
<div class="seo">
<p class="sp"><i class="sb">温馨提示</i>为了提高账户安全性，本站使用两种名称（登录名和昵称），尽可能避免两个名称同名，登录名不可修改只做登录用，昵称用来在本站显示。邮箱务必真实有效，以免忘却密码予以找回。网址和描述都将会显示在个人主页中。</p>
<form class="info" method="post" action="?action=qqoq_info">
<p><span>登录名：</span><b><?php echo $userinfo->user_login;?></b></p>
<p><span>昵  称：</span><input datatype="s" name="qqoq_name" type="text" value="<?php echo $userinfo->display_name;?>" /><span class="Validform_checktip"></span></p>
<p><span>邮  箱：</span><input datatype="e" type="text" name="qqoq_email" value="<?php echo $userinfo->user_email;?>" /><span class="Validform_checktip"></span></p>
<p><span>网  址：</span><input datatype="url" ignore="ignore" type="text" name="qqoq_url" value="<?php echo $userinfo->user_url;?>" /><span class="Validform_checktip"></span></p>
<p><span>描  述：</span><textarea name="qqoq_des" onKeyDown="gbcount(this.form.qqoq_des,this.form.remain);" onKeyUp="gbcount(this.form.qqoq_des,this.form.remain);"><?php the_author_meta('description',$userinfo->id)?></textarea></p>
<p class="maxcount">
<span>你还可以输入</span>
<input class="max" disabled name="remain" value="<?php echo 140-utf8_strlen(get_the_author_meta('description'))?>">
<span>字</span>
</p>
<p><input id="qqoq_save" type="submit" name="qqoq_save" value="保存资料" /><span class="ajaxmsg" id="msgdemo"></span></p>
</form>
</div>