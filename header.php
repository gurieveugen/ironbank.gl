<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link media="all" rel="stylesheet" type="text/css" href="<?php echo TDU ?>/css/jqtransform.css">
    <link type="text/css" href="<?php echo TDU ?>/css/jquery-ui-1.10.3.custom.css" rel="stylesheet" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
	   
	
	<script type="text/javascript" src="<?php echo TDU ?>/js/jquery.cycle.all.js"></script>
	<script type="text/javascript" src="<?php echo TDU ?>/js/jquery.form.js"></script>	
	<script type="text/javascript" src="<?php echo TDU ?>/js/launcher.js"></script>
	<script type="text/javascript" src="<?php echo TDU ?>/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo TDU ?>/js/jquery.jqtransform.js"></script>
	<script type="text/javascript" src="<?php echo TDU ?>/js/jquery.main.js"></script>
	<!--[if lt IE 9]>
		<script src="<?php echo TDU ?>/js/html5.js"></script>
		<script src="<?php echo TDU ?>/js/pie.js"></script>
		<script src="<?php echo TDU ?>/js/init-pie.js"></script>
		<script src="<?php echo TDU ?>/js/cufon-yui.js"></script>
		<script src="<?php echo TDU ?>/js/cufon-fonts.js"></script>
		<script src="<?php echo TDU ?>/js/cufon-init.js"></script>
	<![endif]-->
</head>
<?php global $ironbark_theme_options; ?>
<?php
$bg_image = '';
if ($ironbark_theme_options['ironbark_bg_image']) :
	$bg_image = "style='background:url(".$ironbark_theme_options['ironbark_bg_image'].") no-repeat;'";
endif;
?>
<body <?php body_class(); ?> <?php echo $bg_image; ?>>
	<div id="wrapper">
		<!--[if IE 8]>
		<img class="background-image" src="<?php echo TDU; ?>/images/bg-body.jpg" width="100%" height="100%" alt="image description" />
		<![endif]-->
		<div class="center-wrap">
			<div id="header">
				<?php echo get_primary_menu(); ?>
				<div class="header-row">
					<?php if(is_front_page()): ?>
						<h1 class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php else: ?>
						<strong class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></strong>
					<?php endif; ?>
					<div class="header-area">
						<a href="http://www.asx.com.au/asx/research/companyInfo.do?by=asxCode&allinfo=&asxCode=IBG" target="_blank"><img src="<?php echo TDU ?>/images/img-1.jpg" alt="image description"></a>
                        <div class="text-holder">
        					<?php if(method_exists('WPStockTicker', 's_ticker_display')) {
        						$xx = new WPStockTicker();
        						echo $xx->s_ticker_display();
        					} ?>
        				</div>						
					</div>
				</div>
			</div>