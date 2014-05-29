<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>

<div class="home-columns">
    <?php if ( is_active_sidebar( 'fp1-sidebar' ) ) : ?>
        <div class="column">        
            <?php dynamic_sidebar( 'fp1-sidebar' ); ?>        		
        </div>
    <?php endif; ?>
    
    <?php if ( is_active_sidebar( 'fp2-sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'fp2-sidebar' ); ?>
    <?php endif; ?>
    
    <?php if ( is_active_sidebar( 'fp3-sidebar' ) ) : ?>
        <div class="column">        
        <?php dynamic_sidebar( 'fp3-sidebar' ); ?>
        </div>
    <?php endif; ?>  
	
    <?php if ( is_active_sidebar( 'fp4-sidebar' ) ) : ?>
        <div class="column last">
            <?php dynamic_sidebar( 'fp4-sidebar' ); ?>
        </div>
    <?php endif; ?>    
	<!--<div class="column last">
		<h2>COMPANY UPDATES</h2>
		<div class="subscribe-box">
			<a href="#" class="box" id="subscribe-link">
				<img src="<?php echo TDU ?>/images/arrow-downwards.png" alt="image description">
				<span><strong>SUBSCRIBE TO</strong> <br>IRONBARK ZINC <small>LIMITED</small></span>
				<p>For the latest news, announcements &amp; company information</p>
			</a>
			<form action="#" class="form-subscribe">
				<h2>E-News Subscription</h2>
				<input type="text" placeholder="First Name *">
				<input type="text" placeholder="Last Name *">
				<input type="text" placeholder="Company Name">
				<input type="text" placeholder="Email Address *">
				<input type="text" placeholder="Country">
				<h2>Email Alerts</h2>
				<p>I wish to receive the fallowing company announcements:</p>
				<ul class="check-list">
					<li>
						<input type="checkbox">
						<label>All</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Annoucements</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Quarterly Reports</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Media Releases</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Research Reports</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Recent News</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Annual Reports</label>
					</li>
					<li>
						<input type="checkbox">
						<label>Company Policies</label>
					</li>
				</ul>
				<h2>Information which can help us serve you better</h2>
				<p>Which of the following groups do you best fit:</p>
				<div class="select wide">
					<select>
						<option value="Private Investor">Private Investor</option>
						<option value="Sophisticated Investor">Sophisticated Investor</option>
						<option value="Institutional Investor">Institutional Investor</option>
						<option value="Fund Manager">Fund Manager</option>
						<option value="Financial Adviser">Financial Adviser</option>
						<option value="Analyst">Analyst</option>
						<option value="Broker">Broker</option>
						<option value="Media Representative">Media Representative</option>
					</select>
				</div>
				<p>Do you currently hold shares in this company?</p>
				<div class="select">
					<select>
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				</div>
				<input type="submit" value="Send">
				<button id="close-form" class="btn-close">close</button>
			</form>
			
		</div>		
	</div>-->
</div>
<div class="news-block">
	<div class="left">
		<h2>IRONBARK MEDIA</h2>
		<ul class="switcher"></ul>
	</div>
    <?php
    $post_cat = get_category_by_slug( 'news' );
    $post_catid = $post_cat->term_id;
    $latest_posts = new WP_Query('posts_per_page=5&cat='.$post_catid);
    if ($latest_posts->have_posts()) : ?>
        <ul class="slider">
            <?php while($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>	
</div>
<?php get_footer(); ?>