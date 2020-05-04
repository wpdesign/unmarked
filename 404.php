<?php
/**
 * The template for displaying 404 pages (not found).
 */
 
get_header(); ?>

<div class="wrapper" id="404-wrapper">
    
    <div id="content" class="container-fluid">
       
            <div id="primary" class="content-area row justify-content-center">

                <main id="main" class="site-main col-md-12 col-lg-8">

                    <section class="error-404 not-found">
                        
                        <header class="page-header">
                            <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'unmarked' ); ?></h1>							
                        </header>

                        <div class="page-content">
						
                            <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'unmarked' ); ?></p>

                            <?php get_search_form(); ?>

                            <div class="m-y-1">
								<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
							</div>

                            <?php if ( unmarked_categorized_blog() ) : ?>
                                <div class="widget widget_categories m-y-1">
                                    <h2 class="widget-title"><?php _e( 'Most Used Categories', 'unmarked' ); ?></h2>

                                    <ul class="list-inline">
										<?php
											wp_list_categories( array(
												'orderby'    => 'count',
												'order'      => 'DESC',
												'show_count' => 1,
												'title_li'   => '',
												'number'     => 10,
											) );
										?>
                                    </ul>

                                </div>
                            <?php endif; ?>

							<div class="m-y-1">
								<?php
									$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'unmarked' ), convert_smilies( ':)' ) ) . '</p>';
									the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
								?>
							</div>

							<div class="m-y-1">
								<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
							</div>

                        </div><!-- .page-content -->
                        
                    </section><!-- .error-404 -->

                </main><!-- #main -->
                
            </div><!-- #primary -->
      
    </div><!-- .container-fluid -->
    
</div><!-- .wrapper -->

<?php get_footer(); ?>