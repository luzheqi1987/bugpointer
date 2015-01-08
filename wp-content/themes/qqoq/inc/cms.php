<div id="k">
<?php 
  $str = get_option('category'); 
  $display_categories = explode(",",$str);
  foreach ($display_categories as $key=>$cate)
{ 
    $args = array(
      'posts_per_page' => '7',
      'tax_query' => array(
        'relation' => 'OR',
        array(
          'taxonomy' => 'category',
          'field' => 'id',
          'terms' => $cate
        ),
        array(
          'taxonomy' => 'videos',
          'field' => 'id',
          'terms' => $cate
        ),
      )
    );
   $query = new WP_Query( $args );
   $i=0;
?>
  <div class="<?php if($key%2==0){echo 'kl';}else{ echo 'kr';}?>">
      <?php 
          while ($query->have_posts()) : $query->the_post();
          if ($post->post_type == 'video') {
          	  	$taxonomy = 'videos';
          }elseif($post->post_type == 'post'){
          		$taxonomy = 'category';
          }
          $term = get_term($cate,$taxonomy);
          $cat_name = $term->name;
          $cat_link = get_term_link($term->term_id,$taxonomy );
          $i++;if($i==1){
      ?>
       <div class="kt">
         <h2><?php echo "<a href='".$cat_link."'>".$cat_name."</a>";?></h2><span><?php the_tags('','，','');?></span>
       </div>
       <div class="kc">
         <a href="<?php the_permalink() ?>"><img src="<?php echo catch_first_image('m')?>" width=80 height=80 alt="<?php the_title(); ?>"></a>
    	 <h3><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
    	 <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"...",'utf-8'); ?></p>
       </div>
    <ul>
      <?php }else{?>
      <li><span><?php the_time('Y-m-d') ?></span><i>+</i><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
	  <?php }if($i==7){?>
    </ul>
    <div class="kb"><a href="<?php echo $cat_link;?>">更多精彩</a><b></b></div>
   <?php } endwhile; wp_reset_query();?>
   <?php if($key==0)qqoq_ad('ad5')?>
   <?php if($key==2)qqoq_ad('ad6')?>
   <?php if($key==4)qqoq_ad('ad7')?>
  </div>
  <?php if($key==1 && get_option(ad5)!='')echo '<div class="k_ad">'.get_option(ad5).'</div>'?>
  <?php if($key==3 && get_option(ad6)!='')echo '<div class="k_ad">'.get_option(ad6).'</div>'?>
  <?php if($key==5 && get_option(ad7)!='')echo '<div class="k_ad">'.get_option(ad7).'</div>'?>
<?php }?>
</div>