<?php
/**
 * two_images view
 */
?>

	<div class="container two_images-module">
		<div class="half-part left col-md-6">
			<div class="row">
				<h2 class="title">
					<?php echo $this->get( 'title_left' ) ;?>
				</h2>

				<p class="description"><?php echo $this->get( 'description_left' ) ;?></p>

				<a href="#" class="learn-more-btn col-xs-12 btn-2">
					learn more<span> > </span>
				</a>
			</div>
		</div>

		<div class="half-part right col-md-6">
			<div class="row">
				<h2 class="title">
					<?php echo $this->get( 'title_right' ) ;?>
				</h2>

				<p class="description"><?php echo $this->get( 'description_right' ) ;?></p>

				<a href="#" class="learn-more-btn col-xs-12 btn-2">
					learn more<span> > </span>
				</a>
			</div>
		</div>
	</div>

