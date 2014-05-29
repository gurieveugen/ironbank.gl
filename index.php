<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>
<div id="main">
	<div id="content" class="wide" role="main">
		<h1>Latest News and Research</h1>
		<?php include("loop.php"); ?>
	</div>
</div>
<?php get_footer(); ?>
