<?php
/**
 * Plugin Name: Members Only Post Type
 * Plugin URI:  https://switchwebdev.com/wordpress-plugins/
 * Description: Members Only Post Type will Protected Post Types
 * Author:      SwitchWebdev.com
 * Author URI:  https://switchwebdev.com
 * Version:     1.0.6
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
	  define("WPMPT_VERSION", '1.0.6');

  # plugin directory
    define("WPMPT_DIR", dirname(__FILE__));

  # plugin url
    define("WPMPT_URL", plugins_url( "/",__FILE__ ));
#  -----------------------------------------------------------------------------

  /**
   * setup options on activation
   * @var [type]
   */
  register_activation_hook( __FILE__, 'wpmpt_activation' );
  function wpmpt_activation() {
    $protected_defualts = array();
    update_option('wp_protected_post_types', $protected_defualts );
  }


/**
 * Protected Class
 */
final class Protected_Post_Type {

	function __construct() {
		add_filter('the_content', array( $this , 'protected_post'), 99);
		add_action( 'wp_enqueue_scripts', array( $this ,'message_style' ));
	}

	/**
	 * [protected_post description]
	 * @param  [type] $content [description]
	 * @return [type]          [description]
	 */
	public function protected_post($content){

		/**
		 * get the post object
		 * @var [type]
		 */
		global $post;

	  $postID = get_the_ID();
	  if( is_singular() && is_main_query() ) {

			/**
			 * check login
			 * @var [type]
			 */
		  if ( is_user_logged_in() ) {
		    return $content;
		  } else {

		    /**
		     * check if view in protected content
		     * TODO Add this to the options table
		     * @var array
		     */
		    if (in_array( $post->post_type, $this->protected_ptypes() ) ) {
		      return $this->members_only_message();
		    } else {
		      return $content;
		    }
		  }//login check
	  } // $query
	}

	/**
	 * Protected Post Type Array
	 * @return [type] [description]
	 */
	private function protected_ptypes(){
    $protected = get_option('wp_protected_post_types');
		return $protected;
	}


	/**
	 * Message
	 * @return [type] [description]
	 */
	private function members_only_message(){
		$message  = '<div class="members-only">';
		$message .= 'Sorry You Need to Login!';
		$message .= '<hr/>';
		$message .= '<button class="members-only-button ppt-black">';
		$message .= '<a href="'.wp_login_url( get_permalink() ).'" title="Members Area Login" rel="home">Members Area</a>';
		$message .= '</button>';
		$message .= ' ';
		$message .= '<button class="members-only-button ppt-blue">';
		$message .= '<a href="'.wp_login_url( get_permalink() ).'" title="Log In" rel="home">Log In</a>';
		$message .= '</button>';
		$message .= '</div>';
		return $message;
	}

  /**
   * styles
   * @return [type] [description]
   */
  public function message_style() {

  /**
   * load styles
   * @var [type]
   */
  wp_enqueue_style( 'protected-post-type', WPMPT_URL . 'assets/css/members-post-type-styles.css', array(), WPMPT_VERSION, 'all' );

    $ppt_css = "/** inline **/
      .ppt-black{
        background:#333333;
      }
      .ppt-blue{
        background:#037DBB;
      }
      /** inline **/";
    wp_add_inline_style( 'protected-post-type', $ppt_css );
  }

}

	/**
	 * initiate the Protected_Post_Type
	 * @var [type]
	 */
	new Protected_Post_Type();


#------------------------------------------------------------------------------
/**
 * Load admin page
 * @var [type]
 */
require_once WPMPT_DIR . '/vendor/wp-admin-page/AdminPage.php';

// admin page
require_once plugin_dir_path( __FILE__ ). 'src/admin/class-protected-post-admin.php';
