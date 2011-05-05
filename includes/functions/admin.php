<?php
// Set up the admin page &  register settings
function lblg_add_admin() {
    $lblg_meta = get_option( 'lblg_meta_info ');
	$themename = $lblg_meta['themename'];
    add_theme_page( $themename." Settings", "$themename Settings", 'edit_theme_options', basename(__FILE__), 'lblg_admin' );
}

// Display the theme options page
function lblg_admin() {
	global $lblg_shortname, $lblg_themename, $lblg_version, $lblg_options, $lblg_admin_options;

	$themename = $lblg_themename;
	$shortname = $lblg_shortname;
	$options = $lblg_admin_options;

	if ( isset( $_GET['settings-updated'] ) ) {
	    echo "<div class='updated'><p>Theme settings updated successfully.</p></div>";
	}
    if ( isset( $_GET['save'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( isset( $_GET['reset'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2 class="updatehook"><?php echo $themename; ?> settings</h2>

<form method="post" action="options.php">

<table class="form-table">
<tbody>

<?php lblg_print_options( $options ); ?>

</tbody>
</table>

<?php settings_fields( $shortname . '_theme_options' ); ?>

<p class="submit">
<input name="save" type="submit" class="button-primary" value="Save changes" />    
</p>
</form>

<?php
}

// 
function lblg_option_wrapper_header( $values ){
	?>
	<tr valign="top"> 
	    <th scope="row"><?php echo $values['name']; ?>:</th>
	    <td>
	<?php
}

// 
function lblg_option_wrapper_footer( $values ){
	?>
		<br /><br />
		<?php echo $values['desc']; ?>
	    </td>
	</tr>
	<?php 
}

/*
 * lblg_print_options() is responsible for printing all the theme options in the theme's
 * options screen.
 */
function lblg_print_options( $options = array() ){
	foreach ( $options as $key => $value ) { 	
		switch ( $value['type'] ) {
			
			// Prints a subheader (useful for dividing options up into similar sections)
			case 'subhead':
			?>
				</table>
				
				<h3><?php echo $value['name']; ?></h3>
				
				<table class="form-table">
			<?php
			break;
			
			// Prints a simple text <input> element
			case 'text':
			lblg_option_wrapper_header( $value );
			?>
			        <input name="<?php echo $key; ?>" id="<?php echo $key; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $key ) != "") { echo get_option( $key ); } else { echo $value['std']; } ?>" />
			<?php
			lblg_option_wrapper_footer( $value );
			break;
			
			// Prints a drop-down <select> element
			case 'select':
			lblg_option_wrapper_header( $value );
			?>
		            <select name="<?php echo $key; ?>" id="<?php echo $key; ?>">
		                <?php foreach ( $value['options'] as $option) { ?>
		                <option<?php if ( get_option( $key ) == $option ) { echo ' selected="selected"'; } elseif ( $option == $value['std'] ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
		                <?php } ?>
		            </select>
			<?php
			lblg_option_wrapper_footer( $value );
			break;
			
			// Prints a <textarea> element
			case 'textarea':
			$ta_options = $value['options'];
			lblg_option_wrapper_header( $value );
			?>
					<textarea name="<?php echo $key; ?>" id="<?php echo $key; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="<?php echo $ta_options['rows']; ?>"><?php 
					if( get_option( $key ) != "") {
							echo get_option( $key );
						}else{
							echo $value['std'];
					}?></textarea>
			<?php
			lblg_option_wrapper_footer( $value );
			break;
	
			// Prints a series of radio <input> elements
			case "radio":
			lblg_option_wrapper_header( $value );
			
	 		foreach ( $value['options'] as $key=>$option ) { 
					$radio_setting = get_option( $key );
					if( $radio_setting != '' ){
			    		if ( $key == get_option( $key ) ) {
							$checked = "checked=\"checked\"";
							} else {
								$checked = "";
							}
					}else{
						if( $key == $value['std'] ){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
					}?>
		            <input type="radio" name="<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
			<?php 
			}
			 
			lblg_option_wrapper_footer( $value );
			break;
			
			// Prints a checbox <input> element
			case "checkbox":
			lblg_option_wrapper_header( $value );
							if(get_option( $key ) ){
								$checked = "checked=\"checked\"";
							}else{
								$checked = "";
							}
						?>
			            <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="true" <?php echo $checked; ?> />
			<?php
			lblg_option_wrapper_footer( $value );
			break;
	
			default:
	
			break;
		}
	}

}