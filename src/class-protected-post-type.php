<?php

namespace Members_Only_Post_Type;
/**
 * Protected Class
 */
final class ProtectedPostType {

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
