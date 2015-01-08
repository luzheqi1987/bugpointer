<aside id="sidebar">
	<div id="primary" class="widget-area">
		<ul class="sidebar">
		<?php if (!function_exists('dynamic_sidebar')||!dynamic_sidebar('Primary Widget Area') ):?> 
		<?php endif; ?>       
		</ul>
	</div> 
	<div id="secondary" class="widget-area " style="overflow:hidden">
		<ul class="sidebar">
		<?php if (!function_exists('dynamic_sidebar')||!dynamic_sidebar('Secondary Widget Area') ) : ?>        
		<?php endif; ?>
	    </ul>
	</div>
</aside>