<div id="sider" class="fr">

		<?php if (get_option('swt_blogger') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/blogger_info.php'); } ?>
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('List Sidebar')) : ?>	
    <?php endif; ?>
	<div id="rollstart"></div>
		<?php if (get_option('swt_ads') == '关闭') { ?>
		<?php { echo ''; } ?>
		<?php } else { include(TEMPLATEPATH . '/includes/ad_s.php'); } ?>
		<div class="clear"></div>	
</div>
</div> 
</div><!-- //wrapper -->