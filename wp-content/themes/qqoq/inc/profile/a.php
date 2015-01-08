<?php
 if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
 die ('Please do not load this page directly. Thanks!');
?>
<table cellspacing="0" cellpadding="0" border="0">
 <thead>
	<tr>
	    <td width="50">序号</td>
		<td width="200">文章标题</td>
		<td width="200">发布时间</td>
		<td width="120">浏览次数</td>
		<td width="120">所属分类</td>
		<td width="120">评论数量</td>
		<td width="120">发布状态</td>
	</tr>
 </thead>				
 <tbody>
<?php
$i=1;
$userinfo=get_userdata(get_current_user_id());
  switch($userinfo->roles[0]){
    case 'administrator':
    case 'Super Admin':
      $roles='管理员';
      break; 
	case 'subscriber':
      $roles='Q1';
      break;
	case 'editor':
	case 'contributor':
	case 'author':
      $roles='Q2';
      break;
  }
$user_id= $userinfo->id;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => array('post','video'),
    'author' => $user_id,
	'posts_per_page' =>'20',
    'post_status' => array('publish', 'pending'),
	'orderby' => 'date',
    'paged' => $paged
);
query_posts($args);
if(have_posts()) : while (have_posts()) : the_post();
     switch(get_post(get_the_ID())->post_status){
	   case 'publish':
       $status='通过';
       break;
	   case 'pending':
       $status='<span>待审</span>';
       break;
	 }
?>
	<tr>
	    <td><?php echo $i;?></td>
		<td class="tw"><a href="<?php the_permalink() ?>"><?php echo cut_str(get_the_title(),18)?></a></td>
		<td><?php the_time('Y-m-d') ?> <?php the_time('G:H:s') ?></td>
		<td><?php echo getPostViews(get_the_ID());?></td>
		<td><?php echo get_the_term_list(get_the_ID(), array('category','videos'), '', ', ', ''); ?></td>
		<td><?php echo get_post(get_the_ID())->comment_count?></td>
		<td class="ty"><?php echo $status?></td>
	</tr>
<?php $i+=1;endwhile; endif;?>
 </tbody>
</table>
<div class="navi">
<?php par_pagenavi()?>
</div>