<?php

/* most sites have a sidebar, which will need widgetizing, lets create a sidebar widget */

/* check it does exists in child theme */
if ( ! function_exists( 'pxjn_register_widgets' ) ) {
	
	/* build function for registering widgets */
	function pxjn_register_widgets() {
		
		/* lets register the sidebar - this can be repeated for additional sidebars */
		register_sidebar(
			array(
				'id' => 'pxjn_posts_widgets',
				'name' => __( 'Posts Sidebar', 'pxjn' ),
				'description' => __( 'Sidebar used for the posts sidebars.', 'pxjn' ),
				'before_widget' => '<div id="%1$s" class="pxjn_widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h2 class="pxjn_widget_title">',
				'after_title' => '</h2>'
			)
		);
	}
}

?>