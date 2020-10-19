<?php

namespace MembersOnlyPostType\Admin;

	use MembersOnlyPostType\WPAdminPage\AdminPage;

final class ProtectedPostTypeAdmin extends AdminPage {

	/**
	 * Main top level admin menus
	 *
	 * @return array $menu
	 */
  	private static function admin_menu() {
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
	 * Submenu items
	 *
	 * @return array
	 */
	private static function submenu() {
	    $menu = array();
	    $menu[] = 'Protected';
	    $menu[] = 'Access Level';
	    return $menu;
	}

	/**
	 * Init
	 *
	 * @return object
	 */
  	public static function init() {
    	return new ProtectedPostTypeAdmin( self::admin_menu() );
  	}
}
