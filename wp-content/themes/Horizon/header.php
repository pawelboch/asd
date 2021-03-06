<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta content="index, follow" name="robots">
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!-- Header -->
		<header class="banner-header" role="banner">
			<div class="top-header">
				<div class="container">
					<div class="row">
						<div class="logo">
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/header_logo.svg" /></a>
						</div>
						<div class="navigation">
							<div class="main-nav hidden-md-down">
								<nav role="navigation" class="nav-main">
									<?php
									//$walker = new Menu_With_Description;
									wp_nav_menu( array(
											'theme_location' => 'primary',
											'container' => false,
											'menu_class' => 'nav',
											'menu_id' => 'nav',
											//'walker' => $walker
											// Walker disabled also in function.php
										)
									);
									?>
								</nav>
							</div> <!-- main-nav -->
						</div> <!-- navigation -->
						<div class="mobile-nav hidden-lg-up">
							<div class="nav-toggle">
								<div class="separator">
									<div class="icon-bar"></div>
									<div class="icon-bar"></div>
									<div class="icon-bar"></div>
								</div>
							</div>
						</div>
						<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div class="search">
								<span class="search-ico"></span>
								<div class="search-input-cont">
									<input class="search-input" placeholder="Search..." name="s" id="s"> </input>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</header>
		<!-- /Header -->
		<!-- Content -->
		<div class="content">