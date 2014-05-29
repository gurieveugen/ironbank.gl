<?php
add_action( 'admin_menu', 'theme_options_page_init' );
function theme_options_page_init() {
	$options_page = add_theme_page(
		'Theme Options',
		'Theme Options',
		8,
		'theme-options',
		'theme_options_page'
	);
	add_action( "load-{$options_page}", 'theme_options_load_page' );
}

function theme_options_load_page() {	
	if ( $_POST["theme-options-form-submit"] == 'save' ) {
		check_admin_referer( "theme-options-page" );
		save_theme_options();
		$redirect_url = isset( $_GET['tab'] ) ? '&updated=true&tab='. $_GET['tab'] : '&updated=true';
		wp_redirect(admin_url('themes.php?page=theme-options'.$redirect_url));
		exit;
	}
}

function save_theme_options() {
	global $pagenow;
	$theme_options = get_option( "ironbark_theme_options" );
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme-options' ){ 
		if ( isset ( $_GET['tab'] ) )
	        $tab = $_GET['tab']; 
	    else
	        $tab = 'general';        
        $except_POST = array("_wpnonce", "_wp_http_referer", "Submit", "theme-options-form-submit"); 

	    switch ( $tab ){ 
			case 'general' :
				foreach($_POST as $post_key => $post_value) {
                    if ( !in_array($post_key, $except_POST) ) {                    
						$theme_options[$post_key] = stripcslashes($post_value);                        
                    }					
				}
			break;	
	    }
	}    
	update_option( "ironbark_theme_options", $theme_options );
}

function theme_options_admin_tabs( $current = 'general' ) {
    $tabs = array( 'general' => 'General'/*, 'pages' => 'Pages', 'footer' => 'Footer'*/ ); 
    //$links = array();
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
		if ( $tab == $current ) {
			echo "<a class='nav-tab$class' href='?page=theme-options'>$name</a>";
		} else {
			echo "<a class='nav-tab$class' href='?page=theme-options&tab=$tab'>$name</a>";
		}
    }
    echo '</h2>';
}

function theme_options_page() {
	global $pagenow;
	$theme_options = get_option( "ironbark_theme_options" );
    $sitepages = get_pages();    
	?>
	
	<div class="wrap">
		<h2>Theme Settings</h2>
		
		<?php
			if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Theme options saved.</p></div>';			
			if ( isset ( $_GET['tab'] ) ) {
				$action_url = admin_url( 'themes.php?page=theme-options&tab='.$_GET['tab'] );
				theme_options_admin_tabs($_GET['tab']);
			} else {
				$action_url = admin_url( 'themes.php?page=theme-options' );
				theme_options_admin_tabs();
			}
		?>

		<div id="poststuff">
			<form method="post" action="<?php echo $action_url; ?>">				
				<?php
				wp_nonce_field( "theme-options-page" );                
				
				if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme-options' ){ 
				
					if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab']; 
					else $tab = 'general'; 
					
					echo '<table class="form-table">';
					switch ( $tab ){						
						case 'general' : 
							?>
                            <tr>
								<th><label for="subscribed_message">Subscribed Message:</label></th>
								<td>
									<input id="subscribed_message" name="subscribed_message" type="text" value="<?php echo htmlspecialchars($theme_options['subscribed_message']); ?>" style="width:400px;" /> 
									<span class="description"></span>
								</td>
							</tr>
                            <tr>
								<th><label for="ironbark_address">Address:</label></th>
								<td>
									<input id="ironbark_address" name="ironbark_address" type="text" value="<?php echo htmlspecialchars($theme_options['ironbark_address']); ?>" style="width:400px;" /> 
									<span class="description"></span>
								</td>
							</tr>                            							
                            <tr>
								<th><label for="ironbark_phone">Phone:</label></th>
								<td>
									<input id="ironbark_phone" name="ironbark_phone" type="text" value="<?php echo htmlspecialchars($theme_options['ironbark_phone']); ?>" style="width:400px;" /> 
									<span class="description"></span>
								</td>
							</tr>
                            <tr>
								<th><label for="ironbark_fax">Fax:</label></th>
								<td>
									<input id="ironbark_fax" name="ironbark_fax" type="text" value="<?php echo htmlspecialchars($theme_options['ironbark_fax']); ?>" style="width:400px;" /> 
									<span class="description"></span>
								</td>
							</tr>                                                                                    
                            <tr>
								<th><label for="ironbark_email">Email:</label></th>
								<td>
									<input id="ironbark_email" name="ironbark_email" type="text" value="<?php echo htmlspecialchars($theme_options['ironbark_email']); ?>" style="width:400px;" /> 
									<span class="description"></span>
								</td>
							</tr>
							</tr>                                                                                    
                            <tr>
								<th><label for="ironbark_bg_image">Background Image:</label></th>
								<td>
									<input id="ironbark_bg_image" name="ironbark_bg_image" type="text" value="<?php echo htmlspecialchars($theme_options['ironbark_bg_image']); ?>" style="width:400px;" /> 
									<span class="description"></span>
								</td>
							</tr>                            
							<?php
						break;                        						
					}
					echo '</table>';
				}
				?>
				<p class="submit" style="clear: both;">
					<input type="submit" name="Submit"  class="button-primary" value="Save" />
					<input type="hidden" name="theme-options-form-submit" value="save" />
				</p>
			</form>			
			
		</div>

	</div>
<?php } ?>