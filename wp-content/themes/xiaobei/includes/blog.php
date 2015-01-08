<?php

  $display_categories = get_option('swt_cat_exclude');

  $limit = get_option('posts_per_page');

  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $sticky = get_option('sticky_posts');

  $args = array(

    'ignore_sticky_posts' => 1,

    //排除置顶文章，不输出置顶文章。这一句和上一句只留一句即可，根据自己需要处理

    'post__not_in' => $sticky,

    'paged' => $paged

  );

  query_posts($args);

  if (have_posts()) :

  while (have_posts()) : the_post();

  /* 此处自行添加输出内容，如标题、日期、作者、摘要等 */

  endwhile;

  endif;

?>

		<?php while (have_posts()) : the_post(); ?>
	<div class="art_img_box clearfix">
	
    <div class="fr box_content">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php echo cut_str($post->post_title,48); ?></a>&nbsp;<em><?php $t1=$post->post_date; $t2=date("Y-m-d H:i:s"); $diff=(strtotime($t2)-strtotime($t1))/3600; if($diff<24){echo '<img src="'.get_bloginfo('template_directory').'/images/new.gif" />';} ?></em></h2>  	
						
                    <div class="jiange"></div>
					<p class="intro">
						<?php if(has_excerpt()) the_excerpt();  
							else  
								 echo dm_strimwidth(strip_tags($post->post_content),0,170,"..."); ?>
					</p>
					<ul class="clearfix"></ul>
					<div class="info"><table width="650" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="570">&nbsp;&nbsp; 
                    	<span> 时间 : <?php the_time('Y-m-d') ?></span>| 
						<span>栏目 : <?php the_category(', ') ?></span>| 
						<span>浏览 : <?php post_views(' ', ' 次'); ?></span>| 
						<span><?php comments_popup_link('暂无评论', '评论 : ', '评论 : %'); ?></span>
						<span><?php the_tags(); ?></span>      
						<span><?php edit_post_link( __('|[编辑]')); ?></span></td>
                            <td width="80"><span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">[阅读全文]</a></span></td>
                          </tr>
                        </table>
					</div>
      </div>
        </div>
			<?php endwhile; ?>
	<?php  include(TEMPLATEPATH . '/includes/pagenavi.php');  ?>