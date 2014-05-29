<?php
/*
 * @package WordPress
 * Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<div id="main">
	<div id="content">
		<h1>Contact Us</h1>
		<div class="form-contact">
			<?php echo apply_filters('the_content', '[contact-form-7 id="59" title="Contact form"]'); ?>
		</div>
	</div>
	<aside id="sidebar">
        <?php if ( is_active_sidebar( 'contact-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'contact-sidebar' ); ?>
        <?php endif; ?>		
	</aside>
</div>
<?php get_footer(); ?>