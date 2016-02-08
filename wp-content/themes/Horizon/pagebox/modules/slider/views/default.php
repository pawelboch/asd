<?php
/**
 * Slider view
 */
?>

	<div class="container-fluid slider-module">
		<div class="container">
			<div class="row">
				<div class="slides">
					<h2 class="col-xs-12 col-sm-8 col-md-10 col-lg-8"> <?php echo $this->get( 'title' ) ;?> <span><?php echo $this->get ('title_highlight') ;?></span> </h2>
					<p class="col-xs-12 col-sm-8 col-md-10 col-lg-7"> <?php echo $this->get( 'description' ) ;?> </p>
					<a class="col-xs-12 learn-more-btn" href="<?php echo $this->get( 'button' );?>" class="btn-2">learn more <span> > </span></a>
				</div>

				<div class="tabs col-xs-12 col-sm-12">
					<div class="row">
						<div class="tab-head">
							<div class="tab-title active">
								<h2>This is Tab 1</h2>
							</div>
							<div class="tab-title">
								<h2>This is another Tab</h2>
							</div>
							<div class="tab-title">
								<h2>This is Tab 3</h2>
							</div>
							<div class="tab-title">
								<h2>This is Tab 4</h2>
							</div>
						</div>
						<div class="tab-content">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur condimentum porttitor ante, quis ornare felis viverra vitae. </p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

