<?php

/* includes the themes hooks to make them run when called in theme template files */
require_once(TEMPLATEPATH . '/pxjn/pxjn-hooks.php');

/* includes the framework functions */
require_once(TEMPLATEPATH . '/pxjn/pxjn-functions.php');

/* includes the framework functions for the dashboard */
require_once(TEMPLATEPATH . '/pxjn/pxjn-dashboard-functions.php');

/* includes the counter functions */
require_once(TEMPLATEPATH . '/pxjn/pxjn-counters.php');

/* includes the widget functions */
require_once(TEMPLATEPATH . '/pxjn/pxjn-widget-functions.php');

/* most sites need a menu, lets set one up using the WordPress menus functionality */
	if ( ! function_exists( 'pxjn_menu' ) ) {	
		function pxjn_menu() {
			register_nav_menu( 'pxjn_topmenu', __( 'Top Menu', 'pxjn' ) );
		}
	}
	
	/* this is our themes setup function */
	add_action( 'after_setup_theme', 'pxjn_theme_setup', 10 );

/* allow the theme to be updated */
	require_once('wp-updates-theme.php');
	new WPUpdatesThemeUpdater( 'http://beta.wp-updates.com/api/1/theme', 14, basename(get_template_directory()) );

/* check the theme setup function does not already exist, such as in a child theme */
if ( ! function_exists( 'pxjn_theme_setup' ) ) {
	
	/* build our theme setup function */
	function pxjn_theme_setup() {
	
		/* set the $content_width for things such as video embeds usually width of themes 'content' div */
		if ( !isset( $content_width ) )
			$content_width = 610; // usually set to the max width of your post container
				
		/* adds featured image support */
		add_theme_support( 'post-thumbnails' );
		/* images sizes can be added here using - http://codex.wordpress.org/Function_Reference/add_image_size */
		
		/* add your nav menus function to the 'init' action hook */
		add_action( 'init', 'pxjn_menu' );
		
		/* add your sidebars function to the 'widgets_init' action hook */
		add_action( 'widgets_init', 'pxjn_register_widgets' );
		
		/* adds the editor stylesheet */
		add_editor_style('/mdw/css/editor-style.css');
		
		/* Add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' );
		
		/* add custom header theme support */
		if ( ! function_exists( 'pxjn_custom_header_args' ) ) { // check this function is not declared in child theme
			
			/* build function to declare custom header arguments */
			function pxjn_custom_header_args() {
				$pxjn_custom_header_defaults = array(
					'default-image'          => '',
					'random-default'         => false,
					'width'                  => 960,
					'height'                 => 130,
					'flex-height'            => false,
					'flex-width'             => false,
					'default-text-color'     => '',
					'header-text'            => false,
					'uploads'                => true,
					'wp-head-callback'       => '',
					'admin-head-callback'    => '',
					'admin-preview-callback' => '',
				);
				return $pxjn_custom_header_defaults;
			}
		}
		
		/* hook the default arguments into the add theme support call and actually add the custom header support */
		add_theme_support( 'custom-header', pxjn_custom_header_args() );
		
		/* add custom background theme support */
		if ( ! function_exists( 'pxjn_custom_background_args' ) ) { // check this function is not declared in child theme
			
			/* build function to declare custom header arguments */
			function pxjn_custom_background_args() {
				$pxjn_custom_background_defaults = array(
					'default-color'          => 'FFFFFF',
					'default-image'          => '',
					'wp-head-callback'       => '_custom_background_cb',
					'admin-head-callback'    => '',
					'admin-preview-callback' => ''
				);
				return $pxjn_custom_background_defaults;
			}
					
		}
		
		/* hook the default arguments into the add theme support call and actually add the custom background support */
		add_theme_support( 'custom-background', pxjn_custom_background_args() );
	
		/****** theme defaults are set and message outputted ******/
		
		/* First we check to see if our default theme settings have been applied */
		$pxjn_the_theme_status = get_option( 'theme_setup_status' );
		
		/* If the theme has not yet been used we want to run our default settings */
		if ( $pxjn_the_theme_status !== '1' ) {
		
			/* Setup Default WordPress settings */
			$pxjn_core_settings = array(
				'image_default_link_type' => '', // images link to nothing by default
				'thumbnail_crop' => 1, // set wordpress to crop thumbnails always
				'users_can_register' => 0, // user can not register for this site
				'blog_public' => 1 // make sure that the site is not blocked from search engines
			);
			
			/* loop through each of the above, updating the option each time */
			foreach ( $pxjn_core_settings as $k => $v ) {
				update_option( $k, $v );
			}
			
			/* done - now register a setting so we don't do this each time */
			update_option( 'theme_setup_status', '1' );
			
			/* display an admin message to let the user know what is going on. */
			$pxjn_msg = '
			<div class="error">
				<p>The ' . get_option( 'current_theme' ) . 'theme has changed your WordPress default <a href="' . admin_url() . 'options-general.php" title="See Settings">settings</a>. These changes were made to optimise WordPress for the ' . get_option( 'current_theme' ) . ' theme.</p>
			</div>';
			add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $pxjn_msg, '"' ) . '";' ) );
		}
		
		/* else if the theme is being reactived show a different message */
		elseif ( $pxjn_the_theme_status === '1' and isset( $_GET['activated'] ) ) {
			$pxjn_msg = '
			<div class="updated">
				<p>The ' . get_option( 'current_theme' ) . ' theme was successfully re-activated.</p>
			</div>';
			add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $pxjn_msg, '"' ) . '";' ) );
		}
	} // end pxjn_theme_setup function
} // end if pxjn_theme_setup function exists

?>