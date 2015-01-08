<!-- //底部模板 -->
<div class="footer">
		<div class="bottom_nav  clearfix"><?php wp_nav_menu(array( 'theme_location' => 'footer-menu' ) ); ?></div>		<div class="footer_nav clearfix" >
		<p>本站基于<a href="http://www.kanhulian.com/" title="看互联" target="_blank">看互联网</a>构建。除非注明，所有文章为本人原创，转载请保留版权！</p>
        <p>Copyright © 2011-2014 <a href="http://www.kanhulian.com/">KANHULIAN.COM</a> All Rights Reserved.Themes By:<a href="http://www.kanhulian.com/">小北 </a><?php echo stripslashes(get_option('swt_track_code')); ?></p>
        <p><a href="http://www.kanhulian.com/sitemap.html" title="百度地图" target="_blank">百度地图</a> | <a href="http://www.kanhulian.com/sitemap_baidu.xml" title="XML文件" target="_blank">XML文件</a> | <a href="http://www.kanhulian.com/sitemap.xml" title="谷歌地图" target="_blank">谷歌地图</a></p>  
		</div>
	</div>
<!-- Generated in 2.498 seconds. Made 71 queries to database and 21 cached queries. Memory used - 34.13MB -->
<!-- Cached by DB Cache Reloaded Fix -->
</div><!--wrapmain-->
 <?php wp_footer(); ?>
		<div id="shangxia"><div id="shang" title="↑ 返回顶部"></div>
		<?php if ( is_singular() ){ ?>
		<div id="comt" title="查看评论"><div align="center"><?php comments_number('0','1','%'); ?></div></div>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
		<!-- Baidu Button END -->
		<script type="text/javascript" id="bdshare_js" data="type=button&amp;uid=6632901" ></script>
		<script type="text/javascript" id="bdshell_js"></script>
		<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
		</script>
		<!-- Baidu Button END -->
		<?php } ?>
		<div id="xia" title="↓ 移至底部"></div>
		<div id="myrss" title="<?php echo get_option('swt_rss'); ?>" onClick="window.open('<?php echo get_option('swt_rsssub'); ?>','_blank');"></div></div>

</div>

<p align="center"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_5939033'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/stat.php%3Fid%3D5939033%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fb10cbd9f336907851a841d8109ec195f' type='text/javascript'%3E%3C/script%3E"));
</script>

</p>

<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"1","bdPos":"right","bdTop":"100"},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

</body>
</html>