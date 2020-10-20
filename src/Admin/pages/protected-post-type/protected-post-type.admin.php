<?php

  	$dashicon_style = 'style="padding: 8px; vertical-align: middle;"';

	// Save Data.
	if ( isset( $_POST['submit_protected'] ) ) : // @codingStandardsIgnoreLine

		// lets verify the nonce.
		if ( ! $this->form()->verify_nonce() ) {
			wp_die( $this->form()->user_feedback( 'Verification Failed !!!' , 'error' ) ); // @codingStandardsIgnoreLine
		}

    /**
     * Make sure this is set if not load empty array
     */
    if ( ! isset( $_POST['pptname'] ) ) { // @codingStandardsIgnoreLine
      	$protectedtypes = array();
      	update_option( 'wp_protected_post_types', $protectedtypes );
      	echo $this->form()->user_feedback( ' Updated <strong>No Protected Post Types Have Been Set</strong> !!!', 'warning' ); // @codingStandardsIgnoreLine
    } else {
      	// sanitize.
	    foreach ( $_POST['pptname'] as $pptkey => $pttval ) { // @codingStandardsIgnoreLine
	       	$protectedtypes[ $pptkey ] = sanitize_text_field( $pttval );
	    }
      	// update and provide feedback.
  	  	update_option( 'wp_protected_post_types', $protectedtypes );
  		echo $this->form()->user_feedback( 'Protected Post Types Have Been Updated !!!' ); // @codingStandardsIgnoreLine
    }


	endif;

	?>
	<div id="frmwrap" >
		<h2>
			<?php
				_e( 'Select Post Types to be Protected' ); // @codingStandardsIgnoreLine
			?>
		</h2>
		<hr/>
		<div class="description">
		    <?php
				_e( 'Set the Post types that you would like to be Members Only Access'  ); // @codingStandardsIgnoreLine
			?>
		</div>
	<p/>
<form action="" method="POST"	enctype="multipart/form-data">
	<?php
	/**
	 * Get the post types
	 */
	$pptargs = array(
	    'public' => true,
	);
	$getpost_types = get_post_types( $pptargs, 'objects' );

	/**
	 * Lets exclude these
	 */
	$excludedtypes = array();
	$excludedtypes[] = 'elementor_library';
	$excludedtypes[] = 'elementor-hf';
	$excludedtypes[] = 'membersonly';

	/**
	 * Get The Public Post Types
	 */
	foreach ( $getpost_types  as $post_type ) { // @codingStandardsIgnoreLine

	    /**
	     *  Checked or not
	     */
		if ( in_array( $post_type->name, get_option( 'wp_protected_post_types', 0 ), true ) ) {
		    $checkprotected = 'checked';
		    $ptt_status = 'style=" background-color: #dff0d8;border-color: #d6e9c6;color: #4B8A3B; padding: 8px;border-bottom: solid thin;"';
		} else {
		    $checkprotected = '';
		    $ptt_status = 'style=" background-color: #F5F5F5;color: #555555; padding: 8px;"';
		}

		/**
		 * Exclude
		 */
	  	if ( in_array( $post_type->name, $excludedtypes, true ) ) {
		    echo '';
	  	} else {
		    /**
		     * Build out the checkboxes
		     */
		    echo '<div ' . esc_attr( $ptt_status ) . ' id="ppt_wrap ' . esc_attr( $post_type->name ) . '" >';
		    echo '<span ' . esc_attr( $dashicon_style ) . ' class="wp-menu-image wll-small-admin-dashicons ' . esc_attr( $post_type->menu_icon ) . '"></span>';
		    echo ' <input type="checkbox" name="pptname[' . esc_attr( $post_type->name ) . ']" value="' . esc_attr( $post_type->name ) . '" ' . esc_attr( $checkprotected ) . '> ';
		    echo '<label for="' . esc_attr( $post_type->name ) . '"> ';
		    echo esc_attr( $post_type->labels->singular_name ) . ' <span style="font-size: smaller;color: #a59b9b;"> ' . esc_attr( $post_type->name ) . '</span>';
		    echo '</label>';
		    echo '</div>';
		}
	}
	echo '<p/>';

  	// generate nonce_field.
  	$this->form()->nonce();

  		// submit button.
  		echo $this->form()->submit_button( 'Save Protected Post Types', 'primary large', 'submit_protected' ); // @codingStandardsIgnoreLine
    	?>
		</form>
	<br/>
</div><!--frmwrap-->
