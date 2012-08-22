<?php

/* theme hooks are defined below */

/* usually used before the sites header tag */
function pxjn_before_header() {
	do_action( 'pxjn_before_header' );
}

/* usually used after the sites closing header tag */
function pxjn_after_header() {
	do_action( 'pxjn_after_header' );
}

/* usually used before the posts loop begins */
function pxjn_before_loop() {
	do_action( 'pxjn_before_loop' );
}

/* usually used after the posts loop begins */
function pxjn_after_loop() {
	do_action( 'pxjn_after_loop' );
}

/* usually used before the post is displayed but inside the post_class */
function pxjn_before_post() {
	do_action( 'pxjn_before_post' );
}

/* usually used after the post is displayed but inside the post_class */
function pxjn_after_post() {
	do_action( 'pxjn_after_post' );
}

/* usually used before the post entry is displayed i.e. the_content */
function pxjn_before_post_entry() {
	do_action( 'pxjn_before_post_entry' );
}

/* usually used after the post entry is displayed i.e. the_content */
function pxjn_after_post_entry() {
	do_action( 'pxjn_after_post_entry' );
}

/* usually used before the footer is displayed just before the opening footer tag */
function pxjn_before_footer() {
	do_action( 'pxjn_before_footer' );
}

/* usually used after the footer is displayed just after the closing footer tag */
function pxjn_after_footer() {
	do_action( 'pxjn_after_footer' );
}

?>