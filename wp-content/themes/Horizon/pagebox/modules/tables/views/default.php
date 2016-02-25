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
					foreach($tabSlug as $tab):
						if($this->get( $tab.'_tab_title' )):
				?>
							<div id="<?php echo $tab; ?>" class="title col-md-3 col-sm-3 col-xs-12 <?php echo (!$active) ? 'active' : ''?>">
								<h2><?php echo $this->get( $tab.'_tab_title' ) ;?></h2>
							</div>
				<?php
							if(!$active):
								$active = true;
							endif;
						endif;
					endforeach;
				?>
				<div class="navigation-arrows">
					<img class="arrow navigation-up" src="<?php echo get_template_directory_uri(); ?>/assets/images/upArrow.svg" alt="">
					<img class="arrow navigation-down" src="<?php echo get_template_directory_uri(); ?>/assets/images/downArrow.svg" alt="">
				</div>
			</div>
			<?php
				$active = false;
				foreach($tabSlug as $tab):
					if($this->get( $tab.'_tab_title' )):
					?>
						<div class="content <?php echo $tab; ?> <?php echo (!$active) ? 'active' : ''?>">
							<div class="top">

							</div>
							<?php echo $this->get( $tab.'_tab_content' ) ;?>
						</div>
					<?php
						if(!$active):
							$active = true;
						endif;
					endif;
				endforeach;
			?>
		</div>
	</div>
</div>

