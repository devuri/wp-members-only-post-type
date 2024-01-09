<?php
/**
 * Members Only Post Type
 *
 * @package    MembersOnlyPostType
 * @author     Uriel Wilson
 * @copyright  2020 Uriel Wilson
 * @license    GPL-2.0
 * @link       https://urielwilson.com
 *
 * @wordpress-plugin
 * Plugin Name:       Members Only Post Type
 * Plugin URI:        https://wpbrisko.com/wordpress-plugins/
 * Description:       Members Only Post Type will Protected and Restrict access to custom Post Types
 * Version:           1.7.0
 * Requires at least: 4.6
 * Requires PHP:      5.6
 * Author:            uriel
 * Author URI:        https://urielwilson.com
 * Text Domain:       members-only-post-type
 * Domain Path:       languages
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

	// deny direct access.
    if ( ! defined( 'WPINC' ) ) {
	   	die;
    }

	// plugin directory.
		define( 'WPMPT_VERSION', '1.6.3' );

  	// plugin directory.
    	define( 'WPMPT_DIR', dirname( __FILE__ ) );

  	// plugin url.
    	define( 'WPMPT_URL', plugins_url( '/', __FILE__ ) );

	/**
	 * Load admin page class via composer
	 */
	require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';


// -----------------------------------------------------------------------------

	/**
	 * Setup options on activation
	 */
	register_activation_hook( __FILE__, function() {
		    update_option( 'wp_protected_post_types', array() );
		}
	);

// -----------------------------------------------------------------------------

	/**
	 * Initiate the Protected_Post_Type
	 */
	new MembersOnlyPostType\ProtectedPostType();

	/**
	 * Setup the admin page
	 */
	MembersOnlyPostType\Admin\ProtectedPostTypeAdmin::init();
