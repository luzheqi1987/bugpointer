
<div class="widget widget_categories_article">		<h3>相关文章</h3>		

<?php
global $post;
$categories = get_the_category(); //函数获取分类ID好
foreach ($categories as $category){
?>
<ul>
<?php
$posts = get_posts('numberposts=10&orderby=rand&category='. $category->term_id);
//通过get_posts函数，根据分类ID来获取这个ID下的文章内容。

foreach($posts as $post){
?>
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo excerpttitle(16);?></a></li>  
<?php } ?>
</ul>
<?php } ?> 
		</div>
