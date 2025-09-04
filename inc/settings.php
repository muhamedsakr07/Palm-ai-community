<?php
if ( ! defined( 'ABSPATH' ) ) exit;


function palmAIcontentFunction()
{
	add_menu_page('Palm AI Summary Settings', 'Palm AI Summary Settings', 'edit_posts', 'theme-options', 'palmAIcontentFunction_fnc');
}

add_action('admin_menu', 'palmAIcontentFunction');

function palmAIcontentFunction_fnc()
{
	@$content_length = get_option('content_length');
	@$use_ajax_summary = get_option('use_ajax_summary');


	?>
	<div class="wrap">
		<form method="POST" action="<?php echo admin_url('admin.php'); ?>">

				<h3><?php _e('Content Length'); ?></h3>
				<p>add your content summary length here</p>
				<div class="form-input" style="margin-bottom: 30px;">
					<input type="number" name="content_length" value="<?php echo $content_length; ?>" style="width:100%" />
				</div>

				<h3><?php _e('Generate Summary with ajax '); ?></h3>
				<p>if you need generate with ajax make it checked</p>
				<div class="form-input" style="margin-bottom: 30px;">
					<input type="checkbox" name="use_ajax_summary" value="1" <?php echo checked(1, $use_ajax_summary, false); ?> />
				</div>

				<hr>
				<input type="hidden" name="action" value="changeThemeOptions" />
				<input type="submit" value="Submit" style="margin-top:20px;padding: 5px 20px;" />

		</form>
	</div>
	
	<?php
}

add_action('admin_action_changeThemeOptions', 'changeThemeOptions_admin_action');

function changeThemeOptions_admin_action()
{
	// here i make the default is 30 
	$content_length = isset($_POST['content_length']) ? sanitize_text_field($_POST['content_length']) : '30';
	$use_ajax_summary = isset($_POST['use_ajax_summary']) ? sanitize_text_field($_POST['use_ajax_summary']) : '0';

	// Save Content lengt option
	if ($content_length != '') {
		update_option('content_length', $content_length);
	}

	if ($use_ajax_summary != '') {
		update_option('use_ajax_summary', $use_ajax_summary);
	}

	wp_redirect($_SERVER['HTTP_REFERER']);
	exit();
}


