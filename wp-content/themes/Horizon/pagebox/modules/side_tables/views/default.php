<?php
/**
 * Tables view
 */
?>

<div class="container <?php echo $this->get('css_class'); ?>">
	<div class="tabs">
		<div class="row">
			<div class="head">
				<div id="first" class="title col-md-3 col-sm-3 col-xs-12 active">
					<h2><?php echo $this->get( 'first_tab_title' ) ;?></h2>
				</div>
				<div id="second" class="title col-md-3 col-sm-3 col-xs-12">
					<h2><?php echo $this->get( 'second_tab_title' ) ;?></h2>
				</div>
				<div id="third" class="title col-md-3 col-sm-3 col-xs-12">
					<h2><?php echo $this->get( 'third_tab_title' ) ;?></h2>
				</div>
				<div id="fourth" class="title col-md-3 col-sm-3 col-xs-12">
					<h2><?php echo $this->get( 'fourth_tab_title' ) ;?></h2>
				</div>
				<div class="navigation-arrows">
					<img class="arrow navigation-up" src="<?php echo get_template_directory_uri(); ?>/assets/images/upArrow.svg" alt="">
					<img class="arrow navigation-down" src="<?php echo get_template_directory_uri(); ?>/assets/images/downArrow.svg" alt="">
				</div>
			</div>


			<div class="content first active">
				<div class="top">
					<?php echo $this->get( 'first_tab_content' ) ;?>
				</div>
				<div class="left col-md-8">
					<div class="sub-menu clearfix">
						<?php $sub_nav = $this->get( 'first_sub_nav' );
						foreach( $sub_nav as $i => $sub ): ?>
							<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
								<?php echo $sub->sub ;?>
							</div>
						<?php endforeach ;?>

						<?php $content = $this->get( 'first_sub_nav' );
						foreach ( $content as $i => $cont ): ?>
							<div class="content single-<?php echo $i ;?>">
								<?php echo $cont->content ;?>
							</div>
						<?php endforeach ;?>
					</div>
				</div>

				<div class="sidebar col-md-4">
					<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
					<?php echo $this->get( 'first_sidebar' ) ;?>
				</div>
			</div>


			<div class="content second">
				<div class="top">
					<?php echo $this->get( 'second_tab_content' ) ;?>
				</div>
				<div class="left col-md-8">
					<div class="sub-menu clearfix">
						<?php $sub_nav = $this->get( 'second_sub_nav' );
						foreach( $sub_nav as $i => $sub ): ?>
							<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
								<?php echo $sub->sub ;?>
							</div>
						<?php endforeach ;?>

						<?php $content = $this->get( 'second_sub_nav' );
						foreach ( $content as $i => $cont ): ?>
							<div class="content single-<?php echo $i ;?>">
								<?php echo $cont->content ;?>
							</div>
						<?php endforeach ;?>
					</div>
				</div>

				<div class="sidebar col-md-4">
					<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
					<?php echo $this->get( 'second_sidebar' ) ;?>
				</div>
			</div>



			<div class="content third">
				<div class="top">
					<?php echo $this->get( 'third_tab_content' ) ;?>
				</div>
				<div class="left col-md-8">
					<div class="sub-menu clearfix">
						<?php $sub_nav = $this->get( 'third_sub_nav' );
						foreach( $sub_nav as $i => $sub ): ?>
							<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
								<?php echo $sub->sub ;?>
							</div>
						<?php endforeach ;?>

						<?php $content = $this->get( 'third_sub_nav' );
						foreach ( $content as $i => $cont ): ?>
							<div class="content single-<?php echo $i ;?>">
								<?php echo $cont->content ;?>
							</div>
						<?php endforeach ;?>
					</div>
				</div>

				<div class="sidebar col-md-4">
					<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
					<?php echo $this->get( 'third_sidebar' ) ;?>
				</div>
			</div>



			<div class="content fourth">
				<div class="top">
					<?php echo $this->get( 'fourth_tab_content' ) ;?>
				</div>
				<div class="left col-md-8">
					<div class="sub-menu clearfix">
						<?php $sub_nav = $this->get( 'fourth_sub_nav' );
						foreach( $sub_nav as $i => $sub ): ?>
							<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
								<?php echo $sub->sub ;?>
							</div>
						<?php endforeach ;?>

						<?php $content = $this->get( 'fourth_sub_nav' );
						foreach ( $content as $i => $cont ): ?>
							<div class="content single-<?php echo $i ;?>">
								<?php echo $cont->content ;?>
							</div>
						<?php endforeach ;?>
					</div>
				</div>

				<div class="sidebar col-md-4">
					<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
					<?php echo $this->get( 'fourth_sidebar' ) ;?>
				</div>
			</div>
			
			
		</div>
	</div>
</div>

