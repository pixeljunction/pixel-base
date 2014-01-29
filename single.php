<?php

/*
* This is the main index template of this theme. The fallback
* template used when others are not included. This is needed
* for the theme to work.

* lets start by getting the header template file
*/

get_header();

?>

	<main id="primary" class="content">
	
		<?php
				
			/**************************************************************************
            * Hook pxjn_before_loop
            **************************************************************************/
            do_action( 'pxjn_before_loop' );
			
			/* start the loop */
			while( have_posts() ) : the_post();
			
				/* get the single loop template */
				get_template_part( 'loops/content', 'single' );
			
			/* end the loop */
			endwhile;
			
			/**************************************************************************
            * Hook pxjn_after_loop
            **************************************************************************/
            do_action( 'pxjn_after_loop' );
            
            /* check if comments are open - load comments template if they are */
            if ( comments_open() )
            	comments_template();
            
            /**************************************************************************
            * Hook pxjn_after_comments
            **************************************************************************/
            do_action( 'pxjn_after_comments' );
		
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