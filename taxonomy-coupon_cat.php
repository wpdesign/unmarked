<?php
/**
 * The template for displaying taxonomy coupons.
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">
    
    <div id="content" class="container-fluid">
	
		<div id="fullwidth" class="content-area">
		   
			<main id="main" class="site-main" role="main">
			
			<?php 
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			
			 $custom_args = array(
				'post_type' => 'coupons',
				'posts_per_page' => -1,
				'paged' => $paged
			);
				
			$custom_query = new WP_Query( $custom_args );
			
			if ( $custom_query->have_posts() ) : ?>

					<header class="page-header">
						<h1 class="entry-title">Best WordPress Deals and Coupons</h1>
						<div class="taxonomy-description entry-content"><p>This page contain the best WordPress Deals around the web. We have tested a lot of products during our work with WordPress since 2012. We know pros and cons of almost all WordPress barnds and here complied a list of products that you can use smoothly.</p></div>
					</header><!-- .page-header -->

					<div class="row">
						<?php /* Start the Loop */ ?>
						<?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
					
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
												<span class="view-deal get-deal">
													<a href="<?php echo get_post_meta( get_the_ID(), '_affiliate_link', true );?>">Get this Deal</a> &nbsp;<i class="fa fa-long-arrow-right"></i> 
												</span>
												<span class="view-deal">
													<a href="<?php the_permalink(); ?>">View this Deal</a> &nbsp;<i class="fa fa-long-arrow-right"></i> 
												</span>
											</div>
										</footer><!-- .entry-footer -->
									</div>
								
								</div> <!-- .wrapper-->
								
							</article><!-- #post-## -->
						<?php endwhile; ?>
					</div> <!-- .row-->

						<?php //wp_bootstrap_pagination(); ?>
						<?php custom_pagination($custom_query->max_num_pages,"",$paged); ?>
						
						<?php wp_reset_postdata(); ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

			</main><!-- #main -->
		   
		</div><!-- #primary -->
        
    </div><!-- .container-fluid -->
    
</div><!-- .wrapper -->

<?php get_footer(); ?>