<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 */

if ( ! function_exists( 'unmarked_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function unmarked_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'unmarked' ); ?></h1>
		<div class="nav-links">
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'unmarked' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'unmarked' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'unmarked_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function unmarked_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav"><i class="fa fa-angle-right" aria-hidden="true"></i></span>', 'Previous post link', 'unmarked' ) );
				next_post_link(     '<div class="nav-next">%link</div>', _x( '<span class="meta-nav"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', 'Next post link', 'unmarked' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


/**
 * Functions below are added from _s theme.
 */

if ( ! function_exists( 'unmarked_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function unmarked_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'unmarked' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'unmarked' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on"><i class="fa fa-calendar" aria-hidden="true"></i> ' . $posted_on . '</span><span class="byline"><i class="fa fa-user" aria-hidden="true"></i> ' . $byline . '</span>'; // WPCS: XSS OK.
	
	if ( get_comments_number() ) {
		echo '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> ';
			echo '<a href="' .get_comments_link(). '">';comments_number( 'no responses', 'one Comment', '% Comments' ); echo'</a>';
		echo '</span>';
		
	} 
	elseif ( ! post_password_required() && ( comments_open() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> ';
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment', 'unmarked' ), array( 'span' => array( 'class' => array() ) ) ) ) );
		echo '</span>';
	}
	

}
endif;

if ( ! function_exists( 'unmarked_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function unmarked_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'unmarked' ) );
		if ( $categories_list && unmarked_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder" aria-hidden="true"></i> ' . esc_html__( '%1$s', 'unmarked' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'unmarked' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i> ' . esc_html__( '%1$s', 'unmarked' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function unmarked_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'unmarked_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'unmarked_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so unmarked_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so unmarked_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in unmarked_categorized_blog.
 */
function unmarked_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'unmarked_categories' );
}
add_action( 'edit_category', 'unmarked_category_transient_flusher' );
add_action( 'save_post',     'unmarked_category_transient_flusher' );