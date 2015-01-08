<!-- blog列表-->
			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
            <div class="art_img_box clearfix">
	
    <div class="fr box_content">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php echo cut_str($post->post_title,48); ?></a></h2>  	
						
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
			<?php else : ?>
			<h3>什么也找不到！</h3>
			<p>抱歉,你要找的文章不在这里.</p>
			<?php endif; ?>
	<div class="page_navi"><?php par_pagenavi(9); ?></div>
<!--blog列表结束 -->