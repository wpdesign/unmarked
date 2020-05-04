<?php
/**
 * Template Name: Full Width
 *
 * Template for displaying a full width content.
 *
 * You can copy the template and easily create 
 *
 * your own custom layout by changing mark-up only.
 */

get_header(); ?>

<div class="wrapper" id="full-width-page-wrapper">
    
    <div id="content" class="container-fluid">
	
			<?php  
				/* unmarked_breadcrumbs first checks if yoast_breadcrumb exists
				* It supports custom post type and custom taxonomy.
				* If you have any custom taxonomy change the cat name in inc > function > breadcrumbs.php
				*/
				unmarked_breadcrumbs(); 
			?>
        
	    <div id="primary" class="content-area">

            <main id="main" class="site-main">

                <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<header class="entry-header">

								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							</header><!-- .entry-header -->

							<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
    
							<div class="entry-content">

								<?php the_content(); ?>

								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'unmarked' ),
										'after'  => '</div>',
									) );
								?>

							</div><!-- .entry-content -->

							<footer class="entry-footer">

								<?php edit_post_link( __( 'Edit', 'unmarked' ), '<span class="edit-link">', '</span>' ); ?>

							</footer><!-- .entry-footer -->

						</article><!-- #post-## -->

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :

                            comments_template();
                        
                        endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->
           
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>