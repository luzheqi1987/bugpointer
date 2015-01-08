<div id="f">
<?php 
$count = 1;
if (is_home()) {
    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
    if ($paged == '1') {
        $offset = '11';
    }else{
        $offset = ($paged - 1) * get_option('posts_per_page')  + 11;
    }
    $arry = array(
        'paged' => $paged,
        'offset' => $offset,
        'ignore_sticky_posts' => 1
    );
    query_posts($arry);
}
?>
<?php if (have_posts()) : ?>
<ul>
	<?php while (have_posts()) : the_post(); ?>
<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<?php if(($count == 1||$count == 2||$count == 3)) { ?>
 <div class="article">
    <div class="newtitle">
        <div class="post_date">
            <span class="date_d"><?php the_time('d') ?></span>
            <span class="date_y"><?php the_time('Y-m') ?></span>
        </div>
        <div class="line">
        </div>
        <h2>
            <a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            <span class="new">
			<?php newpost();?>
            </span>
        </h2>
        <div class="infotop2">
            <span class="info-category-icon">
                <?php echo get_the_term_list(get_the_ID(), array('category','videos'), '', ', ', ''); ?>
            </span>
            <span class="info-view-icon">
                已有<?php echo getPostViews(get_the_ID());?>人围观
            </span>
            <span class="info-comment-icon">
                <?php comments_popup_link ('0条评论','1条评论','%条评论'); ?>
            </span>
			<span>供稿者：<?php the_author_posts_link(); ?></span>
        </div>
    </div>
    <div class="thumbnail_box_top">
            <a href="<?php the_permalink() ?>" target="_blank" title="<?php the_title(); ?>"><img src="<?php echo hot_thumbnail_image() ?>" alt="<?php the_title_attribute(); ?>" class="qqoq" /></a>
    </div>
    <div class="entry_post_top">
            <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"...","utf-8"); ?>
    </div>
	<div class="intag">
    <?php if(the_tags()){?>
            <span class="info-tag-icon">
                <?php the_tags('标签：', ', ', ''); ?>
            </span>
	<?php }?>
    </div>
</div>

<?php } else{ ?>
<div class="article_b">
 <span class="small-number"><?php the_time('Y-m-d') ?></span>
 <div class="tagleft"><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2></div>
 <div class="infotop">
  <span class="info-category-icon"><?php echo get_the_term_list(get_the_ID(), array('category','videos'), '', ', ', ''); ?></span>
  <span class="info-view-icon">已有<?php echo getPostViews(get_the_ID());?>围观</span>
  <span class="info-comment-icon"><?php comments_popup_link ('0条评论','1条评论','%条评论'); ?></span>
  <span>供稿者：<?php the_author_posts_link(); ?></span>
 </div>
 <div class="thumbnail_box">
   <a href="<?php the_permalink() ?>" rel="bookmark" target="_blank" title="<?php the_title(); ?>">
   <img src="<?php echo catch_first_image('medium')?>" width=140 height=100 alt="<?php the_title(); ?>"></a>
 </div>
 <div class="entry_post">
  <span><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 234,"...","utf-8"); ?></span>
 </div>
 <?php }$count++;?>
 </li>
<?php endwhile;wp_reset_postdata(); ?>
</ul>
<div class="navigation">
	 <?php pagination($query_string); ?>
</div>
<?php else:?>
<span class="unfound">~(>_<)~ 什么也没找到!</span>
<?php endif; ?>
</div>