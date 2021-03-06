<?php
/**
 * Slider view
 */
?>

<div class="container-fluid <?php echo $this->get('css_class'); ?>">
	<div class="slides slider">
		<?php $slider = $this->get( 'slider' );
		foreach($slider as $i => $slide): ?>
				<div class="background <?php echo 'slide-' . ($i+1); ?>">
					<div class="transparency">
						<div class="container">
							<div class="row">
								<h2 class="col-xs-12 col-sm-8 col-md-10 col-lg-8 auto-position"> <?php echo $slide->title; ?> <span><?php echo $slide->title_highlight; ?></span> </h2>
								<p class="col-xs-12 col-sm-8 col-md-10 col-lg-7"> <?php echo $slide->description  ;?> </p>
								<?php if( isset( $slide->btn, $slide->btn_text )): ?>
								<a class="col-xs-12 learn-more-btn" href="<?php echo $slide->btn; ?>" class="btn-2"><?php echo $slide->btn_text; ?><span></span></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
		<?php endforeach ;?>
	</div>
</div>

