<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php
/**
 *
 * Template Name: Without Sidebar Page
 */
?>
<?php get_header(); ?>
		<div id="main">






<div id="content" role="main">

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->
		</article>



	<?php endwhile; ?>

</div><!-- #content -->


</div>
<?php get_footer(); ?>
