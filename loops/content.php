<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	
		/**************************************************************************
        * Hook pxjn_before_post_title
        **************************************************************************/
        do_action( 'pxjn_before_post_title' );
		
		/* output the post title - can be filtered to change the markup */
		the_title( '<header class="post-header"><h1 class="post-title">', '</h1></header>' );
		
		/**************************************************************************
        * Hook pxjn_before_post_content
        **************************************************************************/
        do_action( 'pxjn_before_post_content' );
        
        /* output the content of the post */
        the_content();
        
        /**************************************************************************
        * Hook pxjn_after_post_content
        **************************************************************************/
        do_action( 'pxjn_after_post_content' );
	
	?>

</article>