<?php

/* functions specific to this framework to give additional functionality in the back end dashbaord */

/* changes the admin dashboard footer text */
	if ( ! function_exists( 'pxjn_admin_footer_text' ) ) { // check it doesn't exist in child theme 
		function pxjn_admin_footer_text () {
			
			/* the text we want to display in the footer */
			echo "Site created by <a href='http://pixeljunction.co.uk'>Pixel Junction</a> using <a href='http://wordpress.org'>WordPress</a>";
		}
	}
	add_filter('admin_footer_text', 'pxjn_admin_footer_text');

/* changes the posts item in the dashboard to read news */
	if ( ! function_exists( 'pxjn_change_post_menu_label' ) ) { // check it doesn't exist in child theme
		function pxjn_change_post_menu_label() {
		    global $menu;
		    global $submenu;
		    
		    /* change the menu labels for posts */
		    $menu[5][0] = 'News';
		    $submenu['edit.php'][5][0] = 'All News';
		    $submenu['edit.php'][10][0] = 'Add News Article';
		    $submenu['edit.php'][15][0] = 'Categories'; // Change name for categories
		    $submenu['edit.php'][16][0] = 'Tags'; // Change name for tags
		    echo '';
		}
	}
	
	/* hook post menu label changes into wordpress */
	add_action( 'admin_menu', 'pxjn_change_post_object_label' );
	
	if ( ! function_exists( 'pxjn_change_post_object_label' ) ) { // check it doesn't exist in child theme
		function pxjn_change_post_object_label() {
	        global $wp_post_types;
	        
	        /* change the post object labels such as on the write post screen */
	        $labels = &$wp_post_types['post']->labels;
	        $labels->name = 'News';
	        $labels->singular_name = 'News Article';
	        $labels->add_new = 'Add News Article';
	        $labels->add_new_item = 'Add New';
	        $labels->edit_item = 'Edit News Items';
	        $labels->new_item = 'News';
	        $labels->view_item = 'View News Article';
	        $labels->search_items = 'Search News';
	        $labels->not_found = 'No News Articles found';
	        $labels->not_found_in_trash = 'No News Articles found in Trash';
	    }
	}
    
    /* hook post object label changes into wordpress */
    add_action( 'admin_menu', 'pxjn_change_post_menu_label' );

/* removes menus for none admins */
	add_action( 'admin_menu', 'pxjn_remove_menus', 999 );
	if ( ! function_exists( 'pxjn_remove_menus' ) ) { // check it doesn't exist in child theme
		function pxjn_remove_menus() {
		
			/* get the current user information */
			global $current_user;
			
			/* get the current users ID and assign to variable */
			$current_user = wp_get_current_user(); $current_user_id = $current_user->ID;
			
			/* check for user ID number 1 - the main admin */
			if( $current_user_id != '1' ) {
			
				/* remove menus that are not required */
				remove_menu_page( 'tools.php');
				remove_menu_page( 'plugins.php');
				remove_menu_page( 'link-manager.php');
				remove_submenu_page( 'themes.php', 'themes.php' );
				remove_submenu_page( 'themes.php', 'theme-editor.php' );
				remove_submenu_page( 'options-general.php', 'options-media.php' );
				remove_submenu_page( 'options-general.php', 'options-permalink.php' );
				remove_submenu_page( 'options-general.php', 'options-privacy.php' );
				remove_submenu_page( 'options-general.php', 'options-reading.php' );
				remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			
			}
			
		}
	}

/* reorders the dashboard admin menu */
	if ( ! function_exists( 'pxjn_custom_menu_order' ) ) { // check it doesn't exist in child theme
		function pxjn_custom_menu_order($menu_ord) {
			if (!$menu_ord) return true;
			return array(
				'index.php', // Dashboard
				'separator1', // First separator
				'edit.php?post_type=page', // Pages
				'edit.php', // Posts
				'upload.php', // Media
				'link-manager.php', // Links
				'edit-comments.php', // Comments
				'separator2', // Second separator
				'themes.php', // Appearance
				'plugins.php', // Plugins
				'users.php', // Users
				'tools.php', // Tools
				'options-general.php', // Settings
				//'separator-last', // Last separator
			);
		}
	}
	add_filter('custom_menu_order', 'pxjn_custom_menu_order'); // Activate custom_menu_order
	add_filter('menu_order', 'pxjn_custom_menu_order');

/* removes the unecessary dashboard widgets */
	if ( ! function_exists( 'pxjn_remove_dashboard_widgets' ) ) { // check it doesn't exist in child theme
		function pxjn_remove_dashboard_widgets() {
			global $wp_meta_boxes;
			
			/* remove the widgets, one by one of each line */
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // quick press widget
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // incoming links widget
			unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // plugins widget
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // recent drafts widget
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // primary rss box
			unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // secondary rss box
		}
	}
	
	/* add our remove function to apply on dashbaord setup */
	add_action('wp_dashboard_setup', 'pxjn_remove_dashboard_widgets' );

/* adds our own dashboard widget as a welcome screen item */
	if ( ! function_exists( 'pxjn_wp_dashboard_widget' ) ) { // check it doesn't exist in child theme
		function pxjn_wp_dashboard_widget() {
		
			/* echo out the contents of our widget, in this case text */
			echo '<p>The Pixel Junction Team would like to thank you for using us for your website.</p>';
		}
	}
	
	/* setup the dashboard widget, including our content from above */
	if ( ! function_exists( 'pxjn_wp_dashboard_setup' ) ) { // check it doesn't exist in child theme
		function pxjn_wp_dashboard_setup() {
			wp_add_dashboard_widget( 'pxjn_welcome_widget', __( 'Welcome to Your New Website', 'pxjn' ), 'pxjn_wp_dashboard_widget' );
		}
	}
	
	/* add our dashboard widget setup function to the wordpress dashbaord widget setup action hook */
	add_action('wp_dashboard_setup', 'pxjn_wp_dashboard_setup');

?>