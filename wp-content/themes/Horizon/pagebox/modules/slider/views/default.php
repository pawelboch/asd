<?php
/**
 * Slider view
 */
;?>



<div class="container-fluid slider-module-fg23gh">
	<div class="slides slider">
		<?php $slider = $this->get( 'slider' );
		foreach($slider as $slide): ?>

				<div class="background" style="background-image: url(<?php echo wp_get_attachment_image_url( $slide->image) ;?>)">
					<div class="transparency">
						<div class="container">
							<h2 class="col-xs-12 col-sm-8 col-md-10 col-lg-8" style="background-color: <?php echo $this->get('h2_bgc') ;?>; color: <?php echo $this->get('h2_color'); ?>;"> <?php echo $slide->title  ;?> <span><?php echo $slide->title_highlight  ;?></span> </h2>
							<p class="col-xs-12 col-sm-8 col-md-10 col-lg-7"> <?php echo $slide->description  ;?> </p>

							<?php if($this->get('learn_switch') !== false): ?>
							<a class="col-xs-12 learn-more-btn" href="<?php echo $slide->button ;?>" class="btn-2">learn more <span> > </span></a>
							<?php else: ?>
								<!-- Button disabled -->
							<?php endif ;?>
						</div>
					</div>
				</div>

		<?php endforeach ;?>
	</div>
</div>

