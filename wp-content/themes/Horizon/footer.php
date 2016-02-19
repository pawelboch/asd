			</div>
			<!-- /Content -->
			<!-- Footer -->
			<footer id="site-footer" role="contentinfo">
				<div class="container">
					<div class="col-md-12">
						<div class="footer-logo pull-sm-left">
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_footer.png" /></a>
						</div>
						<div class="footer-nav">
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
								<div class="social-media">
									<div class="header">
										Connect with us
									</div>
									<div class="media">
										<div class="facebook">
											<span></span> fb
										</div>
										<div class="twitter">
											<span></span> twitter
										</div>
										<div class="google">
											<span></span> google plus
										</div>
										<div class="youtube">
											<span></span> youtube
										</div>
									</div>
								</div>
							</nav>
						</div>
					</div>


				</div>
				<?php wp_footer(); ?>
			</footer>
			<!-- /Footer -->
		</body>
</html>