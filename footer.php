<?php
/**
 * The template for displaying the footer.
 */
?>

<footer id="wrapper-footer" class="site-footer">

	<div class="container-fluid">

		<?php if ( is_active_sidebar( 'footer-left' ) || is_active_sidebar( 'footer-center' ) || is_active_sidebar( 'footer-right' ) ) : ?>
			<div class="footer-widgets row justify-content-between">
				<?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
					<div class="col-12 col-sm-6 col-md-4 widget-area">
						<?php dynamic_sidebar( 'footer-left' ); ?>
					</div>
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'footer-center' ) ) : ?>				
					<div class="col-12 col-sm-5 offset-sm-1 offset-md-0 col-md-3 widget-area">
						<?php dynamic_sidebar( 'footer-center' ); ?>						
					</div>							
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'footer-right' ) ) : ?>				
					<div class="col-12 col-sm-6 col-md-3 widget-area">
						<?php dynamic_sidebar( 'footer-right' ); ?>						
					</div>							
				<?php endif; ?>
				
				<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>				
					<div class="col-12 col-sm-5 offset-sm-1 offset-md-0 col-md-2 widget-area">
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>						
					</div>							
				<?php endif; ?>
				
			</div><!-- .footer-widgets-->
		<?php endif; //end widget check ?>
		
	</div><!-- .container-fluid -->
	
	
	<div class="site-info-wrapper">
		<div class="container-fluid">
			<div class="row justify-content-between">
			
				<div class="col-12 col-sm-auto">
					<div class="copyright">© Copyright <?php echo date("Y"); echo " "; echo bloginfo('name'); ?> ® All Rights Reserved.</div>
				</div>

				<div class="col-12 col-sm-auto">
					<div class="footer-menu">
						<nav class="nav-footer">
							<div class="menu-footer-container">
								<ul id="menu-footer" class="menu genesis-nav-menu menu-footer">
									<li><a href="/about/" itemprop="url">About</a></li>
									<!--<li><a href="/advertising/" itemprop="url">Advertise</a></li>-->
									<li><a href="/contact/" itemprop="url">Contact</a></li>
									<li><a href="/terms-conditions/" itemprop="url">Site Terms</a></li>
									<li><a href="/disclosure" itemprop="url">Disclosure</a></li>
									<li><a href="/privacy-policy/" itemprop="url">Privacy Policy</a></li>
								</ul>
							</div>          
						</nav>
					</div>
				</div>
				
			</div><!-- .row-->
		</div>
	</div>

</footer><!-- #wrapper-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>