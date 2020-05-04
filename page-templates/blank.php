<?php
/**
 * Template Name: Blank
 *
 * Template for displaying a full width content.
 */

get_header(); ?>

<div class="wrapper-blank" id="full-width-page-wrapper">
    
    <div id="content" class="container-blank">

	    <div id="primary-blank" class="content-area">

            <main id="main" class="site-main">

                <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="entry-content">
							
								<?php the_content(); ?>
								
								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'unmarked' ),
										'after'  => '</div>',
									) );
								?>

							</div>

						</article>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->
           
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>