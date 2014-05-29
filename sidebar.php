<?php
/**
 * @package WordPress
 * @subpackage Base_theme
 */
?>
<aside id="sidebar">
    <?php
	global $post;
	$pid = $post->ID;
	$show = false;
	if( is_page() && !is_page_template('page-without-left-menu.php') ) {
		$show = true;
	}
	if ( is_category( 'news' ) ) {
		$show = true;
	}
	if ($show) {
		$menu = get_primary_menu();
		$pos = stripos($menu, ' active ');
		$menu = substr($menu, $pos);
		$ul_pos = stripos($menu, '<ul');
		$menu = substr($menu, $ul_pos);

		$i = 2;
		do {
			$begin_ul_pos = stripos($menu, '<ul', $i);
			$end_ul_pos = stripos($menu, '</ul', $i);
			$i = $end_ul_pos + 5;
		} while ($begin_ul_pos && $begin_ul_pos < $end_ul_pos);
		
		$menu = substr($menu, 0, $end_ul_pos);
		$menu = preg_replace('/sub-menu/', 'left-nav arrow', $menu, 1);
        $menu = str_replace('sub-menu', 'sub-nav', $menu);
        $menu .= '</ul>';
		echo $menu;
	}
    if( is_single() ) {
		$project_cat = get_category_by_slug( 'corazon-projects' );
		$project_catid = $project_cat->term_id;
		if(in_category($project_catid, $pid)) {
			$cid = $project_catid;
		} else {
			$news_cat = get_category_by_slug( 'news' );
			$cid = $news_cat->term_id;			
		}
		$cposts = get_posts('category='.$cid);
		if(count($cposts) > 0) {
			echo '<ul class="left-nav arrow">';
			foreach($cposts as $cpost) {
				$cpost_id = $cpost->ID;
				$cpost_title = $cpost->post_title;
				$cpost_link = get_permalink($cpost_id);
				?>
				<li <?php if($pid == $cpost_id) echo 'class="active"'; ?> ><a href="<?php echo $cpost_link; ?>"><?php echo $cpost_title; ?></a></li>
				<?php
			}
			echo '</ul>';
		}
	}
    ?>
</aside>