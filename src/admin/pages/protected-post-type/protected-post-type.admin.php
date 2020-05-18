<?php

  $dashicon_style = 'style="padding: 8px; vertical-align: middle;"';

	// Save Data
	if ( isset( $_POST['submit_protected'] ) ) :

		// lets verify the nonce
		if ( ! $this->form()->verify_nonce()  ) {
			wp_die($this->form()->user_feedback('Verification Failed !!!' , 'error'));
		}

    /**
     * Make sure this is set if not load empty array
     * @var [type]
     */
    if ( ! isset( $_POST['pptname'] ) ) {
      $protectedtypes = array();
      update_option('wp_protected_post_types', $protectedtypes );
      echo $this->form()->user_feedback(' Updated <strong>No Protected Post Types Have Been Set</strong> !!!', 'warning');
    } else {
      // sanitize
      foreach ($_POST['pptname'] as $pptkey => $pttval) {
        $protectedtypes[$pptkey] = sanitize_text_field($pttval);
      }
      // update and provide feedback
  	  update_option('wp_protected_post_types', $protectedtypes );
  		echo $this->form()->user_feedback('Protected Post Types Have Been Updated !!!');
    }


	endif;

    //print_r(get_option('wp_protected_post_types', 0));

?><div id="frmwrap" >
  <h2><?php _e('Select Post Types to be Protected'); ?></h2>
  <hr/>
  <div class="description">
    <?php _e('Set the Post types that you would like to be Members Only Access'); ?>
  </div>
<p/>
<form action="" method="POST"	enctype="multipart/form-data"><?php
  /**
   * get the post types
   * @var array
   */
  $pptargs = array(
      'public'   => true,
  );
  $getpost_types = get_post_types( $pptargs, 'objects' );

  /**
   * lets exclude these
   * @var array
   */
  $excludedtypes = array();
  $excludedtypes[] = 'elementor_library';
  $excludedtypes[] = 'elementor-hf';
  $excludedtypes[] = 'membersonly';


  /**
   * Get The Public Post Types
   * @var [type]
   */
  foreach ( $getpost_types  as $post_type ) {


    /**
     *  checked or not
     * @var [type]
     */
  if (in_array($post_type->name,get_option('wp_protected_post_types', 0) )) {
    $checkprotected = 'checked';
    $ptt_status = 'style=" background-color: #dff0d8;border-color: #d6e9c6;color: #4B8A3B; padding: 8px;border-bottom: solid thin;"';
  } else {
    $checkprotected = '';
    $ptt_status = 'style=" background-color: #F5F5F5;color: #555555; padding: 8px;"';
  }

  /**
   * exclude
   * @var [type]
   */
  if (in_array($post_type->name,$excludedtypes)) {
    // code...
  } else {
    /**
     * build out the checkboxes
     * @var [type]
     */
    echo '<div '.$ptt_status.' id="ppt_wrap '.$post_type->name.'" >';
    echo '<span '.$dashicon_style.' class="wp-menu-image wll-small-admin-dashicons '.$post_type->menu_icon.'"></span>';
    echo '<input type="checkbox" name="pptname['.$post_type->name.']" value="'.$post_type->name.'" '.$checkprotected.'>';
    echo '<label for="'.$post_type->name.'">';
    _e($post_type->labels->singular_name.' <span style="font-size: smaller;color: #a59b9b;"> '.$post_type->name.'</span>');
    echo '</label>';
    echo '</div>';
  }


  } // end foreach
  echo '<p/>';

  // generate nonce_field
  $this->form()->nonce();

  // submit button
  echo $this->form()->submit_button('Save Protected Post Types', 'primary large', 'submit_protected');
    ?>
</form>
<br/>
</div><!--frmwrap-->
