<?php
/*
Template Name: Page (Full Width)
*/
?>
<?php get_header(); ?>

<!-- #primary -->
<div id="primary" class="fullwidth container clearfix">
<!-- #content -->
  <section id="content" role="main">
  
  <!-- #page-header -->
<header id="page-header" class="clearfix">
  <h1 class="page-title"><?php the_title(); ?></h1>
  <?php st_breadcrumb(); ?>
</header>
<!-- /#page-header --> 
  
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
      <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); ?>
      </div>

    </article>
    
    <?php // If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
			comments_template( '', true ); ?>
    <?php endwhile; // end of the loop. ?>
    
  </section>
  <!-- #content -->
  
</div>
<!-- #primary -->

<?php get_footer(); ?>