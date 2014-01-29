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
				
		<section class="error-404 not-found">
			
			<header class="page-header">
			
				<h1 class="page-title">Oops! That page cannot be found</h1>
				
			</header><!-- page-header -->
			
			<article class="post-404">
			
				<p>It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>

				<?php get_search_form(); ?>
			
			</article>
	
	</main><!-- content -->
	
	<?php
	
		/* get the sidebar for this template */
		get_sidebar( '404' );
	
	?>
	
	<div class="clearfix"></div>

<?php

/* get the footer template file */
get_footer();

?>