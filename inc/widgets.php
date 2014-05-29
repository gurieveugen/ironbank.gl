<?php

register_sidebar(array(
	'id' => 'fp1-sidebar',
	'name' => 'Front Page First Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

register_sidebar(array(
	'id' => 'fp2-sidebar',
	'name' => 'Front Page Second Sidebar',
	'before_widget' => '<div class="column %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

register_sidebar(array(
	'id' => 'fp3-sidebar',
	'name' => 'Front Page Third Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

register_sidebar(array(
	'id' => 'fp4-sidebar',
	'name' => 'Front Page Fourth Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

register_sidebar(array(
	'id' => 'contact-sidebar',
	'name' => 'Contact Sidebar',
	'before_widget' => '<div class="address-box %2$s" id="%1$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'
));

add_action('widgets_init', create_function('', 'return register_widget("Projects_Widget");'));
class Projects_Widget extends WP_Widget {
	function Projects_Widget() {
		$widget_ops = array('classname' => 'projects', 'description' => __('Projects widget'));
		$control_ops = array('width' => 250, 'height' => 400);
		$this->WP_Widget('projects', __('Projects Widget'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
        
		$title = apply_filters('widget_title', $instance['title']);
		$img_src = $instance['img_src'];
        $p_show1 = $instance['p_show1'];
        $p_title1 = $instance['p_title1'];
        $p_text1 = $instance['p_text1'];
        $p_page1 = $instance['p_page1'];
        $p_show2 = $instance['p_show2'];
        $p_title2 = $instance['p_title2'];
        $p_text2 = $instance['p_text2'];
        $p_page2 = $instance['p_page2'];

		echo $before_widget;
        
        if ($title) echo $before_title . $title . $after_title;
        
        if ($img_src) echo "<img src='{$img_src}' alt='projects' />";
        
        echo "<div class='blocks'>";
        if ($p_show1) {
            echo "<div class='block'>";
            echo "<h3>{$p_title1}</h3>";
            echo "<p>{$p_text1}</p>";
            if ($p_page1) echo "<a href='". get_permalink($p_page1) ."' class='btm-more'>MORE</a>";
			echo "</div>";
        }
        if ($p_show2) {
            echo "<div class='block'>";
            echo "<h3>{$p_title2}</h3>";
            echo "<p>{$p_text2}</p>";
            if ($p_page1) echo "<a href='". get_permalink($p_page2) ."' class='btm-more'>MORE</a>";
			echo "</div>";
        }
        echo "</div>"; 
		        
		echo $after_widget;
	}
    
	function update( $new_instance, $old_instance ) {
        $instance['title'] = $new_instance['title'];
        $instance['img_src'] = $new_instance['img_src'];
		$instance['p_show1'] = $new_instance['p_show1'];
        $instance['p_title1'] = $new_instance['p_title1'];
        $instance['p_text1'] = $new_instance['p_text1'];
        $instance['p_page1'] = $new_instance['p_page1'];
        $instance['p_show2'] = $new_instance['p_show2'];
        $instance['p_title2'] = $new_instance['p_title2'];
        $instance['p_text2'] = $new_instance['p_text2'];
        $instance['p_page2'] = $new_instance['p_page2'];
		return $instance;
	}

	function form( $instance ) {
        $defaults = array('p_show1' => 'yes', 'p_show2' => 'yes');
		$instance = wp_parse_args( (array) $instance, $defaults );
        $sitepages = get_pages();
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img_src'); ?>"><?php _e('Image SRC:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_src'); ?>" name="<?php echo $this->get_field_name('img_src'); ?>" type="text" value="<?php echo $instance['img_src']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_show1'); ?>"><?php _e('Show 1st Project:'); ?></label>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_show1'); ?>" name="<?php echo $this->get_field_name('p_show1'); ?>" value="yes" <?php if ($instance['p_show1'] == "yes") echo "checked='checked'"; ?>/>            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_title1'); ?>"><?php _e('1st Project Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('p_title1'); ?>" name="<?php echo $this->get_field_name('p_title1'); ?>" type="text" value="<?php echo $instance['p_title1']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_text1'); ?>"><?php _e('1st Project Text:'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('p_text1'); ?>" name="<?php echo $this->get_field_name('p_text1'); ?>"><?php echo $instance['p_text1']; ?></textarea>            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_page1'); ?>"><?php _e('1st Project Page:'); ?></label>
            <select id="<?php echo $this->get_field_id('p_page1'); ?>" name="<?php echo $this->get_field_name('p_page1'); ?>">
                <option value=""> - Select page - </option>
				<?php
                foreach($sitepages as $sitepage) {
                    $selected = '';
                    if ($sitepage->ID == $instance['p_page1']) $selected = ' SELECTED';
                    ?>
					<option value="<?php echo $sitepage->ID; ?>"<?php echo $selected; ?>><?php if ($sitepage->post_parent) { echo '&nbsp;&nbsp;&nbsp;&nbsp;'; } ?><?php echo $sitepage->post_title; ?></option>
				<?php } ?>
			</select>            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_show2'); ?>"><?php _e('Show 2nd Project:'); ?></label>
            <input type="checkbox" id="<?php echo $this->get_field_id('p_show2'); ?>" name="<?php echo $this->get_field_name('p_show2'); ?>" value="yes" <?php if ($instance['p_show2'] == "yes") echo "checked='checked'"; ?>/>            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_title2'); ?>"><?php _e('2nd Project Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('p_title2'); ?>" name="<?php echo $this->get_field_name('p_title2'); ?>" type="text" value="<?php echo $instance['p_title2']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_text2'); ?>"><?php _e('2nd Project Text:'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('p_text2'); ?>" name="<?php echo $this->get_field_name('p_text2'); ?>"><?php echo $instance['p_text2']; ?></textarea>            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('p_page2'); ?>"><?php _e('2nd Project Page:'); ?></label>
            <select id="<?php echo $this->get_field_id('p_page2'); ?>" name="<?php echo $this->get_field_name('p_page2'); ?>">
                <option value=""> - Select page - </option>
				<?php
                foreach($sitepages as $sitepage) {
                    $selected = '';
                    if ($sitepage->ID == $instance['p_page2']) $selected = ' SELECTED';
                    ?>
					<option value="<?php echo $sitepage->ID; ?>"<?php echo $selected; ?>><?php if ($sitepage->post_parent) { echo '&nbsp;&nbsp;&nbsp;&nbsp;'; } ?><?php echo $sitepage->post_title; ?></option>
				<?php } ?>
			</select>            
        </p>
        
	<?php }
}

add_action('widgets_init', create_function('', 'return register_widget("Announcements_Widget");'));
class Announcements_Widget extends WP_Widget {
    function Announcements_Widget() {
		$widget_ops = array('classname' => 'announcements', 'description' => __('Announcements widget'));
		$control_ops = array('width' => 250, 'height' => 400);
		$this->WP_Widget('announcements', __('Announcements Widget'), $widget_ops, $control_ops);
	}
    
    function widget($args, $instance) {
		global $wpdb;

		extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
        $img_src = $instance['img_src'];
		$number = $instance['number'];		
		$announcement_page = $instance['announcement_page'];		
		//$siteurl = get_option('siteurl');
		$where = '';
		if($announcement_page != 0) $where = ' WHERE announcement_page='.$announcement_page;

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
        
        echo "<div class='widget'>";
        if ($img_src) echo "<img src='{$img_src}' alt='announcements' />";
         
	    $announcements = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."announcements". $where ." ORDER BY announcement_date_int desc LIMIT ".$number);
	    if (count($announcements) > 0) {
            echo "<ul class='list'>";		
                foreach ($announcements as $a) {
                    $a_id = $a->announcement_id;
                    $a_date = $a->announcement_date;
				    list($d, $m, $y) = explode('/', $a_date);
                    $mk = mktime(0, 0, 0, $m, $d, $y);
                    $a_disp = strftime('%d %B %Y',$mk);
                    $a_title = $a->announcement_title;
                    $a_pdf = $a->announcement_pdf;
				    $pos = strpos($a_pdf, 'wp-content');
                    if($pos) $a_pdf = substr($a_pdf, $pos);
                    echo "<li>";
                    echo "<h4>{$a_disp}</h4>";
                    echo "<a href='". get_bloginfo('siteurl') ."/index.php?download=true&amp;pdf={$a_pdf}' title='{$a_title}' >{$a_title}</a>";
                    echo "</li>";                    
                }
            echo "</ul>";
	    }
        echo "</div>";

		echo $after_widget;
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
        $instance['img_src'] = $new_instance['img_src'];
		$instance['number'] = $new_instance['number'];
		$instance['announcement_page'] = $new_instance['announcement_page'];		
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => 'Announcements', 'number' => 4);
		$instance = wp_parse_args( (array) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img_src'); ?>"><?php _e('Image SRC:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_src'); ?>" name="<?php echo $this->get_field_name('img_src'); ?>" type="text" value="<?php echo $instance['img_src']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Announcements Number:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" style="width:25px;"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('announcement_page'); ?>"><?php _e('Announcements Page:'); ?></label> 
            <?php $dropdown_pages = wp_dropdown_pages('echo=0&name=announcement_page&selected='.$instance['announcement_page']);
            if (strlen($dropdown_pages)) {
                $dropdown_pages = str_replace("<select name='announcement_page' id='announcement_page'>", '<select name="'.$this->get_field_name('announcement_page').'" id="'. $this->get_field_id('announcement_page').'"><option value="0"> All </option>', $dropdown_pages);
                echo $dropdown_pages;
            }?>
        </p>
    <?php }
}

add_action('widgets_init', create_function('', 'return register_widget("SubscribeFormWidget");'));
class SubscribeFormWidget extends WP_Widget {
    function SubscribeFormWidget() {
        parent::WP_Widget(false, $name = 'Subscribe Form');
    }

    function widget($args, $instance) {
		global $wpdb;
		$ironbark_theme_options = get_option( "ironbark_theme_options" );

		extract( $args );

		$title = apply_filters('widget_title', $instance['title']);
		$text = $instance['text'];

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		?>
		<div class="subscribe-form-widget">
            <a href="#join" class="box" id="n-join-now">
			<?php echo $text; ?>
			</a>
	<!--		<a class="btn-join" href="#join" id="n-join-now"><span>Join Now</span></a>-->
		</div>
		<div class="form-join" id="subscribe-form" style="display:none;">
			<form name="subscribe_form" id="subscribe_form" method="POST" onsubmit="return false;">
				<input type="hidden" name="na" value="s">
				<input type="hidden" name="nn" id="sf-nn">
				<!--<span class="top">&nbsp;</span>-->
				<div class="container" style="height:645px;">
					<a href="#close" class="btn-close" id="n-close-form">close</a>
					<div class="block" style="padding:0px;">
						<strong class="sub-ttl">E-News Subscription</strong>
					</div>
					<div id="sf-submitted-div" style="display:none;">
						<div class="block">
							<p id="sf-submitted-text"><?php echo $ironbark_theme_options['subscribed_message']; ?></p>
						</div>
					</div>
					<div id="sf-form-div">
						<div class="block">
							<div class="row">
								<input type="text" name="np[First Name]" id="sf-fname" value="First Name *" onfocus="if(this.value=='First Name *'){this.value='';}" onblur="if(this.value==''){this.value='First Name *';}" />
							</div>
							<div class="row">
								<input type="text" name="np[Last Name]" id="sf-lname" value="Last Name *" onfocus="if(this.value=='Last Name *'){this.value='';}" onblur="if(this.value==''){this.value='Last Name *';}" />
							</div>
							<div class="row">
								<input type="text" name="np[Company Name]" id="sf-company" value="Company Name" onfocus="if(this.value=='Company Name'){this.value='';}" onblur="if(this.value==''){this.value='Company Name';}" />
							</div>
							<div class="row">
								<input type="text" name="ne" id="sf-email" value="Email Address *" onfocus="if(this.value=='Email Address *'){this.value='';}" onblur="if(this.value==''){this.value='Email Address *';}" />
							</div>
							<?php /*
							<div class="row">
								<input type="text" name="np[Street Address]" id="sf-address" value="Street Address" onfocus="if(this.value=='Street Address'){this.value='';}" onblur="if(this.value==''){this.value='Street Address';}" />
							</div>
							<div class="row">
								<input type="text" name="np[Suburb]" id="sf-suburb" value="Suburb" onfocus="if(this.value=='Suburb'){this.value='';}" onblur="if(this.value==''){this.value='Suburb';}" />
							</div>
							<div class="row">
								<input type="text" name="np[State]" id="sf-state" value="State" onfocus="if(this.value=='State'){this.value='';}" onblur="if(this.value==''){this.value='State';}" />
							</div>
							<div class="row">
								<input type="text" name="np[Postcode]" id="sf-postcode" value="Postcode" onfocus="if(this.value=='Postcode'){this.value='';}" onblur="if(this.value==''){this.value='Postcode';}" />
							</div>
							*/?>
							<div class="row">
								<input type="text" name="np[Country]" id="sf-country" value="Country" onfocus="if(this.value=='Country'){this.value='';}" onblur="if(this.value==''){this.value='Country';}" />
							</div>
						</div>
						<strong class="sub-ttl">Email Alerts</strong>
						<p>I wish to receive the fallowing company announcements:</p>
						<ul class="check-list" id="sf-email-alerts">
							<?php
							$options_lists = get_option('newsletter_lists');
							for($ea=1; $ea<=9; $ea++) {
							  $ea_name = $options_lists['name_'.$ea];
							  $ea_type = $options_lists['type_'.$ea];
							  if (strlen($ea_name) && $ea_type == 'public') {
							?>
							<li>
								<input class="chk" type="checkbox" name="nl[]" value="<?php echo $ea; ?>" />
								<label><?php echo $ea_name; ?></label>
							</li>
							<?php }} ?>
						</ul>
						<strong class="sub-ttl">Information which can help us serve you better</strong>
						<p>Which of the following groups do you best fit:</p>
						<div class="select-holder">
							<select name="np[Group]" id="sf-group">
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
						<div class="select-holder">
							<select name="np[Hold Shares]" id="sf-shares">
								<option value="No">No</option>
								<option value="Yes">Yes</option>
							</select>
						</div>
						<div class="holder">
							<a href="#send" class="btn-join" id="n-send-form"><span id="sf-send-button">Send</span></a>
						</div>
					</div>
				</div>
				<!--<span class="bottom">&nbsp;</span>-->
			</form>
		</div>
		<?php
		echo $after_widget;
    }

    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
        return $instance;
    }

    function form($instance) {
        $title = $instance['title'];
				$text = $instance['text'];
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
				<p>
					<textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo @$text; ?></textarea>
        </p>
        <?php 
    }

}
?>