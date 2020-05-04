<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

<div class="wrapper" id="single-wrapper">
    
    <div  id="content" class="container-fluid">
	
        <div class="content row">
        
            <div id="fullwidth" class="col-12 content-area">
			
                <main id="main" class="site-main">
				
					<?php unmarked_breadcrumbs(); ?>
				
                    <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="row">
								<div class="coupon-thumbnail col-12 col-sm-3">
									<?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail alignleft' ) ); ?>
								</div>

								<div class="col-12 col-sm-9">
									<header class="coupon-header">
										<h1 class="coupon-single-title"><?php $savecoupon = get_post_meta( get_the_ID(), '_save_coupon', true ); if ( ! empty( $savecoupon ) ) { echo '<span class="coupn-save">' .$savecoupon. '</span>'; } the_title() ?></h1>
										<span class="coupon_code_text_link">
											<a class="jclip-button" href="<?php echo get_post_meta( get_the_ID(), '_affiliate_link', true );?>"><?php echo get_post_meta( get_the_ID(), '_coupon_code', true );?></a>
										</span>
										<div class="coupon_code_button">
											<a class="jclip-button" target="_blank" href="<?php echo get_post_meta( get_the_ID(), '_affiliate_link', true );?>" data-clipboard-text="wpkube50">
												<span class="copy-scissors"><i class="fa fa-scissors"> </i></span> Click to copy the code and visit the site
											</a>
										</div>
									</header><!-- .entry-header -->
								</div>
							</div>
    
							<div class="entry-content">
								<?php the_content( ); ?>
							</div><!-- .entry-content -->
						</article><!-- #post -->

                    <?php endwhile; // end of the loop. ?>
					
					<!-- begin custom related loop, -->
					<div class="related-posts hidden-xs-down">
						<h3 class="h2">You Might Also Like...</h3>	
						<?php
							$coupon_terms = wp_get_object_terms( $post->ID, 'coupon_cat', array('fields' => 'ids') );
							$args = array(
							'post_type' => 'coupons',
							'post_status' => 'publish',
							'posts_per_page' => 3,
							'orderby' => 'rand',
							'tax_query' => array(
								array(
									'taxonomy' => 'coupon_cat',
									'field' => 'id',
									'terms' => $coupon_terms
								)
							),
							'post__not_in' => array ($post->ID),
							);
							$related_items = new WP_Query( $args );
							// loop over query
							if ($related_items->have_posts()) :
							echo '<div class="row">';
							while ( $related_items->have_posts() ) : $related_items->the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('coupon-entry col-12 col-cs-6 col-sm-6 col-md-4'); ?>>
							
								<div class="coupon-wrapper">
									<div class="coupon-thumbnail">
										<a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail( 'full', array( 'class' => 'img-thumbnail' ) ); ?></a>
									</div>
									
									<div class="coupon-content">
										<header class="entry-header">
											<?php the_title( sprintf( '<h2 class="coupon-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										</header>
										
										<div class="coupn-code"><?php echo get_post_meta( get_the_ID(), '_coupon_code', true );?></div>

										<section class="entry-content">
											<?php echo get_excerpt(); ?>
										</section><!-- .entry-content -->

										<footer class="entry-footer">
											<div class="footer-coupon">
												<span class="entry-terms">
													<?php								
													$args = array( 'hide_empty=0' );
													 
													$terms = get_terms( 'coupon_cat', $args );
													if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
														$count = count( $terms );
														$i = 0;
														$term_list = '';
														foreach ( $terms as $term ) {
															$i++;
															$term_list .= '<a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( '%s' ), $term->name ) ) . '">' . $term->name . '</a>';
															if ( $count != $i ) {
																$term_list .= ' &middot; ';
															}
															else {
																$term_list .= '';
															}
														}
														echo $term_list;
													}
													?>
												</span>
												<span class="view-deal view_deal_related">
													<a href="<?php the_permalink(); ?>">View this Deal</a> &nbsp;<i class="fa fa-long-arrow-right"></i> 
												</span>
											</div>
										</footer><!-- .entry-footer -->
									</div>
								
								</div> <!-- .wrapper-->
								
							</article><!-- #post-## -->
						<?php endwhile; 
						echo '</div>'; 
						endif; 
						wp_reset_postdata(); ?>
					</div>
					<!-- end custom related loop, -->

                </main><!-- #main -->

            </div><!-- #primary -->
        
        </div><!-- .row -->
        
    </div><!-- .container-fluid -->
	 
</div><!-- .wrapper -->

<?php get_footer(); ?>