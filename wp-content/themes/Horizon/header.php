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
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!-- Header -->
		<header class="banner-header" role="banner">
			<div class="top-header">
				<div class="container">
					<div class="logo col-md-4 col-sm-8 col-xs-8">
						<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/horizon_logo.svg" /></a>
					</div>
					<div class="main-nav col-md-8 hidden-sm-down">
						<nav role="navigation" class="nav-main">
							<?php
							wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => false,
									'menu_class' => 'nav',
									'menu_id' => 'nav'
								)
							);
							?>
						</nav>
					</div>
					<div class="nav-toggle hidden-md-up pull-right col-sm-4 col-xs-4">
						<div class="icon-bar"></div>
						<div class="icon-bar"></div>
						<div class="icon-bar"></div>
					</div>
				</div>
			</div>
		</header>
		<!-- /Header -->
		<!-- Content -->
		<div class="content">