<?php
$basic_themename = 'GigaDB';
$basic_shortname = 'giga';

$data_set = array('show', 'hide');
$data_set_tmp = array_unshift($data_set, 'Show or Hide');

$basic_options = array (
	array('name' => 'Social Network Setting','type' => 'heading','desc' => 'Set you Facebook and Twitter ID in the following blanks.'),
	array('name' => 'Facebook ID','id' => $basic_shortname.'_facebook_id','std' => 'wange1228', 'type' => 'text'),
	array('name' => 'Twitter ID','id' => $basic_shortname.'_twitter_id','std' => 'wange1228','type' => 'text'),
	array('name' => 'Weibo ID','id' => $basic_shortname.'_weibo_id','std' => 'wange1228','type' => 'text'),
	array('name' => 'Giga Blog','id' => $basic_shortname.'_rss_id','std' => 'http://blogs.openaccesscentral.com/blogs/gigablog/','type' => 'text'),
	
	array('name' => 'Browse by Dataset','type' => 'heading','desc' => 'Show "Browse by Dataset" or not'),
	array('name' => 'Browse by Dataset','id' => $basic_shortname.'_data','std' => 'show','type' => 'select','options' => $data_set)
);

function mytheme_add_admin() {
	global $basic_themename, $basic_shortname, $basic_options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($basic_options as $basic_value) {
			update_option( $basic_value['id'], $_REQUEST[ $basic_value['id'] ] ); }
			foreach ($basic_options as $basic_value) {
			if( isset( $_REQUEST[ $basic_value['id'] ] ) ) { update_option( $basic_value['id'], $_REQUEST[ $basic_value['id'] ]  ); } else { delete_option( $basic_value['id'] ); } }
			header("Location: themes.php?page=basic_ctrl.php&saved=true");
			die;
		} else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($basic_options as $basic_value) {
				delete_option( $basic_value['id'] ); 
				update_option( $basic_value['id'], $basic_value['std'] );
			}
			header("Location: themes.php?page=basic_ctrl.php&reset=true");
			die;
		}
	}
	add_theme_page($basic_themename.' '.__( 'Basic Settings', 'GigaDB' ), $basic_themename.' '.__( 'Basic Settings', 'GigaDB' ), 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
	global $basic_themename, $basic_shortname, $basic_options;
	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$basic_themename.' '.__( 'Settings Saved', 'GigaDB' ).'</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$basic_themename.' '.__( 'Settings Reset', 'GigaDB' ).'</strong></p></div>';
?>
	<style type="text/css">
		th{text-align:left;}
		input,textarea{width:100%;}
		select{border-color:#8c8c8c;}
		.submit{width:100px;padding:0;float:left;}
		.defaultbutton{padding-left:145px;}
	</style>
	<div class="wrap">
		<h2><b><?php echo $basic_themename.' '.__( 'Basic Settings', 'GigaDB' ); ?></b></h2>
		<form method="post">
			<table class="optiontable" >
				<?php foreach ($basic_options as $basic_value) { 
					if ($basic_value['type'] == "text") { ?>
						<tr> 
							<th><?php echo $basic_value['name']; ?>:</th>
							<td>
								<input name="<?php echo $basic_value['id']; ?>" id="<?php echo $basic_value['id']; ?>" type="<?php echo $basic_value['type']; ?>" value="<?php if ( get_settings( $basic_value['id'] ) != "") { echo get_settings( $basic_value['id'] ); } else { echo $basic_value['std']; } ?>" size="40" />
							</td>
						</tr>
					<?php } elseif ($basic_value['type'] == "textarea") { ?>
						<tr>
							<th><?php echo $basic_value['name']; ?>:</th>
							<td>
								<textarea name="<?php echo $basic_value['id']; ?>" id="<?php echo $basic_value['id']; ?>" cols="40" rows="5"/><?php if ( get_settings( $basic_value['id'] ) != "") { echo stripslashes(get_settings( $basic_value['id'] )); } else { echo stripslashes($basic_value['std']); } ?></textarea>
							</td>
						</tr>
					<?php } elseif ($basic_value['type'] == "select") { ?>
						<tr> 
							<th><?php echo $basic_value['name']; ?>:</th>
							<td>
								<select style="font-size:12px" name="<?php echo $basic_value['id']; ?>" id="<?php echo $basic_value['id']; ?>">
								<?php foreach ($basic_value['options'] as $option) { ?>
								<option<?php if ( get_settings( $basic_value['id'] ) == $option) { echo ' selected="selected"'; }?>><?php echo $option; ?></option>
								<?php } ?>
								</select>
							</td>	
						</tr>
					<?php } elseif ($basic_value['type'] == "checkbox") { ?>
						<tr> 
							<th><?php echo $basic_value['name']; ?>:</th>
							<td>
								<input style="width: auto;" name="<?php echo $basic_value['id']; ?>" type="checkbox" value="checkbox"<?php if(get_settings($basic_value['id']) ) { echo ' checked="checked"'; }?>/>
							</td>
						</tr>
					<?php } elseif ($basic_value['type'] == "heading") { ?>
						<tr> 
							<td colspan="2" style="text-align: left;"><hr />
							<h2 style="color:green;"><?php echo $basic_value['name']; ?></h2></td>
							<tr><td colspan=2> <p style="color:red; margin:0 0;" > <?php echo $basic_value['desc']; ?> </P> <hr /></td></tr>
						</tr>
					<?php } ?>
					<?php 
				}
				?>
			</table>
			<hr />
			<div class="submit">
				<input class="button-primary" name="save" type="submit" value="<?php _e( 'Save', 'GigaDB' );?>" />    
				<input type="hidden" name="action" value="save" />
			</div>
		</form>
		<form method="post" class="defaultbutton">
			<div class="submit">
				<input class="button-secondary" name="reset" type="submit" value="<?php _e( 'Reset', 'GigaDB' );?>" />
				<input type="hidden" name="action" value="reset" />
			</div>
		</form>
	</div>
	<?php
}
add_action('admin_menu', 'mytheme_add_admin'); ?>