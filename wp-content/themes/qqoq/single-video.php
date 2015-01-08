<?php 
if (isset($_GET['ID'])) {
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/comments-ajax.js"></script>
<div class="ajax_v">
	  <div class="ajax_l">
      <?php while ( have_posts() ) : the_post();setPostViews(get_the_ID());?>
	     <?php the_content();?>
      <?php endwhile;?>
      <div class="ajax_b">
        <i>相关视频 <?php the_tags();?></i>
        <?php
         $tag = get_the_terms($post->ID,'video_tags');
         if(empty($tag)){
          echo "暂无相关视频";
         }else{
         foreach ($tag as $tags) {
           $arr[] = $tags->term_id;
         }
         $args = array(
          'posts_per_page' => 5,
          'post__not_in' => array($post->ID),
          'orderby' => 'rand',
          'tax_query' => array(
            array(
              'taxonomy' => 'video_tags',
              'terms' => $arr,
            )
          )
         );
         $query = new WP_Query( $args );
         while ( $query->have_posts() ) : $query->the_post();
          echo "<li><a class='qb fancybox.ajax' href=".get_permalink().link_at()."ID=".get_the_ID()."><img alt='".get_the_title()."' src='".get_post_meta($post->ID,'vimg',true)."'/></a><p>".get_the_title()."</p></li>";
         endwhile;wp_reset_query();
         }
        ?>
      </div>
    </div>
    <div class="ajax_r">
    	<h3><?php the_title();?></h3>
    	<div class="ajax_t">播放次数：<?php echo getPostViews(get_the_ID());?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;评论数量：<?php comments_number('还没有评论哦','1','%');?></div>
    	<?php comments_template('/comments-index.php' ); ?>
    </div>
</div>
<?php }else{ ?>
<?php get_template_part( 'header', 'min' ); ?>
<!--内容页start-->
<?php while ( have_posts() ) : the_post(); setPostViews(get_the_ID());?>
<div class="vn">
    <div class="v_title"><p class="vt"><?php the_title(); ?></p></div>
    <div class="v_l_v">
        <div class="vll">
            <?php the_content() ?>
        </div>
        <div class="vlr">
            <div class="v_mv">
                <?php the_post_thumbnail('b') ?>
            </div>
            <div class="vlr_list">
                <ul>
                    <?php 
                        $album_value = get_post_meta($post->ID, 'album_value', true);
                        $album_args = array(
                            'post_type' => 'video',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                 array(
                                     'key' => 'album_value',
                                     'value' => $album_value,
                                 )
                            )
                        );
                        $album_query = new WP_Query( $album_args );
                        while ( $album_query->have_posts() ) : $album_query->the_post();
                            if (selfURL() == get_permalink()) {
                                $class = "class='hb'";
                            }else{
                                $class = "";
                            }
                    ?>
                    <li>
                        <a title="<?php the_title() ?>" href="<?php the_permalink() ?>"><img <?php echo $class ?> alt="" width="120" height="66" src="<?php echo get_post_meta(get_the_ID(),'vimg',true) ?>"></a>
                        <h5><a title="<?php the_title() ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p><span class="count"><?php echo getPostViews(get_the_ID());?></span></p>
                    </li>
                    <?php endwhile;wp_reset_query(); ?>

                </ul>
            </div>
        </div>
    </div>
    <div class="v_l">
        <div class="v_l_x v_btn">
            <a title="喜欢" id="btn_like" class="btn_like" href="javascript:;"><i class="icon_like"></i><span>喜欢</span></a>
            <a class="btn_shared" href="javascript:;"><i class="icon_shared"></i><span>分享</span></a>
            <?php get_vote() ?>
            <div class="share_cp">
                <span>分享到：</span>
                <!-- Baidu Button BEGIN -->
                <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
                <a class="bds_tsina"></a>
                <a class="bds_qzone"></a>
                <a class="bds_tqq"></a>
                <a class="bds_renren"></a>
                <a class="bds_douban"></a>
                <a class="bds_sqq"></a>
                <a class="bds_tieba"></a>
                <a class="bds_hi"></a>
                <a class="bds_tqf"></a>
                </div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6443317" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                var bds_config = {'snsKey':{'tsina':sinakey,'tqq':qqtkey}};
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                <!-- Baidu Button END -->
            </div>
        </div>
        <?php 
            $tag = get_the_terms($post->ID,'video_tags');
            if (empty($tag)) {
                $f = false;
            }else{
                foreach ($tag as $tags) {
                    $arr[] = $tags->term_id;
                }
                $args = array(
                    'posts_per_page' => 8,
                    'post__not_in' => array($post->ID),
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'video_tags',
                            'terms' => $arr,
                        )
                    )
                );
                $query = new WP_Query( $args );
                if($query->post_count != 0)
                  $f = true; 
            }
            if ($f){
        ?>
        <div class="v_l_x">
            <p class="vt">相关视频<small>Relation Video</small></p>
            <div class="v_list">
                <ul> 
                    <?php
                        while ( $query->have_posts() ) : $query->the_post();
                    ?>
                    <li>
                        <a class="vr_img" href="<?php the_permalink() ?>"><img width="160" height="90" src="<?php echo get_post_meta($post->ID,'vimg',true) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"><span class="icon_play"></span></a>
                        <p class="vtit"><a href="<?php the_permalink() ?>" class="mv_name" title="<?php the_title() ?>"><?php the_title() ?></a></p>
                        <p><span class="count"><?php echo getPostViews(get_the_ID());?></span><span class="date"><?php the_time('Y-m-d') ?></span></p>
                    </li>
                    <?php endwhile;wp_reset_query(); ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <div class="v_l_x">
            <p class="vt">热门视频<small>Hot Video</small></p>
            <div class="v_list">
                <ul> 
                    <?php
                        $terms = get_the_terms( $post->ID, 'videos' );
                        foreach ((array)$terms as $term) {
                            $terms_id = $term->term_id;
                        }
                        $args1 = array(
                            'posts_per_page' => 8,
                            'meta_key' => 'views',
                            'orderby' => 'meta_value_num',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'videos',
                                    'terms' => $terms_id,
                                )
                            ),
                        );
                        $query1 = new WP_Query( $args1 );
                        while ( $query1->have_posts() ) : $query1->the_post();
                    ?>
                    <li>
                        <a class="vr_img" href="<?php the_permalink() ?>"><img width="160" height="90" src="<?php echo get_post_meta($post->ID,'vimg',true) ?>" alt="<?php the_title() ?>" title="<?php the_title() ?>"><span class="icon_play"></span></a>
                        <p class="vtit"><a href="<?php the_permalink() ?>" class="mv_name" title="<?php the_title() ?>"><?php the_title() ?></a></p>
                        <p><span class="count"><?php echo getPostViews(get_the_ID());?></span><span class="date"><?php the_time('Y-m-d') ?></span></p>
                    </li>
                    <?php endwhile;wp_reset_query(); ?>
                </ul>
            </div>
        </div>
        <div class="v_l_x v_comment">
            <p class="vt">评论<small>Comment</small></p>
            <div class="v_p">
                <?php comments_template(); ?>
            </div>
        </div>
    </div>
    <div class="v_r">
        <div class="v_bar">
            <p class="v_bar_p">视频信息</p>
            <?php  
                $n = new vote();
                $info = $n->vote_stat($post->ID);
            ?>
            <div class="v_grade">
                <div class="v_grade_l">
                    <strong><?php echo $info['grade'] ?></strong>
                    <p><?php echo $info['sum'] ?></p>
                </div>
                <div class="v_grade_r">
                    <p class="pct_like"><i class="icon_good"></i><span class="bar"><span style="width:<?php echo $info['pct_like'] ?>"></span></span><span class="rate_count"><?php echo $info['pct_like'] ?></span></p>
                    <p class="pct_bad"><i class="icon_bad"></i><span class="bar"><span style="width:<?php echo $info['pct_bad'] ?>"></span></span><span class="rate_count"><?php echo $info['pct_bad'] ?></span></p>
                </div>
            </div>
            <div class="vr_count">
              <p>播放次数：<?php echo getPostViews($post->ID);?></p>
              <p>发布时间：<?php the_time('Y-m-d h:s:m')?></p>
              <p>编辑：<?php the_author_posts_link(); ?></p>
            </div>
        </div>
        <div class="v_bar">
            <p class="v_bar_p">视频标签</p>
              <?php 
                  $args = array(
                      'smallest'                  => 12, 
                      'largest'                   => 12,
                      'unit'                      => 'px', 
                      'number'                    => "0",  
                      'link'                      => 'view', 
                      'taxonomy'                  => 'video_tags', 
                      'echo'                      => 0,
                  );
                  $r = wp_tag_cloud( $args );                  
              ?> 
              <div class="v_tag v_grade">
                  <?php print_r($r); ?>
              </div>
        </div>
        <div class="v_bar">
            <p class="v_bar_p">其它专辑</p>
            <div class="v_other v_grade">
                <a href=""><img src="http://imgcache.qq.com/music/common/upload/y/index/20131007093857"></a>
                <a href=""><img src="http://imgcache.qq.com/music/common/upload/y/index/20131007093637"></a>
                <a href=""><img src="http://imgcache.qq.com/music/common/upload/y/index/20130926192038"></a>
                <a href=""><img src="http://imgcache.qq.com/music/common/upload/y/index/20130924220650.jpg"></a>
                <a href=""><img src="http://imgcache.qq.com/music/common/upload/y/index/20130922093229.jpg"></a>
            </div>
        </div>
    </div>
</div>
<?php endwhile;wp_reset_query();?>
<?php get_footer(); ?>
<script type="text/javascript">
    $(".vlr_list ul").niceScroll({
        cursorcolor:"#4F4F4F",
        cursorwidth:"12px",
        cursorborderradius:"0",
        cursorborder: '0',
        autohidemode: '0'
    });
</script>
<?php }?>