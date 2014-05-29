<?php
/**
 *
 * Template Name: Parent Announcements
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
                        <?php
        				$subpages = get_pages('child_of='.$post->ID.'&sort_order=desc');
        				$c = 0;
        				$mark='';
        				if(count($subpages) > 0) {
        					foreach($subpages as $subpage) {
        						$subpage_id = $subpage->ID;
        						$subpage_title = $subpage->post_title;
        						$page_title = get_the_title($subpage->post_parent).' ';
        						$subpage_link = get_permalink($subpage_id);
        						$c++;
        						if($c % 2 == 1) $mark = "mark";
        						echo '<p class="row '.  $mark . '" ><a href="'. $subpage_link .'"  title="'. $subpage_title .'">'. $page_title . $subpage_title .'</a></p>';
        						$mark='';
        					}
        				}
        				?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->
		</article>



	<?php endwhile; ?>

</div><!-- #content -->


	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
