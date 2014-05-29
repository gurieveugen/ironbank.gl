<?php
function aa_init() {
	global $wpdb;
/*	$cSQL = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."announcements (
	  announcement_id int(11) NOT NULL AUTO_INCREMENT,
	  announcement_date varchar(50) DEFAULT NULL,
	  announcement_date_int int(11) DEFAULT NULL,
	  announcement_title varchar(200) DEFAULT NULL,
	  announcement_pdf varchar(200) DEFAULT NULL,
	  announcement_color tinyint(4) DEFAULT '0',
	  announcement_page int(11) DEFAULT NULL,
	  PRIMARY KEY (announcement_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1"; */

	$cSQL = "CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."announcements (
	  announcement_id int(11) NOT NULL AUTO_INCREMENT,
	  announcement_date varchar(50) DEFAULT NULL,
	  announcement_date_int int(11) DEFAULT NULL,
	  announcement_title varchar(200) DEFAULT NULL,
	  announcement_pdf varchar(200) DEFAULT NULL,
	  announcement_page int(11) DEFAULT NULL,
	  PRIMARY KEY (announcement_id)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1";
	$wpdb->query($cSQL);
}
add_action('init', 'aa_init');

function aa_add_admin_options_page() {
	add_menu_page('Announcements', 'Announcements', 7, 'announcements', 'aa_display_page_html');
}
add_action('admin_menu', 'aa_add_admin_options_page');

$FormAction = aa_get_param('aa_action');
if (strlen($FormAction)) { aa_action(); }
function aa_action() {
    global $wpdb;
    global $FormAction;

    $announcement_id = aa_get_param('announcement_id');
    $announcement_date = aa_get_param('announcement_date');
    $announcement_title = aa_get_param('announcement_title');
//    $announcement_color = aa_get_param('announcement_color');
    $announcement_page = aa_get_param('announcement_page');

	if (strlen($announcement_date)) {
		$announcement_date_array_space = preg_split("/ /", $announcement_date);
		$announcement_date_array = preg_split("/\//", $announcement_date_array_space[0]);
		$announcement_date_int = mktime(0,0,0,$announcement_date_array[1],$announcement_date_array[0],$announcement_date_array[2]);
	}

	$announcement_action = 'insert';
    if (strlen($announcement_id)) { $announcement_action = 'update'; }
    if ($FormAction == 'delete') { $announcement_action = 'delete'; }

	if (($announcement_action == 'insert' || $announcement_action == 'update') && strlen($_FILES["announcement_pdf"]["name"])) {
		require_once('./includes/post.php');
		require_once('./includes/image.php');
		require_once('./includes/file.php');
		require_once('./includes/media.php');
		$overrides = array('test_form' => false);
		$time = current_time('mysql');
	    $pdf = wp_handle_upload($_FILES["announcement_pdf"], $overrides, $time);
	    $announcement_pdf = $pdf['url'];
	}
	if ($announcement_action == 'insert') {
		$insert = array();
		$insert["announcement_date"] = $announcement_date;
		$insert["announcement_date_int"] = $announcement_date_int;
		$insert["announcement_title"] = $announcement_title;
		$insert["announcement_pdf"] = $announcement_pdf;
//		$insert["announcement_color"] = $announcement_color;
		$insert["announcement_page"] = $announcement_page;
		$wpdb->insert($wpdb->prefix."announcements", $insert);
		$announcement_id = $wpdb->insert_id;
	} else if ($announcement_action == 'update') {
		$update = array();
		$update["announcement_date"] = $announcement_date;
		$update["announcement_date_int"] = $announcement_date_int;
		$update["announcement_title"] = $announcement_title;
//		$update["announcement_color"] = $announcement_color;
		$update["announcement_page"] = $announcement_page;
		if (strlen($announcement_pdf)) {
			$update["announcement_pdf"] = $announcement_pdf;
		}
		$wpdb->update($wpdb->prefix."announcements", $update, array('announcement_id' => $announcement_id));
	} else {
		$wpdb->query(sprintf("DELETE FROM %sannouncements WHERE announcement_id = '%s'", $wpdb->prefix, $announcement_id));
	}
	$redirect = 'admin.php?page=announcements';
	if ($_POST['asend'] == 'true') {
		$redirect = 'admin.php?page=newsletter-pro/newsletter.php&announcement_id='.$announcement_id;
	}
	wp_redirect($redirect);
	exit;
}

function aa_display_page_html() {
    global $wpdb;
    $form_title = 'Add New Announcement';
    $form_button = 'Submit';
//    $fldannouncement_color = 0;
    $fldannouncement_id = aa_get_param('announcement_id');
	if (strlen($fldannouncement_id)) {
		$a_data = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."announcements where announcement_id = '".$fldannouncement_id."'");
		if ($a_data) {
			$fldannouncement_date = $a_data->announcement_date;
			$fldannouncement_title = $a_data->announcement_title;
			$fldannouncement_pdf = $a_data->announcement_pdf;
//			$fldannouncement_color = $a_data->announcement_color;
			$fldannouncement_page = $a_data->announcement_page;

			if (strlen($fldannouncement_pdf)) { $fldannouncement_pdf_value = '<a href="'.$fldannouncement_pdf.'" target="_blank">'.basename($fldannouncement_pdf).'</a>'; }

			$form_title = 'Edit Announcement';
			$form_button = 'Update';
		}
	}
?>
<style>
div.announcements-form {
	padding:0 0 20px 0px;
}
div.announcements-form-submit {
	clear:both;
	width:490px;
}
div.a-form-fname {
	float:left;
	width:90px;
}
table.announcements-list
{
  border-top:1px #999999 solid;
  border-left:1px #999999 solid;
  margin:0px;
  padding:0px;
}

table.announcements-list td
{
  border-bottom:1px #999999 solid;
  border-right:1px #999999 solid;
  padding:5px 5px 5px 5px;
  vertical-align:top;
  margin:0px;
}

</style>
<div class="wrap">
	<h2 style="padding-bottom: 0px"><?php _e('Announcements') ?></h2>
	<h3 style="padding-bottom: 0px"><?php _e($form_title) ?></h3>
	<div class="announcements-form">
		<form method="post" name="announcement_form" action="" enctype="multipart/form-data">
		<input type="hidden" name="asend" value="">
		<input type="hidden" name="aa_action" value="submit">
		<input type="hidden" name="announcement_id" value="<?php echo @$fldannouncement_id; ?>">
		<div class="a-form-fname"><?php _e('Date:') ?></div><input type="text" name="announcement_date" value="<?php echo @$fldannouncement_date; ?>" style="width:200px;">&nbsp;dd/mm/yyyy
		<div style="clear:both; height:5px;"></div>
		<div class="a-form-fname"><?php _e('Title:') ?></div><input type="text" name="announcement_title" value="<?php echo @$fldannouncement_title; ?>" style="width:400px;">
		<div style="clear:both; height:5px;"></div>
		<div class="a-form-fname"><?php _e('Upload PDF:') ?></div><input type="file" name="announcement_pdf">&nbsp;<?php echo @$fldannouncement_pdf_value; ?>
		<div style="clear:both; height:5px;"></div>
		<div class="a-form-fname"><?php _e('Page:') ?></div>
		<?php @$dropdown_pages = wp_dropdown_pages('echo=0&name=announcement_page&selected='.$fldannouncement_page);
		if(strlen($dropdown_pages)) {
			$dropdown_pages = str_replace("<select name='announcement_page' id='announcement_page'>", '<select name="announcement_page" id="announcement_page"><option value="">- Select page -</option>', $dropdown_pages);
			echo $dropdown_pages;
		}?>
		<p class="submit" style="padding:0px; margin:7px 0 0 90px;"><input type="submit" value="<?php _e($form_button) ?>" />&nbsp;&nbsp;<input type="submit" value="<?php _e($form_button) ?> and Send" onclick="document.announcement_form.asend.value='true';" /></p>
		</form>
	</div>
	<h3 style="padding:0px; margin:0 0 10px 0;"><?php _e('Edit Current Announcements') ?></h3>
	<table cellpadding="0" cellspacing="0" class="announcements-list">
	  <tr>
		<td><strong>Date</strong></td>
		<td><strong>Title</strong></td>
		<td><strong>PDF</strong></td>
		<td><strong>Page</strong></td>
		<td><strong>Edit</strong></td>
		<td><strong>Delete</strong></td>
	  </tr>
	  <?php
	  $announcements = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."announcements ORDER BY announcement_date_int desc");
	  if (count($announcements) > 0) {
	    foreach ($announcements as $announcement) {
		  $announcement_id = $announcement->announcement_id;
		  $announcement_date = $announcement->announcement_date;
		  $announcement_title = $announcement->announcement_title;
		  $announcement_pdf = $announcement->announcement_pdf;
//		  $announcement_color = $announcement->announcement_color;
		  $announcement_page = $announcement->announcement_page;
	  ?>
	  <tr>
		<td><?php echo $announcement_date; ?></td>
		<td><?php echo $announcement_title; ?></td>
		<td><?php echo basename($announcement_pdf); ?></td>
		<?php $pp = get_post($announcement_page);
		if($pp) $pp_title = get_the_title($pp->post_parent); ?>
		<td><?php if($pp_title) echo $pp_title.' &gt;&gt; '; echo get_the_title($announcement_page); ?></td>
		<td><a href="admin.php?page=announcements&announcement_id=<?php echo $announcement_id; ?>">Edit</a></td>
		<td><a href="admin.php?page=announcements&aa_action=delete&announcement_id=<?php echo $announcement_id; ?>" onclick="return confirm('Are you sure delete this announcement?');">Delete</a></td>
	  </tr>
	  <?php
		}
	  }
	  ?>
	</table>
</div>
<?php
}

function aa_get_param($param_name) {
  @$param_value = $_POST[$param_name];
  if (isset($_GET[$param_name])) {
    $param_value = $_GET[$param_name];
  }
  return $param_value;
}

function aa_get_color($tp) {
  $color = '#E75E10';
  if ($tp == 1) {
    $color = '#777777';
  }
  return $color;
}
?>