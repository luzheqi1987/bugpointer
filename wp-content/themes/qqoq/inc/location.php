<div id="e">
    <?php if (is_singular()) {?>
        <div class="s">
            <a data-pic="<?php echo catch_first_image('full');?>" data-link="<?php the_permalink() ?>" data-title="<?php the_title_attribute(); ?>" title="分享到QQ空间" class="s-z" href="#"></a>
            <a data-pic="<?php echo catch_first_image('full');?>" data-link="<?php the_permalink() ?>" data-title="<?php the_title_attribute(); ?>" title="分享到新浪微博" class="s-s" href="#"></a>
            <a data-pic="<?php echo catch_first_image('full');?>" data-link="<?php the_permalink() ?>" data-title="<?php the_title_attribute(); ?>" title="分享到腾讯微博" class="s-t" href="#"></a>
        </div>
    <?php }?>
	  <span class="e_i"></span>
        当前位置：<a href="<?php bloginfo('url'); ?>">首 页</a> > 
	  <?php
        if( is_single() ){
            $categorys = get_the_category();
            $category = $categorys[0];
            echo( get_category_parents($category->term_id,true,' >') );echo $s.' 查看文章';
        } elseif ( is_home() ){
            
        } elseif ( is_page() ){
            the_title();
        } elseif ( is_category() ){
            single_cat_title();
        } elseif ( is_tag() ){
            single_tag_title();
        } elseif ( is_day() ){
            the_time('Y年Fj日');
        } elseif ( is_month() ){
            the_time('Y年F');
        } elseif ( is_year() ){
            the_time('Y年');
        } elseif ( is_search() ){
            echo $s.' 的搜索结果';
        }elseif ( taxonomy_exists('videos') ){
            echo get_queried_object()->name;
        }
    ?>
</div>