<?php

namespace MembersOnlyPostType;

/**
 * Protected Class
 */
final class ProtectedPostType {

	/**
	 * [__construct description]
	 */
	public function __construct() {
		add_filter( 'the_content', array( $this, 'protected_post' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'message_style' ) );
	}

	/**
	 * Protected Post
	 *
	 * @param string $content [description].
	 * @return $content
	 */
	public function protected_post( $content ) {

		/**
		 * Get the post object
		 */
		global $post;

		$postID = get_the_ID(); // @codingStandardsIgnoreLine
		if ( is_singular() && is_main_query() ) {

				// check login.
				if ( is_user_logged_in() ) {
				    return $content;
				}

			    /**
			     * Check if view in protected content
			     *
			     * TODO Add this to the options table
			     */
			    if ( in_array( $post->post_type, $this->is_protected(), true ) ) {
			    	return $this->members_only_message();
			    }
				return $content;
	  	}
	}

	/**
	 * Protected Post Type Array
	 *
	 * @return array
	 */
	private function is_protected() {
		return get_option( 'wp_protected_post_types', array() );
	}

	/**
	 * Message
	 */
	private function members_only_message() {
		$message  = '<div class="members-only">';
		$message .= 'Sorry You Need to Login!';
		$message .= '<hr/>';
		$message .= '<button class="members-only-button ppt-black">';
		$message .= '<a href="' . wp_login_url( get_permalink() ) . '" title="Members Area Login" rel="home">Members Area</a>';
		$message .= '</button>';
		$message .= ' ';
		$message .= '<button class="members-only-button ppt-blue">';
		$message .= '<a href="' . wp_login_url( get_permalink() ) . '" title="Log In" rel="home">Log In</a>';
		$message .= '</button>';
		$message .= '</div>';
		return $message;
	}

	/**
	 * Styles
	 *
	 * @return void
	 */
	public function message_style() {

	  	/**
	   	 * Load styles
	   	 */
	  	wp_enqueue_style( 'protected-post-type', WPMPT_URL . 'assets/css/members-post-type-styles.css', array(), WPMPT_VERSION, 'all' );

	    $ppt_css = '/** inline **/
		    .ppt-black{
		        background:#333333;
		    }
		    .ppt-blue{
		        background:#037DBB;
		    }
		    /** inline **/';
	    wp_add_inline_style( 'protected-post-type', $ppt_css );
	}
}
