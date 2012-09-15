<div id="<?php echo get_post_type( $post->ID ); ?>-<?php the_ID(); ?>" <?php post_class( apply_filters( 'pxjn_post_class', 'pxjn-post-class' )); ?>>

	<?php
	
		/* check whether this is a singular post or page view */
		if( is_singular() ) {
			
			/* show the title with no link to post permalink as we are already there */
			echo '<h1 class="post-title">' . get_the_title() . '</h1>';
			
		/* this page is not singular, perhaps are archive etc. */
		} else {
			
			/* show the title with a link to the permalinks page */
			echo '<h2 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			
		}
	
	?>
	
	<div class="entry-content">
	
		<?php
		
			/* check whether this is an archive page */
			if( is_archive() ) {
				
				/* lets show the excerpt for each post */ ?>
				<?php the_excerpt(); ?>
				
			<?php } else {
				
				/* this is not an archive so show the full post content */ ?>
				<?php the_content(); ?>
				
			<?php }
		
		?>
	
	</div><!-- // entry-content -->

</div><!-- // post-class -->