<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
global $ironbark_theme_options;
?>
	<footer id="footer">    
				<div class="left">
					 <?php get_search_form(); ?>
					<!--<p><?php echo $ironbark_theme_options['ironbark_address']; ?></p>
					<div class="row">
						<span><strong>T</strong> <?php echo $ironbark_theme_options['ironbark_phone']; ?></span>
						<span> <strong>F</strong> <?php echo $ironbark_theme_options['ironbark_fax']; ?></span>
					</div>
					<span><strong>E</strong><a href="mailto:<?php echo $ironbark_theme_options['ironbark_email']; ?>">click here</a></span>-->
				</div>
				<div class="footer-area">
	                <?php the_bottom_menu(); ?>				
					<p>Copyright: 2013 Ironbark Zinc Limited</p>
				</div>
			</footer>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>