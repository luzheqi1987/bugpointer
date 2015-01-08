</div>
 
    <footer id="footer">
        <div id="colophon">
 
            <div id="site-info" style="overflow:hidden"><div id="footer-widget" class="widget-area">
	<ul class="xoxo">
	<?php if (!function_exists('dynamic_sidebar')||!dynamic_sidebar('footer Widget Area') ) :  ?> <?php endif; ?>
	</ul>
	</div>
            </div><!-- #site-info -->
 <div id="last" style="text-align:center"><p style="font-size:120%;color:white;font-weight:bold;clear:both;">Copyright &copy; <a href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a> 2012 - All Rights Reserved. Powered By WordPress. Designed By <a href="http://halfangelhalfdevil.com/blog">老妖</a></div>
        </div><!-- #colophon -->
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("#w-loading div").animate({width:"100%"},800,function(){
setTimeout(function(){jQuery("#w-loading div").fadeOut(500);
});
});
});</script>
</footer>
</div>
<script type="text/javascript">
function externallinks()
{
if (!document.getElementsByTagName) return;
var anchors = document.getElementsByTagName("a");
for (var i=0; i<anchors.length; i++)
{
var anchor = anchors[i];
if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external nofollow")
{
anchor.target = "_blank";
}
}
}
window.onload = externallinks;
</script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/yotheme.js"></script>
<div style="display:none;"><script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F5c392b531ccb5d9cf6a70087eed4eb17' type='text/javascript'%3E%3C/script%3E"));
</script></div>
<div id="shangxia"><div id="shang"></div>
<?php if (is_single()) { ?><div id="comt"></div><?php } ?><div id="xia"></div></div>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/Simple-M.js"></script>
</body>
</html>