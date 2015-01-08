<?php



/**

* Register widgetized area and update sidebar with default widgets

*/

add_action( 'widgets_init', 'st_register_sidebars' );



function st_register_sidebars() {

	register_sidebar(array(

		'name' => '侧栏小工具',

		'id' => 'st_primary',

		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',

		'after_widget' => '</div>',

		'before_title' => '<h4 class="widget-title"><span>',

		'after_title' => '</span></h4>',

		)

	);

	

	// Setup footer widget column option variable

	if (of_get_option('st_footer_widgets_layout') == '2col') {

		$footer_widget_col = 'col-half';

		$footer_widget_col_descirption = 'Two Columns';

	} elseif (of_get_option('st_footer_widgets_layout') == '3col') {

		$footer_widget_col = 'col-third';

		$footer_widget_col_descirption = 'Three Columns';

	} elseif (of_get_option('st_footer_widgets_layout') == '4col') {

		$footer_widget_col = 'col-fourth';

		$footer_widget_col_descirption = 'Fours Columns';

	} else {

		$footer_widget_col = 'col-third';

		$footer_widget_col_descirption = 'Three Columns';

	}

	

	register_sidebar(array(

		'name' => '页脚小工具',

		'id' => 'st_footer_widgets',

		'description'   => 'The footer widget area is currently set to: '.$footer_widget_col_descirption.'. To change it go to the theme options panel.',

		'before_widget' => '<div id="%1$s" class="widget %2$s column '.$footer_widget_col.'">',

		'after_widget' => '</div>',

		'before_title' => '<h4 class="widget-title"><span>',

		'after_title' => '</span></h4>',

		)

	);
		register_sidebar(array(

		'name' => '公告栏',

		'id' => 'st_ggao_widgets',

		'description'   => '注意：将文本拖到公告，无需填标题，填写公告内容或html代码。可增加广告。',

		'before_widget' => '<div id="%1$s" class="st_ggao_widgets">',

		'after_widget' => '</div>',

		'before_title' => '<h4 class="widget-title"><span>',

		'after_title' => '</span></h4>',

		)

	);
			register_sidebar(array(

		'name' => '首页导航栏广告',

		'id' => 'st_indexdhg_widgets',

		'description'   => '注意：将文本拖到工具栏，填写广告代码。宽度大概:645px。',

		'before_widget' => '<div id="%1$s" class="st_indexdhg_widgets">',

		'after_widget' => '</div>',

		'before_title' => '<h4 class="widget-title"><span>',

		'after_title' => '</span></h4>',

		)

	);



}

						

?>