<?php
/**
 * two_images view
 */
?>

	<div class="container <?php echo $this->get('css_class'); ?>">

		<?php if($this->get('switch') != false): ?>

		<div class="half-part left col-md-6">
			<div class="row">
				<h2 class="title">
					<?php echo $this->get( 'title_left' ) ;?>
				</h2>

				<div class="col-md-12">
					<p class="description"><?php echo $this->get( 'description_left' ) ;?></p>
					<a href="#" class="learn-more-btn col-xs-12 col-sm-4 col-xs-6 btn-2">learn more<span> > </span></a>
				</div>

			</div>
		</div>

		<div class="half-part right col-md-6">
			<div class="row">
				<h2 class="title">
					<?php echo $this->get( 'title_right' ) ;?>
				</h2>

				<div class="col-md-12">
					<p class="description"><?php echo $this->get( 'description_right' ) ;?></p>
					<a href="#" class="learn-more-btn col-xs-12 col-sm-4 col-xs-6 btn-2">learn more<span> > </span></a>
				</div>
			</div>
		</div>

		<?php else: ?>

			<div class="full col-md-12">
				<div class="row">
					<h2 class="title">
						<?php echo $this->get( 'title_left' ) ;?>
					</h2>

					<div class="col-md-12">
						<p class="description"><?php echo $this->get( 'description_left' ) ;?></p>
						<a href="#" class="learn-more-btn col-xs-12 col-sm-4 col-xs-6 btn-2">learn more<span> > </span></a>
					</div>

				</div>
			</div>

		<?php endif ;?>

	</div>

