<?php get_header() ?>

	<?php
		
		/* if we have posts in the loop */
		if( have_posts() ) {
			
			/* begin the post loop */
			while ( have_posts() ) : the_post();
				
				/* get the content template part based on the post format */
				get_template_part( 'loops/content', get_post_format() );
				
			/* end the loop */
			endwhile;
			
			/* show the navigation for pageination */
			echo pxjn_content_nav();
		
		}
	
	?>

<?php get_footer(); ?>