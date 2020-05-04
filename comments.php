<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title"">
            <?php
				echo '<span class="comments-link"><i class="fa fa-comment" aria-hidden="true"></i> ';
                printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), '', 'unmarked' ),
                    number_format_i18n( get_comments_number() ) );
				echo '</span>';
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'unmarked' ); ?></h1>
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'unmarked' ) ); ?></div>
				<?php }
                     if ( get_next_comments_link() ) { ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'unmarked' ) ); ?></div>
				<?php } ?>
			</nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation ?>

        <ol class="comment-list" id="">
		   <?php
			wp_list_comments( array(
			  'style'             => 'ol',
			  'short_ping'        => true,
			  'avatar_size'       => 60,
			  'callback'          => '',
			  'type'              => 'all',
			  'reply_text'        => __('Reply', 'unmarked'),
			  'page'              => '',
			  'per_page'          => '',
			  'reverse_top_level' => null,
			  'reverse_children'  => ''
			) );
		  ?>
        </ol><!-- .comment-list -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'unmarked' ); ?></h1>
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'unmarked' ) ); ?></div>
				<?php }
					 if ( get_next_comments_link() ) { ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'unmarked' ) ); ?></div>
				<?php } ?>
			</nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'unmarked' ); ?></p>
    <?php endif; ?>

	<?php
        /* Loads the comment-form.php template
        /* get_template_part('comment-form');
        */
    ?>

    <?php comment_form(array( 'comment_notes_before' => '')); ?>

</div><!-- #comments -->