<?php

namespace basswp\setup\pages;

function remove_options(){
	/* Posts */
	//remove_menu_page( 'edit.php' );
	/* Categories */
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
	/* Tags */
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	/* Pages */
	remove_menu_page( 'edit.php?post_type=page' );
	/* Plugins */
	//remove_menu_page( 'plugins.php' );
	/* Themes */
	//remove_menu_page( 'themes.php' );
	remove_menu_page( 'edit-comments.php' );
	/* Tools */
	remove_menu_page( 'tools.php' );
}

add_action( 'admin_menu', __NAMESPACE__ . '\\remove_options' );

function admin(){

	/*
		Turn off the Admin Bar for user role >= admin
		@link https://codex.wordpress.org/Function_Reference/show_admin_bar
	*/

	if ( current_user_can( 'manage_options' ) ) {
		show_admin_bar( false );
	}

	/*
		Turn off the ACF admin page if < admin
		@link https://www.advancedcustomfields.com/resources/how-to-hide-acf-menu-from-clients/
	*/
	
	if ( ! current_user_can( 'manage_options' ) ) {
		add_filter('acf/settings/show_admin', '__return_false');
	}
	
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\admin' );