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

						<div id="<?php echo $tab; ?>" class="title col-xs-12 <?php echo ((!$active) ? 'active' : '') .' '.$this->get( $tab.'_tab_slug' )?>" data-hash="<?php echo $this->get( $tab.'_tab_slug' ); ?>">
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
				?>

				<?php
				if (count((array)$sub_nav) > 1 ):
				?>
				<div class="left col-md-12">
					<div class="sub-menu-tabs col-md-8">
				<?php
					foreach( $sub_nav as $i => $sub ):
						if(!empty($sub->sub)):
				?>

						<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
							<?php echo $sub->sub ;?>
						</div>
				<?php
						endif;
					endforeach;
				?>
					</div>
				<?php
					foreach( $sub_nav as $i => $sub ):
				?>
						<div class="left-inner <?php echo (empty($sub->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">

							<div class="sub-menu clearfix">
								<?php
									if(!empty($sub->sub) && !empty($sub->content)): ?>

									<div class="content sub-content single-<?php echo $i ;?>">
										<?php echo $sub->content ;?>
									</div>

								<?php
									endif; // !empty($cont->sub) && !empty($cont->content)
								?>

							</div>
						</div>
					<?php
							if(!empty($sub->sub) && !empty($sub->content) && !empty($sub->sidebar)): ?>
								<div class="sidebar col-md-4 single-<?php echo $i ;?>">
									<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
									<?php echo ($sub->sidebar) ? $sub->sidebar : ''?>
								</div>
							<?php endif;
					endforeach; // $sub_nav as $i => $sub
				?>
				 </div>
				<?php
				else:
					if(!(empty($sub_nav->{0}->sub) && empty($sub_nav->{0}->content))):
					?>
				<div class="left col-md-12">
				<?php
					if( $sub_nav ):
						if(!empty( $sub_nav->{0}->sub)): ?>
								<div class="sub-menu-tabs col-md-8">
									<div id="single-0" class="single-menu col-md-3 active">
										<?php echo $sub_nav->{0}->sub ;?>
									</div>
								</div>
							<?php
						endif;
				?>
						<div class="left-inner <?php echo (empty($sub_nav->{0}->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">
							<div class="sub-menu clearfix">
								<?php
									if(!empty($sub_nav->{0}->content)): ?>

											<div class="content sub-content single-0 active">
												<?php echo $sub_nav->{0}->content ;?>
											</div>

									<?php endif;// !empty($cont->sub) && !empty($cont->content)
								?>

							</div>
						</div>
				<?php
							if(!empty($sub_nav->{0}->sidebar)):
				?>
								<div class="sidebar col-md-4 single-0">
									<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
									<?php echo $sub_nav->{0}->sidebar; ?>
								</div>
							<?php endif;
					endif; ?>
				</div>
					<?php
					endif;
				endif; // !empty($sub->sub) && !empty($sub->content)
				?>

			</div>


			<div class="content second ">

				<?php if(!empty($this->get( 'second_tab_content' ))): ?>

					<div class="top">
						<?php echo $this->get( 'second_tab_content' ) ;?>
					</div>

				<?php endif;

				$sub_nav = $this->get( 'second_sub_nav' );
				?>

				<?php
				if (count((array)$sub_nav) > 1 ):
					?>
					<div class="left col-md-12">
						<div class="sub-menu-tabs col-md-8">
							<?php
							foreach( $sub_nav as $i => $sub ):
								if(!empty($sub->sub)):
									?>

									<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
										<?php echo $sub->sub ;?>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>
						<?php
						foreach( $sub_nav as $i => $sub ):
							?>
							<div class="left-inner <?php echo (empty($sub->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">

								<div class="sub-menu clearfix">
									<?php
									if(!empty($sub->sub) && !empty($sub->content)): ?>

										<div class="content sub-content single-<?php echo $i ;?>">
											<?php echo $sub->content ;?>
										</div>

										<?php
									endif; // !empty($cont->sub) && !empty($cont->content)
									?>

								</div>
							</div>
							<?php
							if(!empty($sub->sub) && !empty($sub->content) && !empty($sub->sidebar)): ?>
								<div class="sidebar col-md-4 single-<?php echo $i ;?>">
									<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
									<?php echo ($sub->sidebar) ? $sub->sidebar : ''?>
								</div>
							<?php endif;
						endforeach; // $sub_nav as $i => $sub
						?>
					</div>
					<?php
				else:
					if(!(empty($sub_nav->{0}->sub) && empty($sub_nav->{0}->content))):
						?>
						<div class="left col-md-12">
							<?php
							if( $sub_nav ):
								if(!empty( $sub_nav->{0}->sub)): ?>
									<div class="sub-menu-tabs col-md-8">
										<div id="single-0" class="single-menu col-md-3 active">
											<?php echo $sub_nav->{0}->sub ;?>
										</div>
									</div>
									<?php
								endif;
								?>
								<div class="left-inner <?php echo (empty($sub_nav->{0}->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">
									<div class="sub-menu clearfix">
										<?php
										if(!empty($sub_nav->{0}->content)): ?>

											<div class="content sub-content single-0 active">
												<?php echo $sub_nav->{0}->content ;?>
											</div>

										<?php endif;// !empty($cont->sub) && !empty($cont->content)
										?>

									</div>
								</div>
								<?php
								if(!empty($sub_nav->{0}->sidebar)):
									?>
									<div class="sidebar col-md-4 single-0">
										<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
										<?php echo $sub_nav->{0}->sidebar; ?>
									</div>
								<?php endif;
							endif; ?>
						</div>
						<?php
					endif;
				endif; // !empty($sub->sub) && !empty($sub->content)
				?>

			</div>

			<div class="content third ">

				<?php if(!empty($this->get( 'third_tab_content' ))): ?>

					<div class="top">
						<?php echo $this->get( 'third_tab_content' ) ;?>
					</div>

				<?php endif;

				$sub_nav = $this->get( 'third_sub_nav' );
				?>

				<?php
				if (count((array)$sub_nav) > 1 ):
					?>
					<div class="left col-md-12">
						<div class="sub-menu-tabs col-md-8">
							<?php
							foreach( $sub_nav as $i => $sub ):
								if(!empty($sub->sub)):
									?>

									<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
										<?php echo $sub->sub ;?>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>
						<?php
						foreach( $sub_nav as $i => $sub ):
							?>
							<div class="left-inner <?php echo (empty($sub->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">

								<div class="sub-menu clearfix">
									<?php
									if(!empty($sub->sub) && !empty($sub->content)): ?>

										<div class="content sub-content single-<?php echo $i ;?>">
											<?php echo $sub->content ;?>
										</div>

										<?php
									endif; // !empty($cont->sub) && !empty($cont->content)
									?>

								</div>
							</div>
							<?php
							if(!empty($sub->sub) && !empty($sub->content) && !empty($sub->sidebar)): ?>
								<div class="sidebar col-md-4 single-<?php echo $i ;?>">
									<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
									<?php echo ($sub->sidebar) ? $sub->sidebar : ''?>
								</div>
							<?php endif;
						endforeach; // $sub_nav as $i => $sub
						?>
					</div>
					<?php
				else:
					if(!(empty($sub_nav->{0}->sub) && empty($sub_nav->{0}->content))):
						?>
						<div class="left col-md-12">
							<?php
							if( $sub_nav ):
								if(!empty( $sub_nav->{0}->sub)): ?>
									<div class="sub-menu-tabs col-md-8">
										<div id="single-0" class="single-menu col-md-3 active">
											<?php echo $sub_nav->{0}->sub ;?>
										</div>
									</div>
									<?php
								endif;
								?>
								<div class="left-inner <?php echo (empty($sub_nav->{0}->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">
									<div class="sub-menu clearfix">
										<?php
										if(!empty($sub_nav->{0}->content)): ?>

											<div class="content sub-content single-0 active">
												<?php echo $sub_nav->{0}->content ;?>
											</div>

										<?php endif;// !empty($cont->sub) && !empty($cont->content)
										?>

									</div>
								</div>
								<?php
								if(!empty($sub_nav->{0}->sidebar)):
									?>
									<div class="sidebar col-md-4 single-0">
										<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
										<?php echo $sub_nav->{0}->sidebar; ?>
									</div>
								<?php endif;
							endif; ?>
						</div>
						<?php
					endif;
				endif; // !empty($sub->sub) && !empty($sub->content)
				?>

			</div>

			<div class="content fourth ">

				<?php if(!empty($this->get( 'fourth_tab_content' ))): ?>

					<div class="top">
						<?php echo $this->get( 'fourth_tab_content' ) ;?>
					</div>

				<?php endif;

				$sub_nav = $this->get( 'fourth_sub_nav' );
				?>

				<?php
				if (count((array)$sub_nav) > 1 ):
					?>
					<div class="left col-md-12">
						<div class="sub-menu-tabs col-md-8">
							<?php
							foreach( $sub_nav as $i => $sub ):
								if(!empty($sub->sub)):
									?>

									<div id="single-<?php echo $i ;?>" class="single-menu col-md-3">
										<?php echo $sub->sub ;?>
									</div>
									<?php
								endif;
							endforeach;
							?>
						</div>
						<?php
						foreach( $sub_nav as $i => $sub ):
							?>
							<div class="left-inner <?php echo (empty($sub->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">

								<div class="sub-menu clearfix">
									<?php
									if(!empty($sub->sub) && !empty($sub->content)): ?>

										<div class="content sub-content single-<?php echo $i ;?>">
											<?php echo $sub->content ;?>
										</div>

										<?php
									endif; // !empty($cont->sub) && !empty($cont->content)
									?>

								</div>
							</div>
							<?php
							if(!empty($sub->sub) && !empty($sub->content) && !empty($sub->sidebar)): ?>
								<div class="sidebar col-md-4 single-<?php echo $i ;?>">
									<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
									<?php echo ($sub->sidebar) ? $sub->sidebar : ''?>
								</div>
							<?php endif;
						endforeach; // $sub_nav as $i => $sub
						?>
					</div>
					<?php
				else:
					if(!(empty($sub_nav->{0}->sub) && empty($sub_nav->{0}->content))):
						?>
						<div class="left col-md-12">
							<?php
							if( $sub_nav ):
								if(!empty( $sub_nav->{0}->sub)): ?>
									<div class="sub-menu-tabs col-md-8">
										<div id="single-0" class="single-menu col-md-3 active">
											<?php echo $sub_nav->{0}->sub ;?>
										</div>
									</div>
									<?php
								endif;
								?>
								<div class="left-inner <?php echo (empty($sub_nav->{0}->sidebar)) ? 'col-md-12' : 'col-md-8'; ?>">
									<div class="sub-menu clearfix">
										<?php
										if(!empty($sub_nav->{0}->content)): ?>

											<div class="content sub-content single-0 active">
												<?php echo $sub_nav->{0}->content ;?>
											</div>

										<?php endif;// !empty($cont->sub) && !empty($cont->content)
										?>

									</div>
								</div>
								<?php
								if(!empty($sub_nav->{0}->sidebar)):
									?>
									<div class="sidebar col-md-4 single-0">
										<img src="../../../wp-content/themes/Horizon/assets/images/sidebar_doc.png">
										<?php echo $sub_nav->{0}->sidebar; ?>
									</div>
								<?php endif;
							endif; ?>
						</div>
						<?php
					endif;
				endif; // !empty($sub->sub) && !empty($sub->content)
				?>

			</div>
		</div>
	</div>
</div>