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
  // create admin pages
  Protected_Post_Type_Admin::init();
