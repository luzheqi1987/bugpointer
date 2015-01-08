<?php

/**

 * A unique identifier is defined to store the options in the database and reference them from the theme.

 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.

 * If the identifier changes, it'll appear as if the options have been reset.

 */



function optionsframework_option_name() {



	// This gets the theme name from the stylesheet

	$themename = get_option( 'stylesheet' );

	$themename = preg_replace("/\W/", "_", strtolower($themename) );



	$optionsframework_settings = get_option( 'optionsframework' );

	$optionsframework_settings['id'] = $themename;

	update_option( 'optionsframework', $optionsframework_settings );

}



/**

 * Defines an array of options that will be used to generate the settings page and be saved in the database.

 * When creating the 'id' fields, make sure to use all lowercase and no spaces.

 *

 * If you are making your theme translatable, you should replace 'options_framework_theme'

 * with the actual text domain for your theme.  Read more:

 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain

 */



function optionsframework_options() {



	// Test data

	$test_array = array(

		'one' => __('One', 'options_framework_theme'),

		'two' => __('Two', 'options_framework_theme'),

		'three' => __('Three', 'options_framework_theme'),

		'four' => __('Four', 'options_framework_theme'),

		'five' => __('Five', 'options_framework_theme')

	);



	// Multicheck Array

	$multicheck_array = array(

		'one' => __('French Toast', 'options_framework_theme'),

		'two' => __('Pancake', 'options_framework_theme'),

		'three' => __('Omelette', 'options_framework_theme'),

		'four' => __('Crepe', 'options_framework_theme'),

		'five' => __('Waffle', 'options_framework_theme')

	);



	// Multicheck Defaults

	$multicheck_defaults = array(

		'one' => '1',

		'five' => '1'

	);



	// Background Defaults

	$background_defaults = array(

		'color' => '',

		'image' => '',

		'repeat' => 'repeat',

		'position' => 'top center',

		'attachment'=>'scroll' );



	// Typography Defaults

	$typography_defaults = array(

		'size' => '15px',

		'face' => 'georgia',

		'style' => 'bold',

		'color' => '#bada55' );

		

	// Typography Options

	$typography_options = array(

		'sizes' => array( '6','12','14','16','20' ),

		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),

		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),

		'color' => false

	);



	// Pull all the categories into an array

	$options_categories = array();

	$options_categories_obj = get_categories();

	foreach ($options_categories_obj as $category) {

		$options_categories[$category->cat_ID] = $category->cat_name;

	}

	

	// Pull all tags into an array

	$options_tags = array();

	$options_tags_obj = get_tags();

	foreach ( $options_tags_obj as $tag ) {

		$options_tags[$tag->term_id] = $tag->name;

	}



	// Pull all the pages into an array

	$options_pages = array();

	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');

	$options_pages[''] = 'Select a page:';

	foreach ($options_pages_obj as $page) {

		$options_pages[$page->ID] = $page->post_title;

	}

	

	$wp_editor_settings = array(

		'wpautop' => true, // Default

		'textarea_rows' => 5,

		'tinymce' => array( 'plugins' => 'wordpress' )

	);

	

	$wp_editor_small = array(

		'wpautop' => true, // Default

		'textarea_rows' => 2,

		'tinymce' => array( 'plugins' => 'wordpress' )

	);



	// If using image radio buttons, define a directory path

	$imagepath =  get_template_directory_uri() . '/framework/admin/images/';

		

	$options = array();

	

	$options[] = array( "name" => __("通用选项", "framework"),

						"type" => "heading");

						

	$options[] = array(

						'name' => __('启动实时搜索?', 'framework'),

						'desc' => __('强大的索引，每次输入都进行索引，并显示在下方！', 'framework'),

						'id' => 'st_live_search',

						'std' => '1',

						'type' => 'checkbox');

						

	$options[] = array(	'name' => __('搜索框显示文字', 'framework'),

						'desc' => __('', 'framework'),

						'id' => 'st_search_text',

						'std' => '请输入要搜索的关键字！',

						'type' => 'text');

											

					

	$options[] = array(	'name' => __('问答模块标识', 'framework'),

						'desc' => __('输入您的问答模块标识。', 'framework'),

						'id' => 'st_faq_slug',

						'std' => 'faq',

						'class' => 'mini',

						'type' => 'text');

						

	$options[] = array(

						'name' => __('文章设置', 'framework'),

						'desc' => __('选择要显示在文章中的信息。', 'framework'),

						'id' => 'st_article_meta',

						'std' => array(

									'date' => '1',

									'author' => '1',

									'category' => '1',

									'comments' => '1'), // On my default

						'type' => 'multicheck',

						'options' => array(

										'date' => __('日期', 'framework'),

										'author' => __('作者', 'framework'),

										'category' => __('所在类目', 'framework'),

										'comments' => __('留言数目', 'framework')),

						);

											

	$options[] = array(

						'name' => __('默认即可', 'framework'),

						'desc' => __('Check to show an author box at the end of an article. (The author must have their bio filled out for this to show)', 'framework'),

						'id' => 'st_single_authorbox',

						'std' => '1',

						'type' => 'checkbox');



	$options[] = array(

						'name' => __('是否显示相关文章？', 'framework'),

						'desc' => __('在底部显示相关文章。', 'framework'),

						'id' => 'st_single_related',

						'std' => '1',

						'type' => 'checkbox');

						

	$options[] = array( "name" => __("版权信息", "framework"),

						"desc" => __("自定义的版权文本将出现在你的主题的页脚。（附：可加入统计代码，为全站统计。）", "framework"),

						"id" => "st_footer_copyright",

						"std" => "&copy; Copyright, <a href='#'>luzhq/a>",

						"type" => "editor",

						"settings" => array( 'wpautop' => true, 'textarea_rows' => 3, 'tinymce' => array( 'plugins' => 'wordpress' )) );

	

						

	// Homepage Options

						

	$options[] = array( "name" => __("首页设置", "framework"),

						"type" => "heading");

									

	$options[] = array(

						'name' => __('顶级类目选项', 'framework'),

						'desc' => __('只是用顶级类目的设置。', 'options_framework_theme'),

						'type' => 'info');

						

	$options[] = array(	'name' => __('排除类别', 'framework'),

						'desc' => __('排除某些类目，不显示在首页中，如： 3,6,4', 'framework'),

						'id' => 'st_hp_cat_exclude',

						'std' => '',

						'class' => 'mini',

						'type' => 'text');

						

	$options[] = array(	'name' => __('显示文章数量', 'framework'),

						'desc' => __('显示在每个顶级目录下的文章数量。默认为 5', 'framework'),

						'id' => 'st_hp_cat_postnum',

						'std' => '5',

						'class' => 'mini',

						'type' => 'text');

						

	$options[] = array(

						'name' => __('显示类目排序', 'framework'),

						'desc' => __('修改首页的类目显示排序方式。', 'framework'),

						'id' => 'st_hp_cat_posts_order',

						'std' => 'date',

						'type' => 'select',

						'class' => 'mini', //mini, tiny, small

						'options' => array(

							'date' => __('时间', 'framework'),

							'rand' => __('随机', 'framework'),

							'meta_value_num' => __('热门', 'framework')

						));

						

	$options[] = array(

						'name' => __('顶级目录文章类计数？', 'framework'),

						'desc' => __('是否显示顶级目录下所以目录下文章的总数？', 'framework'),

						'id' => 'st_hp_cat_counts',

						'std' => '1',

						'type' => 'checkbox');

						

	$options[] = array(

						'name' => __('子类目设置', 'framework'),

						'desc' => __('选择是否显示子目录，以及排除显示的子目录。', 'options_framework_theme'),

						'type' => 'info');

						

	$options[] = array(

						'name' => __('是否显示子类目？', 'framework'),

						'desc' => __('设置首页显示顶级目录的同时是否显示子目录。', 'framework'),

						'id' => 'st_hp_subcat',

						'std' => '1',

						'type' => 'checkbox');

						

	$options[] = array(	'name' => __('排除子目录', 'framework'),

						'desc' => __('输入不显示的首页的子目录id，如：3,6,4', 'framework'),

						'id' => 'st_hp_subcat_exclude',

						'std' => '',

						'class' => 'mini',

						'type' => 'text');

						

	$options[] = array(

						'name' => __('子目录文章类计数', 'framework'),

						'desc' => __('是否显示子目录下文章数量？', 'framework'),

						'id' => 'st_hp_subcat_counts',

						'std' => '0',

						'type' => 'checkbox');	

						





	// Styling Opyions		

													

	$options[] = array( 

						"name" => __("框架设置", "framework"),

						"type" => "heading");

						

	$options[] = array( "name" => __("自定义Logo", "framework"),

						"desc" => __("选择您的LOGO地址，如果不设置则显示网站标题。", "framework"),

						"id" => "st_logo",

						"type" => "upload");

						

	$options[] = array( "name" => __("自定义图标", "framework"),

						"desc" => __("上传 16px x 16px png/ico 图标。", "framework"),

						"id" => "st_custom_favicon",

						"type" => "upload");

						

	$options[] = array( "name" => __("侧边栏布局", "framework"),

						"desc" => __("选择或禁用侧边栏，以及侧边栏的显示方式。", "framework"),

						"id" => "st_hp_sidebar",

						"std" => "sidebar-r",

						"type" => "images",

						"options" => array(

						"fullwidth" => $imagepath . "fullwidth.png",

						"sidebar-l" => $imagepath . "sidebar-left.png",

						"sidebar-r" => $imagepath . "sidebar-right.png")

						);

						

	$options[] = array( "name" => __("底部布局", "framework"),

						"desc" => __("选择底部信息的显示方式", "framework"),

						"id" => "st_footer_widgets_layout",

						"std" => "3col",

						"type" => "images",

						"options" => array(

						"2col" => $imagepath . "2col.png",

						"3col" => $imagepath . "3col.png",

						"4col" => $imagepath . "4col.png")

						);	

			

	$options[] = array( "name" => __("搜索主题颜色", "framework"),

						"desc" => __("设置搜索主题按钮颜色（建议默认）。", "framework"),

						"id" => "st_theme_color",

						"std" => "#a03717",

						"type" => "color");

				

	$options[] = array( "name" => __("链接颜色一", "framework"),

						"desc" => __("设置未在css中声明的以及文章中的连接颜色。", "framework"),

						"id" => "st_link_color",

						"std" => "#a03717",

						"type" => "color");

						

	$options[] = array( "name" => __("链接颜色二", "framework"),

						"desc" => __("设置鼠标经过链接颜。", "framework"),

						"id" => "st_link_color_hover",

						"std" => "#a03717",

						"type" => "color");

						

	$options[] = array( "name" => __("自定义CSS", "framework"),

						"desc" => __("为您的主题添加CSS。", "framework"),

						"id" => "st_custom_css",

						"std" => "",

						"type" => "textarea");



	return $options;

}







/*

 * This is an example of how to add custom scripts to the options panel.

 * This example shows/hides an option when a checkbox is clicked.

 */



add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');



function optionsframework_custom_scripts() { ?>



<script type="text/javascript">

jQuery(document).ready(function() {



jQuery('#st_live_search').click(function() {

jQuery('#section-st_search_text').fadeToggle(400);

});

if (jQuery('#st_live_search:checked').val() !== undefined) {

jQuery('#section-st_search_text').show();

}

});

</script>

<?php

}
