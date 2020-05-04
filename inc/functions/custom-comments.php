<?php
/**
 * Comment layout.
 *
 * @package understrap
 */

// Comments form.
add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );

/**
 * Creates the comments form.
 *
 * @param string $fields Form fields.
 *
 * @return array
 */
function bootstrap3_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html5     = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
	$fields    = array(
		'author' => '<div class="row"><div class="col-sm-6"><div class="form-group comment-form-author">' .
		            '<input class="form-control" id="author" placeholder="Name *" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . '></div></div>',
		'email'  => '<div class="col-sm-6"><div class="form-group comment-form-email">' .
		            '<input class="form-control" id="email" placeholder="Email *" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . '></div></div></div>',
	);

	return $fields;
}

add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );

/**
 * Builds the form.
 *
 * @param string $args Arguments for form's fields.
 *
 * @return mixed
 */
function bootstrap3_comment_form( $args ) {
	$args['comment_field'] = '<div class="form-group comment-form-comment">
    <label for="comment">' . _x( 'Comment', 'noun', 'understrap' ) . ( ' <span class="required">*</span>' ) . '</label>
    <textarea class="form-control" id="comment" name="comment" aria-required="true" cols="45" rows="4"></textarea>
    </div>';
	$args['class_submit']  = 'btn btn-primary'; // since WP 4.1.
	return $args;
}