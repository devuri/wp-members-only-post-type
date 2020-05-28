<?php
/**
 * Members Only Post Type
 *
 * @package           MembersOnlyPostType
 * @author            Uriel Wilson
 * @copyright         2020 Uriel Wilson
 * @license           GPL-2.0
 * @link           		https://urielwilson.com
 *
 * @wordpress-plugin
 * Plugin Name:       Members Only Post Type
 * Plugin URI:        https://switchwebdev.com/wordpress-plugins/
 * Description:       Members Only Post Type will Protected and Restrict access to custom Post Types
 * Version:           1.5.5
 * Requires at least: 3.4
 * Requires PHP:      5.6
 * Author:            SwitchWebdev.com
 * Author URI:        https://switchwebdev.com
 * Text Domain:       members-only-post-type
 * Domain Path:       languages
 * License:           GPLv2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

  # deny direct access
    if ( ! defined( 'WPINC' ) ) {
      die;
    }

  # plugin directory
	  define("WPMPT_VERSION", '1.5.3');

  # plugin directory
    define("WPMPT_DIR", dirname(__FILE__));

  # plugin url
    define("WPMPT_URL", plugins_url( "/",__FILE__ ));
#  -----------------------------------------------------------------------------

  /**
  * require_once // Load the main class.
  */
  require_once plugin_dir_path( __FILE__ ) . '/src/class-protected-post-type.php';


  /**
   * setup options on activation
   */
  register_activation_hook( __FILE__, 'wpmpt_activation' );
  function wpmpt_activation() {
    $protected_defualts = array();
    update_option('wp_protected_post_types', $protected_defualts );
  }



	/**
	 * initiate the Protected_Post_Type
	 */
	new Members_Only_Post_Type\Protected_Post_Type();
#------------------------------------------------------------------------------
/**
 * Load admin page class via composer
 */
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// admin page
require_once plugin_dir_path( __FILE__ ) . 'src/admin/class-protected-post-admin.php';
