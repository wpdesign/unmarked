<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

<div class="wrapper" id="single-wrapper">
    
    <div  id="content" class="container-fluid">
	
        <div class="content row">
        
            <div id="primary" class="col-md-12 col-lg-8 content-area">
			
                <main id="main" class="site-main">
				
					<?php unmarked_breadcrumbs(); ?>
				
                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

								<div class="entry-meta">
									<?php unmarked_posted_on(); ?>
								</div><!-- .entry-meta -->
							</header><!-- .entry-header -->

							<?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail' ) ); ?>						
    
							<div class="entry-content">
								<?php the_content( ); ?>
								
								<!--
								<div class="services">
									<span class="service-or">If you need our service</span>
									<div class="info-btn"><a href="http://localhost/unmarked/coupons/dsdsdsd/">Order WooCommerce Customization</a></div>
								</div>
								-->
								
								
								<?php echo do_shortcode('[ssba]'); ?>
								
								<?php if(function_exists('related_posts')) { 
									related_posts(); 
								} ?>
											
							</div><!-- .entry-content -->
				
								<?php 
								$coupons = get_field('_related_category');
								if ($coupons) {
									echo '<div class="related-posts hidden-xs-down">
											<h3 class="h2">Related Products:</h3>';
								  if (!is_array($coupons)) {
									$coupons = array($coupons);
								  }
								  $args = array(
									'post_type' => 'coupons',
									'posts_per_page' => 3,
									'orderby' => 'rand',
									'tax_query' => array(
									  array(
										'taxonomy' => 'coupon_cat',
										'terms' => $coupons,
									  ),
									),
								  );
								  $coupon_query = new WP_Query($args);
								  if ($coupon_query->have_posts()) {
									echo '<div class="row">';
									while($coupon_query->have_posts()) {
									  $coupon_query->the_post(); ?>
									  <div class="col-12 col-sm-4">
											<div class="featured-thumbnail">
												<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail' ) ); ?></a>
											</div>
											<div class="related-content">
												<header>
													<h2 class="widget-title"><a href="<?php the_permalink() ?>"><?php the_title( ); ?></a></h2>
													<div class="deal"><?php echo get_post_meta( get_the_ID(), '_save_coupon', true );?></div>
												</header>
												<div class="excerpt">
													<?php echo get_excerpt(); ?>                     
												</div>
												<div class="info-btn">
													<a href="<?php the_permalink() ?>">Get This Deal</a>
												</div>
											</div>
										</div>
									<?php
									}
									echo '</div>';
								  }
								  wp_reset_postdata();
								  echo '</div>';
								}
								?>	

						</article><!-- #post -->

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>
                        
                    <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->

            </div><!-- #primary -->
        
        <?php get_sidebar(); ?>

        </div><!-- .row -->
        
    </div><!-- .container-fluid -->
	 
</div><!-- .wrapper -->

<?php get_footer(); ?>