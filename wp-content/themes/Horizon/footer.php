			</div>
			<!-- /Content -->
			<!-- Footer -->
			<footer id="site-footer" role="contentinfo">
				<div class="container">
					<div class="col-md-12">
						<div class="row">
							<div class="footer-logo pull-sm-left col-md-2 col-xs-12">
								<div class="row">
									<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/horizon_logo.svg" /></a>
								</div>
							</div>
							<div class="footer-nav col-md-10 col-xs-12">
								<div class="row">
									<nav role="navigation" class="nav-footer pull-md-left">
										<?php
										wp_nav_menu( array(
												'theme_location' => 'footer',
												'container' => false,
												'menu_class' => 'nav-footer',
												'menu_id' => 'nav-footer',
											)
										);
										?>

									</nav>
								</div>
							</div> <!-- /footer-nav -->
						</div>
					</div>
				</div> <!-- /container -->
				<div class="rights">
					<div class="container">
						© 2015 Horizon Investments, LLC. All Rights Reserved.
					</div>
				</div>
				<?php wp_footer(); ?>
			</footer>
			<!-- /Footer -->
		</body>
</html>