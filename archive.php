<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">
    
    <div id="content" class="container-fluid">
	
        <div class="row">
        
    	    <div id="primary" class="col-md-12 col-lg-8 content-area">
               
				<main id="main" class="site-main" role="main">
				
					<?php unmarked_breadcrumbs(); ?>

                      <?php if ( have_posts() ) : ?>

                        <header class="page-header">
                            <?php
                                the_archive_title( '<h1 class="entry-title">', '</h1>' );
                                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                            ?>
                        </header><!-- .page-header -->

                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
								<header class="entry-header">
									
									<?php the_title( sprintf( '<h2 class="archive-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

										<div class="entry-meta">
											<?php unmarked_posted_on(); ?>
										</div><!-- .entry-meta -->
						
								</header><!-- .entry-header -->

								   <?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail' ) ); ?> 
								
									<section class="entry-content">

										<?php the_excerpt(); ?>

										<?php
											wp_link_pages( array(
												'before' => '<div class="page-links">' . __( 'Pages:', 'unmarked' ),
												'after'  => '</div>',
											) );
										?>
										
									</section><!-- .entry-content -->

								<footer class="entry-footer">

									<?php //unmarked_entry_footer(); ?>
									
								</footer><!-- .entry-footer -->
								
							</article><!-- #post-## -->

                        <?php endwhile; ?>

                            <?php unmarked_paging_nav(); ?>

                        <?php else : ?>

                            <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                        <?php endif; ?>

				</main><!-- #main -->
               
    	    </div><!-- #primary -->

			<?php get_sidebar(); ?>

    </div> <!-- .row -->
        
    </div><!-- .container-fluid -->
    
</div><!-- .wrapper -->

<?php get_footer(); ?>