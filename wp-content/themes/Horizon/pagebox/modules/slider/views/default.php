<?php
/**
 * Slider view
 */
?>

	<div class="container-fluid slider-module-fg23gh">
		<div class="transparency">
			<div class="container">
				<div class="row">
					<div class="slides">
						<?php
						$slider = $this->get( 'slider' );
						foreach($slider as $slide):
							?>

							<h2 class="col-xs-12 col-sm-8 col-md-10 col-lg-8"> <?php echo $slide->title  ;?> <span><?php echo $slide->title_highlight  ;?></span> </h2>
							<p class="col-xs-12 col-sm-8 col-md-10 col-lg-7"> <?php echo $slide->description  ;?> </p>
							<a class="col-xs-12 learn-more-btn" href="<?php echo $slide->button ;?>" class="btn-2">learn more <span> > </span></a>

							<?php
						endforeach;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

