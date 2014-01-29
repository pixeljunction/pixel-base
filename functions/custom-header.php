<?php
/***************************************************************
* Function pxjn_custom_header_setup()
* Adds support for a custom header in the theme
***************************************************************/
function pxjn_custom_header_setup() {
	
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
		'wp-head-callback'       => 'pxjn_header_style',
		'admin-head-callback'    => 'pxjn_admin_header_style',
		'admin-preview-callback' => 'pxjn_admin_header_image',
	);
	
	/* hook the default arguments into the add theme support call and actually add the custom header support */
	add_theme_support( 'custom-header', $pxjn_custom_header_defaults );
	
}

add_action( 'after_setup_theme', 'pxjn_custom_header_setup', 20 );

/***************************************************************
* Function pxjn_header_style()
* Styles the custom header
* see pxjn_custom_header_setup()
***************************************************************/
if( ! function_exists( 'pxjn_header_style' ) ) {
	
	function pxjn_header_style() {
		
		/* get the colour of the text inside the header - set in the admin */
		$header_text_color = get_header_textcolor();
	
		/* if no custom options for text are set, let's bail */
		if( HEADER_TEXTCOLOR == $header_text_color )
			return;
	
		/* if we get this far, we have custom styles - lets style the front end using these custom styles */
		?>
			
			<style type="text/css">
			
			<?php
				/* hass the text been hidden? */
				if ( 'blank' == $header_text_color ) {
				
				?>
				
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
				
				<?php
				/* if the user has set a custom color for the text use that */
				} else {
				
				?>
				
				.site-title a,
				.site-description {
					color: #<?php echo $header_text_color; ?>;
				}
				
				<?php
				}
				
			?>
			
			</style>
			
		<?php
	
	} // end function

} // end if function exists

/***************************************************************
* Function pxjn_admin_header_style()
* Styles the header image displayed on the Appearance > Header
* admin panel
* see pxjn_custom_header_setup()
***************************************************************/
if ( ! function_exists( 'pxjn_admin_header_style' ) ) {

	function pxjn_admin_header_style() {
		
		?>
		
		<style type="text/css">
			.appearance_page_custom-header #headimg {
				border: none;
			}
			#headimg h1,
			#desc {
			}
			#headimg h1 {
			}
			#headimg h1 a {
			}
			#desc {
			}
			#headimg img {
			}
		</style>
	
	<?php
	} // end function

} // end if function exists

/***************************************************************
* Function pxjn_admin_header_image()
* Custom header image markup displayed on the Appearance >
* Header admin panel
* see pxjn_custom_header_setup()
***************************************************************/
if ( ! function_exists( 'pxjn_admin_header_image' ) ) {

	function pxjn_admin_header_image() {
		
		/* get the header text colour set in admin printed as inline style */
		$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
		
		?>
		
		<div id="headimg">
		
			<h1 class="displaying-header-text">
				<a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</h1>
			
			<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
			
			<?php
				
				/* if we have a header image already set */
				if ( get_header_image() ) {
					
				?>
				<img src="<?php header_image(); ?>" alt="" />
				<?php
				
				}
			
			?>
			
		</div>
		
	<?php
	
	} // end function

} // end if function exists