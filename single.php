<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>
<div id="main">
	<div id="content" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><?php the_title(); ?></h1>
	
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div>
		</div>
		<div id="nav-below" class="navigation nav-single">
			<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&lt;&lt;</span> Previous Entry', 'theme' ) ); ?></span>
			<span class="nav-next"><?php next_post_link( '%link', __( 'Next Entry<span class="meta-nav">&gt;&gt;</span>', 'theme' ) ); ?></span>
		</div>
		
	
	<?php endwhile; ?>
	</div>
    <?php get_sidebar(); ?>
	
	
</div>
<?php get_footer(); ?>
