			</div>
			<!-- /Content -->
			<!-- Footer -->
			<footer id="site-footer" role="contentinfo">
				<div class="container">
					<div class="footer-nav">
						<nav role="navigation" class="nav-footer">
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
				</div>
				<?php wp_footer(); ?>
			</footer>
			<!-- /Footer -->
		</body>
</html>