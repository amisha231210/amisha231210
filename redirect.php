<?php
ob_start();
/*
	 * Plugin Name: MSK Redirect-Page
	 * Description: Custom plugin to redirect the page .
	 * Plugin URI:https://www.wordpress.org/msk-redirect
	 * Description: Manage all your 301 redirects and monitor 404 errors
	 * Version: 5.3.10
	 * Requires PHP: 7.4.14
	 * Author: MisterSk Infotech
	 * Author URI: https://www.misterskinfotech.com/
	 * License: GPL v2 or later
     * License URI: https://www.gnu.org/licenses/gpl-2.0.html
	 * Text Domain: msk-redirect
	 * Domain Path: /languages
	 */
if (!defined('ABSPATH')) exit;

register_activation_hook(__FILE__, "redirect");

function redirect()
{
	custom_redirect();
}

function custom_redirect()
{

	// WP Globals
	global $table_prefix, $wpdb;

	// Customer Table
	$customerTable = $table_prefix . 'redirect_page';

	// Create Customer Table if not exist
	if ($wpdb->get_var("show tables like '$customerTable'") != $customerTable) {

		// Query - Create Table
		$sql = "CREATE TABLE `$customerTable` (";
		$sql .= " `id` int(11) NOT NULL auto_increment, ";
		$sql .= " `title` varchar(255) NOT NULL, ";
		$sql .= " `url` varchar(255) NOT NULL, ";
		$sql .= " `action_code` varchar(255) NOT NULL, ";
		$sql .= " `action_type` varchar(255) NOT NULL, ";
		$sql .= " `status` BOOLEAN NOT NULL, ";
		$sql .= " `action_url` varchar(255), ";
		$sql .= " `last_access` datetime NOT NULL, ";
		$sql .= " PRIMARY KEY `customer_id` (`id`) ";
		$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

		// Include Upgrade Script
		require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

		// Create Table
		dbDelta($sql);
	}
}

//create the page in the admin dashbord 


function my_custom_plugin_menu()
{
	add_menu_page(
		'Redirect', //page-title
		'Redirect', // menu title
		'manage_options', // capability
		'Redirect',  // menu slug
		'my_custom_redirectPage', // callback_function
		'dashicons-admin-generic',
		99
	);
}
add_action('admin_menu', 'my_custom_plugin_menu');

function my_custom_redirectPage()
{
?>
	<div class="wrap">
		
		<?php include(plugin_dir_path(__FILE__) . 'includes/page.php');
		?>
	</div>
<?php
}

// delete table while deactivate the plugin
function on_deactivation()
{

	global $wpdb;
	$table_name = $wpdb->prefix . 'redirect_page';
	$sql   = "DROP TABLE IF EXISTS $table_name";
	$wpdb->query($sql);
	delete_option('wp_install_uninstall_config');
}

register_deactivation_hook(__FILE__, 'on_deactivation');

// Hook into template redirect
add_action( 'template_redirect', 'my_redirect_plugin_redirect' );

// Redirect callback function
	function my_redirect_plugin_redirect() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'redirect_page';

	$current_url =  home_url( $_SERVER['REQUEST_URI'] );

	echo "<br>";

	$sql = "SELECT * FROM $table_name ";
	$results = $wpdb->get_results($sql);
		foreach ($results as $redirect) {
			$varu = home_url();
			$original_url = $redirect->url;
			$destination_url = $redirect->action_url;
			$action_code = $redirect->action_code;
			if (($current_url ==  $original_url )) {
				$new_url = $destination_url;
				wp_redirect($new_url, $action_code);

				// Redirect to the new URL
				
				
				exit();
			} 
		}
	}

?>