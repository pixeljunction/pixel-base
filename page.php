<?php

/*
* This is the template used for pages.
* lets start by getting the header template file
*/

get_header( 'page' );

?>

	<main id="primary" class="content">
	
		<?php
					
			/**************************************************************************
            * Hook pxjn_before_loop
            **************************************************************************/
            do_action( 'pxjn_before_loop' );
			
			/* start the loop */
			while( have_posts() ) : the_post();
			
				/* get the page content loop */
				get_template_part( 'loops/content', 'page' );
			
			/* end the loop */
			endwhile;
			
			/**************************************************************************
            * Hook pxjn_after_loop
            **************************************************************************/
            do_action( 'pxjn_after_loop' );
		
		?>
	
	</main><!-- content -->
	
	<?php
	
		/* get the sidebar for this template */
		get_sidebar( 'page' );
	
	?>
	
	<div class="clearfix"></div>

<?php

/* get the footer template file */
get_footer();

?>