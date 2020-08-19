<?php

namespace MembersOnlyPostType\Admin;

  use MembersOnlyPostType\WPAdminPage\AdminPage;

final class ProtectedPostTypeAdmin extends AdminPage {

  /**
   * admin_menu()
   *
   * Main top level admin menus
   * @return [type] [description]
   */
  private static function admin_menu(){
    $menu = array();
    $menu['mcolor']       = '#ba315c';
    $menu['page_title']   = 'Members Only Post Type Settings';
    $menu['menu_title']   = 'Protected Posts';
    $menu['capability']   = 'manage_options';
    $menu['menu_slug']    = 'protected-post-type';
    $menu['function']     = 'protectedposttypes_callback';
    $menu['icon_url']     = 'dashicons-vault';
    $menu['position']     = null;
    $menu['prefix']       = 'ppt';
    $menu['plugin_path']  = plugin_dir_path( __FILE__ );
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
    return new ProtectedPostTypeAdmin(self::admin_menu());
  }
}
