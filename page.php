<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<div class="wrapper" id="page-wrapper">
  
    <div id="content" class="container-fluid">
	
        <div class="content row">
        
    	   <div id="primary" class="col-md-12 col-lg-8 content-area">
           
                 <main id="main" class="site-main">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title page-title">', '</h1>' ); ?>
							</header>

							<?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail' ) ); ?> 
    
							<section class="entry-content">
								<?php the_content( ); ?>
								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'unmarked' ),
										'after'  => '</div>',
									) );
								?>
							</section>
							
						</article>

                    <?php endwhile; // end of the loop. ?>
					
                </main><!-- #main -->
               
    	    </div><!-- #primary -->
            
            <?php get_sidebar(); ?>

        </div><!-- .content .row -->
        
    </div><!-- .container-fluid -->
    
</div><!-- .wrapper -->

<?php get_footer(); ?>