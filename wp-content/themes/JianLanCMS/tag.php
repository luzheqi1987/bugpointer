<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<div class="article_list_con w972">
<div class="article_list_left left">
<dd class="arc_desc"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 240,"..."); ?></dd>
<dd class="arc_info"><span>所属栏目：<?php echo $name; ?></span>   <span>更新日期：<?php the_time('m-d') ?></span> <span><a rel="nofollow" href="<?php the_permalink() ?>">[阅读全文]</a></span></dd>
<div style="clear:both"></div>
        </div>
    <div class="fanye">
        	<ul>
        </ul>
        <div style="clear:both"></div>
        </div>
</div>

</div>
<?php wp_footer();?>