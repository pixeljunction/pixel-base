<?php

/*
* This is search page template
* lets start by getting the header template file
*/

get_header();

?>

	<main id="primary" class="content">
	
		<?php
		
			/* check whether we have posts */
			if( have_posts() ) {
			
				?>
				
				<header class="page-header">
				
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'pxjn' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				
				</header><!-- .page-header -->
				
				<?php
				/**************************************************************************
                * Hook pxjn_before_loop
                **************************************************************************/
                do_action( 'pxjn_before_loop' );
				
				/* start the loop */
				while( have_posts() ) : the_post();
				
					/* get the search loop template */
					get_template_part( 'loops/content', 'search' );
				
				/* end the loop */
				endwhile;
				
				/**************************************************************************
                * Hook pxjn_after_loop
                **************************************************************************/
                do_action( 'pxjn_after_loop' );
                
                /* output core post nav if available */
                if( function_exists( 'pxlcore_content_nav' ) )
                	echo pxlcore_content_nav();
			
			/* no post are found in the search */
			} else {
				
				/* load the template part for no content */
				get_template_part( 'loops/content', 'none' );
				
			} // end if have posts
		
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