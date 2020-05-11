<?php

  $dashicon_style = 'style="padding: 8px; vertical-align: middle;"';

	// Save
	if ( isset( $_POST['submit_protected'] )  ) :

		// lets verify the nonce
		if ( ! $this->form()->verify_nonce()  ) {
			wp_die($this->form()->user_feedback('Verification Failed !!!' , 'error'));
		}

    // sanitize
    foreach ($_POST['pptname'] as $pptkey => $pttval) {
      $update_posttype[$pptkey] = sanitize_text_field($pttval);
    }

		// update the image and provide feedback
	  update_option('wp_protected_post_type', $update_posttype );
		echo $this->form()->user_feedback('Protected Post Types Have Been Updated !!!');

	endif;

?><?php


  //print_r(get_option('wp_protected_post_type'));


?><div id="frmwrap" >
  <h2>Select Post Types to be Protected</h2>
  <hr/>
  <div class="description">
    Set the Post types that you would like to be Members Only Access
  </div>
<p/>
<form action="" method="POST"	enctype="multipart/form-data"><?php
  /**
   * get the post types
   * @var array
   */
  $args = array(
      'public'   => true,
  );
  $post_types = get_post_types( $args, 'objects' );


  /**
   * Get The Public Post Types
   * @var [type]
   */
  foreach ( $post_types  as $post_type ) {
    /**
     *
     * @var [type]
     */
    if (in_array($post_type->name, get_option('wp_protected_post_type'))) {
      $checkprotected = 'checked';
      $ptt_status = 'style=" background-color: #dff0d8;border-color: #d6e9c6;color: #4B8A3B; padding: 8px;border-bottom: solid thin;"';
    } else {
      $checkprotected = '';
      $ptt_status = 'style=" background-color: #F5F5F5;color: #555555; padding: 8px;"';
    }

    /**
     * build out the checkboxes
     * @var [type]
     */
    echo '<div '.$ptt_status.' id="ppt_wrap '.$post_type->name.'" >';
    echo '<span '.$dashicon_style.' class="wp-menu-image wll-small-admin-dashicons '.$post_type->menu_icon.'"></span>';
    echo '<input type="checkbox" name="pptname['.$post_type->name.']" value="'.$post_type->name.'" '.$checkprotected.'>';
    echo '<label for="'.$post_type->name.'">';
    echo $post_type->labels->singular_name;
    echo '</label>';
    echo '</div>';
    //echo '<hr/>';
  }// end foreach
  echo '<p/>';

  // nonce_field
  $this->form()->nonce();

  // submit button
  echo $this->form()->submit_button('Save Protected Post Types', 'primary large', 'submit_protected');
    ?>
</form>
<br/>
</div><!--frmwrap-->
