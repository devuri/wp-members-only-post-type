<?php
/**
 * Plugin Name: Members Only Post Type
 * Plugin URI:  https://switchwebdev.com/wordpress-plugins/
 * Description: Members Only Post Type will Protected Post Types
 * Author:      SwitchWebdev.com
 * Author URI:  https://switchwebdev.com
 * Version:     1.5.1
 * License:     GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: members-only-post-type
 * Domain Path: languages
 * Usage:
 * Tags:
 *
 * Requires PHP: 5.6+
 * Tested up to PHP: 7.0
 *
 * Copyright 2020 Uriel Wilson, support@switchwebdev.com
 * License: GNU General Public License
 * GPLv2 Full license details in license.txt
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 * ----------------------------------------------------------------------------
 * @category  	Plugin
 * @copyright 	Copyright © 2020 Uriel Wilson.
 * @package   	MembersOnlyPostType
 * @author    	Uriel Wilson
 * @link      	https://switchwebdev.com
 *  ----------------------------------------------------------------------------
 */

  # deny direct access
    if ( ! defined( 'WPINC' ) ) {
      die;
    }

  # plugin directory
	  define("WPMPT_VERSION", '1.5.1');

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
require_once 'vendor/autoload.php';

// admin page
require_once plugin_dir_path( __FILE__ ). 'src/admin/class-protected-post-admin.php';
