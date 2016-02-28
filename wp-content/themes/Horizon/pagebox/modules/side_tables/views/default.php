<?php
/**
 * Tables view
 */
?>

<div class="container <?php echo $this->get('css_class'); ?>">
	<div class="tabs">
		<div class="row">
			<div class="head">
				<?php
				$tabSlug = ['first','second', 'third', 'fourth'];
				$active = false;
				foreach( $tabSlug as $tab ):
					if( $this->get( $tab.'_tab_title' )): ?>

						<div id="<?php echo $tab; ?>" class="title col-md-3 col-sm-3 col-xs-12 <?php echo ((!$active) ? 'active' : '') .' '.$this->get( $tab.'_tab_slug' )?>">
							<h2><?php echo $this->get( $tab.'_tab_title' ) ;?></h2>
						</div>

						<?php
						if(!$active):
							$active = true;
						endif; // !$active
					endif; // $this->get( $tab.'_tab_title' )
				endforeach; // $tabSlug as $tab
				?>

				<div class="navigation-arrows">
					<img class="arrow navigation-up" src="<?php echo get_template_directory_uri(); ?>/assets/images/upArrow.svg" alt="">
					<img class="arrow navigation-down" src="<?php echo get_template_directory_uri(); ?>/assets/images/downArrow.svg" alt="">
				</div>
			</div>


			<div class="content first active">

				<?php if(!empty($this->get( 'first_tab_content' ))): ?>

				<div class="top">
					<?php echo $this->get( 'first_tab_content' ) ;?>
				</div>

				<?php endif;
					$sub_nav = $this->get( 'first_sub_nav' );
					if ($sub_nav):


				foreach( $sub_nav as $i => $sub ):
				if(!empty($sub->sub) && !empty($sub->content)): ?>

				<div class="left col-md-8">
					<div class="sub-menu clearfix">
						<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
							<?php echo $sub->sub ;?>
						</div>

						<?php foreach ( $sub_nav as $i => $cont ):
							if(!empty($cont->sub) && !empty($cont->content)): ?>

							<div class="content sub-content single-<?php echo $i ;?>">
								<?php echo $cont->content ;?>
							</div>

						<?php endif; // !empty($cont->sub) && !empty($cont->content)
						endforeach; // $sub_nav as $i => $cont ?>

					</div>
				</div>

			<?php endif; // $sub_nav
			endforeach; // $sub_nav as $i => $sub
			endif; // !empty($sub->sub) && !empty($sub->content)

				foreach ( $sub_nav as $i => $side ):
					if(!empty($side->sub) && !empty($side->content) && !empty($side->sidebar)): ?>
						<div class="sidebar col-md-4 single-<?php echo $i ;?>">
							<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
							<?php echo ($side->sidebar) ? $side->sidebar : ''?>
						</div>
					<?php endif;
				endforeach; ?>

			</div>


			<div class="content second">
				<div class="top">
					<?php echo $this->get( 'second_tab_content' ) ;?>
				</div>
				<?php
				$sub_nav = $this->get( 'second_sub_nav' );
				if ($sub_nav):
					?>
					<div class="left col-md-8">
						<div class="sub-menu clearfix">
							<?php
							foreach( $sub_nav as $i => $sub ):
								if(!empty($sub->sub) && !empty($sub->content)) :
									?>
									<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
										<?php echo $sub->sub ;?>
									</div>
									<?php
								endif;
							endforeach;
							foreach ( $sub_nav as $i => $cont ):
								if(!empty($cont->sub) && !empty($cont->content)) :
									?>
									<div class="content sub-content single-<?php echo $i ;?>">
										<?php echo $cont->content ;?>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>
					</div>
					<?php
					foreach ( $sub_nav as $i => $side ):
						if(!empty($side->sub) && !empty($side->content) && !empty($side->sidebar)) :
							?>
							<div class="sidebar col-md-4 single-<?php echo $i ;?>">
								<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
								<?php echo ($side->sidebar) ? $side->sidebar : '';?>
							</div>
							<?php
						endif;
					endforeach;
				endif;
				?>
			</div>



			<div class="content third">
				<div class="top">
					<?php echo $this->get( 'third_tab_content' ) ;?>
				</div>
				<?php
				$sub_nav = $this->get( 'third_sub_nav' );
				if ($sub_nav):
					?>
					<div class="left col-md-8">
						<div class="sub-menu clearfix">
							<?php
							foreach( $sub_nav as $i => $sub ):
								if(!empty($sub->sub) && !empty($sub->content)) :
									?>
									<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
										<?php echo $sub->sub ;?>
									</div>
									<?php
								endif;
							endforeach;
							foreach ( $sub_nav as $i => $cont ):
								if(!empty($cont->sub) && !empty($cont->content)) :
									?>
									<div class="content sub-content single-<?php echo $i ;?>">
										<?php echo $cont->content ;?>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>
					</div>
					<?php
					foreach ( $sub_nav as $i => $side ):
						if(!empty($side->sub) && !empty($side->content) && !empty($side->sidebar)) :
							?>
							<div class="sidebar col-md-4 single-<?php echo $i ;?>">
								<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
								<?php echo ($side->sidebar) ? $side->sidebar : ''?>
							</div>
							<?php
						endif;
					endforeach;
				endif;
				?>
			</div>



			<div class="content fourth">
				<div class="top">
					<?php echo $this->get( 'fourth_tab_content' ) ;?>
				</div>
				<?php
				$sub_nav = $this->get( 'fourth_sub_nav' );
				if ($sub_nav):
					?>
					<div class="left col-md-8">
						<div class="sub-menu clearfix">
							<?php
							foreach( $sub_nav as $i => $sub ):
								if(!empty($sub->sub) && !empty($sub->content)) :
									?>
									<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
										<?php echo $sub->sub ;?>
									</div>
									<?php
								endif;
							endforeach;
							foreach ( $sub_nav as $i => $cont ):
								if(!empty($cont->sub) && !empty($cont->content)) :
									?>
									<div class="content sub-content single-<?php echo $i ;?>">
										<?php echo $cont->content ;?>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>
					</div>
					<?php
					foreach ( $sub_nav as $i => $side ):
						if(!empty($side->sub) && !empty($side->content) && !empty($side->sidebar)) :
							?>
							<div class="sidebar col-md-4 single-<?php echo $i ;?>">
								<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
								<?php echo ($side->sidebar) ? $side->sidebar : ''?>
							</div>
							<?php
						endif;
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</div>