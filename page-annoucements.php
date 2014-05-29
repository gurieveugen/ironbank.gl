<?php
/**
 * @package WordPress
 * Template Name: Annoucements Page
*/
?>
<?php get_header(); ?>
<div id="main">
	<div id="content">
        <?php if ( have_posts() ) : the_post(); ?>
        
    		<ul class="breadcrumbs">
    			<!--<li><a href="#">Headline here <span>&gt;</span></a></li>-->
    			<li><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a> <span>&gt;&gt;</span></li>
    			<li><?php the_title(); ?></li>
    		</ul>
            <?php
    		$announcements = $wpdb->get_results(sprintf("SELECT * FROM %sannouncements WHERE announcement_page = %s OR announcement_page = 0 OR announcement_page IS NULL ORDER BY announcement_date_int desc", $wpdb->prefix, $post->ID));
    		if (count($announcements) > 0) {
    			$year = '';
    			$i = 0;
    			$c = 0;
    			foreach ($announcements as $announcement) {
    			$announcement_id = $announcement->announcement_id;
    			$announcement_date = $announcement->announcement_date;
    			$announcement_year = substr($announcement_date, -4);
    			$announcement_title = $announcement->announcement_title;
    			$announcement_pdf = $announcement->announcement_pdf;
    			$pos = strpos($announcement_pdf, 'wp-content');
    			if($pos) $announcement_pdf = substr($announcement_pdf, $pos);
    			$c++;
    		?>
            <div class="download-row <?php if($c % 2 == 1) echo "mark"; ?>">
    			<p><a href="<?php bloginfo('siteurl'); ?>/index.php?download=true&pdf=<?php echo $announcement_pdf; ?>" title="<?php echo $announcement_title; ?>" class="link-download">Download PDF</a> <?php echo $announcement_date; ?> - <?php echo $announcement_title; ?></p>
    		</div>		
    		<?php
    			}
    		}
    		?>		
        <?php endif; ?>
	</div>
    <?php get_sidebar(); ?>
	
</div>
<?php get_footer(); ?>