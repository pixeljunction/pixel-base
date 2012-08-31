<?php

/* functions specific to this framework to give additional functionality on the front end */

/* adds content of a custom field with meta key 'pxjn_postclass' into the post_class function */
	/* Filter the post class hook with our custom post class function. */
	add_filter( 'post_class', 'pxjn_post_class' );
	
	/* create our post class function */
	if ( ! function_exists( 'pxjn_post_class' ) ) { // check it doesn't exist in child theme
		function pxjn_post_class( $pxjn_classes ) {
		
			/* Get the current post ID. */
			$pxjn_post_id = get_the_ID();
			
			/* If we have a post ID, proceed. */
			if ( !empty( $pxjn_post_id ) ) {
			
				/* Get the custom post class. */
				$pxjn_post_class_raw = get_post_meta( $pxjn_post_id, 'pxjn_postclass', true );
				
				/* force the custom field to be lower case. */
				$pxjn_post_class = strtolower($pxjn_post_class_raw);
				
				/* If a post class was input, sanitize it and add it to the post class array. */
				if ( !empty( $pxjn_post_class ) )
					$pxjn_classes[] = sanitize_html_class( $pxjn_post_class );
			}
			return $pxjn_classes;
		}
	}

/* pxjn comments function */
	if ( ! function_exists( 'pxjn_comments' ) ) { // check it doesn't exist in child theme
		function pxjn_comments( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;
			switch ( $comment->comment_type ) :
				case '' :
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>">
	                <div class="comment-author vcard">
	                    <?php echo get_avatar( $comment, 40 ); ?>
	                    <?php printf( __( '%s <span class="says">says:</span>', 'pj' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
	                </div><!-- .comment-author .vcard -->
	                <?php if ( $comment->comment_approved == '0' ) : ?>
	                    <em><?php _e( 'Your comment is awaiting moderation.', 'pj' ); ?></em>
	                    <br />
	                <?php endif; ?>
	                <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
	                    <?php
	                        /* translators: 1: date, 2: time */
	                        printf( __( '%1$s at %2$s', 'pj' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'pj' ), ' ' );
	                    ?>
	                </div><!-- .comment-meta .commentmetadata -->
	                <div class="comment-body"><?php comment_text(); ?></div>
	                <div class="reply">
	                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	                </div><!-- .reply -->
	            </div><!-- #comment-##  -->
			<?php
					break;
				case 'pingback'  :
				case 'trackback' :
			?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'pj' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'pj'), ' ' ); ?></p>
			<?php
					break;
			endswitch;
		}
	}

/* multiple page post navigation function (taken from the twentyeleven theme) */
	if ( ! function_exists( 'pxjn_content_nav' ) ) { // check it doesn't exist in child theme
		function pxjn_content_nav() {
			global $wp_query;
			
			/* if the maximum pages we have in our query is more than 1 */
			if ( $wp_query->max_num_pages > 1 ) {
			
				/* setup our content nav output stored as variable */
				$pxjn_content_nav_output = '<div class="navigation">';
					$pxjn_content_nav_output .= '<div class="nav-alignleft">' . next_posts_link('&laquo; Older Entries') . '</div><div class="nav-alignright">' . previous_posts_link('Newer Entries &raquo;') . '</div>';
				$pxjn_content_nav_output .= '<div>';
				
				/* return our output, first running it through a filter so it can be changed in a plugin or child theme */
				return apply_filters( 'pxjn_content_nav_output', $pxjn_content_nav_output );
				
			}
		}
	}

/* get featured image url function */
	if ( ! function_exists( 'pxjn_featured_img_url' ) ) { // check it doesn't exist in child theme
		function pxjn_featured_img_url($pxjn_featured_img_size) {
			$pxjn_image_id = get_post_thumbnail_id();
			$pxjn_image_url = wp_get_attachment_image_src($pxjn_image_id,$pxjn_featured_img_size);
			$pxjn_image_url = $pxjn_image_url[0];
			return $pxjn_image_url;
		}
	}

/* get featured image caption */
	if ( ! function_exists( 'pxjn_featured_img_caption' ) ) { // check it doesn't exist in child theme
		function pxjn_featured_img_caption() {
			global $post;
			$pxjn_thumbnail_id = get_post_thumbnail_id($post->ID);
			$pxjn_thumbnail_image = get_posts(array('p' => $pxjn_thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any'));
			if ($pxjn_thumbnail_image && isset($pxjn_thumbnail_image[0])) {
				return '<p>'.$pxjn_thumbnail_image[0]->post_excerpt.'</p>';
			}
		}
	}

/* get featured image title */
	if ( ! function_exists( 'pxjn_featured_img_title' ) ) { // check it doesn't exist in child theme
		function pxjn_featured_img_title() {
			global $post;
			$pxjn_thumbnail_id = get_post_thumbnail_id($post->ID);
			$pxjn_thumbnail_image = get_posts(array('p' => $pxjn_thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any'));
			if ($pxjn_thumbnail_image && isset($pxjn_thumbnail_image[0])) {
				return '<span class="featured-image-title">'.$pxjn_thumbnail_image[0]->post_title.'</h2>';
			}
		}
	}

/* custom search form function to work with get_search_form */
	function pxjn_search_form( $pxjn_form ) {
	    $pxjn_form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	    <label class="screen-reader-text" for="s">' . __('Search for:', 'pxjn') . '</label>
	    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
	    <input type="image" src="' . get_stylesheet_directory_uri() . '/images/search-icon.png" id="search-button" value="'. esc_attr__('Search') .'" />
	    </form>';
	    return $pxjn_form;
	}
	add_filter( 'get_search_form', 'pxjn_search_form' );

?>