<?php

/*
* This is the main index template of this theme. The fallback
* template used when others are not included. This is needed
* for the theme to work.

* lets start by getting the header template file
*/

get_header();

?>

	<main id="primary" class="content" role="main">
	
		<?php
		
			/* check whether we have posts */
			if( have_posts() ) {
			
				/**************************************************************************
                * Hook pxjn_before_loop
                **************************************************************************/
                do_action( 'pxjn_before_loop' );
				
				/* start the loop */
				while( have_posts() ) : the_post();
				
					/* get the post format specific loop template */
					get_template_part( 'loops/content', get_post_format() );
				
				/* end the loop */
				endwhile;
				
				/**************************************************************************
                * Hook pxjn_after_loop
                **************************************************************************/
                do_action( 'pxjn_after_loop' );
                
                /* output core post nav if available */
                if( function_exists( 'pxlcore_content_nav' ) )
                	echo pxlcore_content_nav();
				
			}
		
		?>
	
	</main><!-- content -->
	
	<?php
	
		/* get the sidebar for this template */
		get_sidebar( 'posts' );
	
	?>
	
	<div class="clearfix"></div>

<?php

/* get the footer template file */
get_footer();

?>