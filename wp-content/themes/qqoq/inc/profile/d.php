<?php
 if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
 die ('Please do not load this page directly. Thanks!');
?>
<div class="seo">
<p class="sp"><i class="sb">温馨提示</i>为了提高账户安全性，密码不能少于6位字符（可以为6位），最长可为16位。最好使用数字加字母的形式，也可以使用特殊符号作为密码。</p>
<form class="info" method="post" action="?action=qqoq_pass">
<p><span>新密码：</span><input datatype="*6-16" errormsg="密码范围在6~16位之间！" nullmsg="请设置密码！" type="password" name="qqoq_pw" value="" /><span class="Validform_checktip"></span></p>
<p><span>重输一遍：</span><input datatype="*" recheck="qqoq_pw" errormsg="您两次输入的账号密码不一致！" nullmsg="请再输入一次密码！" type="password" name="qqoq_tpw" value="" /><span class="Validform_checktip"></span></p>
<p id="pass"><input id="qqoq_pass" type="submit" name="qqoq_pass" value="更新密码" /><span class="ajaxmsg" id="msgdemo"></span></p>
</form>
</div>