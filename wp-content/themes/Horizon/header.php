<!DOCTYPE html>
	<head>
		<meta charset="UTF-8">
		<meta content="index, follow" name="robots">
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta name="viewport" content="width=device-width">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/vendor/css3pie/PIE.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/vendor/respond/dest/respond.min.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!-- Header -->
		<header class="banner-header" role="banner">
			<div class="top-header">
				<div class="container">
					<div class="logo col-md-4">
						<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" /></a>
					</div>
					<div class="main-nav col-md-8">
						<nav role="navigation" class="nav-main hidden-sm-down">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => false,
									'menu_class' => 'nav',
									'menu_id' => 'nav',
								)
							);
							?>
						</nav>
					</div>
					<!-- <button class="nav-toggle visible-xs" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> -->
				</div>
			</div>
		</header>
		<!-- /Header -->
		<!-- Content -->
		<div class="content">
			<?php pagebox() ;?>