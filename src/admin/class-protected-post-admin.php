<?php

use WPAdminPage\AdminPage;

final class Protected_Post_Type_Admin extends AdminPage {

  /**
   * admin_menu()
   *
   * Main top level admin menus
   * @return [type] [description]
   */
  private static function admin_menu(){
    $menu = array();
    $menu[] = '#ba315c';
    $menu[] = 'Members Only Post Type Settings';
    $menu[] = 'Protected Posts';
    $menu[] = 'manage_options';
    $menu[] = 'protected-post-type';
    $menu[] = 'protectedposttypes_callback';
    $menu[] = 'dashicons-vault';
    $menu[] = null;
    $menu[] = 'ppt';
    $menu[] = plugin_dir_path( __FILE__ );
    //$menu[] = false;
    return $menu;
  }

  /**
   * submenu items
   * @return [type] [description]
   */
  private static function submenu(){
    $menu = array();
    $menu[] = 'Protected';
    $menu[] = 'Access Level'; // set the access level required to view
    //$menu[] = 'Redirect Rule'; // allow the user to set redirect page
    //$menu[] = 'Custom Message'; // allow the user to set redirect page
    //$menu[] = 'CTA'; // allow the user to set redirect page
    return $menu;
  }

  /**
   * init
   * @return [type] [description]
   */
  public static function init(){
    return new Protected_Post_Type_Admin(self::admin_menu());
  }
}

  /**
   * setup the admin page
   * @var [type]
   */
  Protected_Post_Type_Admin::init();
