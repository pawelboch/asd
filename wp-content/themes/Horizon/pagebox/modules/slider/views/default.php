<?php
/**
 * Slider view
 */
?>

	<div class="container-fluid slider-module-fg23gh">
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
							<div class="tab-1 tab-title active">
								<h2><?php echo $this->get( 'first_tab_title' ) ;?></h2>
							</div>
							<div class="tab-2 tab-title">
								<h2><?php echo $this->get( 'second_tab_title' ) ;?></h2>
							</div>
							<div class="tab-3 tab-title">
								<h2><?php echo $this->get( 'third_tab_title' ) ;?></h2>
							</div>
							<div class="tab-4 tab-title">
								<h2><?php echo $this->get( 'fourth_tab_title' ) ;?></h2>
							</div>
						</div>
						<div class="tab-content-1 tab-content active">
							<p><?php echo $this->get( 'first_tab_content' ) ;?></p>
						</div>
						<div class="tab-content-2 tab-content">
							<p><?php echo $this->get( 'first_tab_content' ) ;?></p>
						</div>
						<div class="tab-content-3 tab-content">
							<p><?php echo $this->get( 'first_tab_content' ) ;?></p>
						</div>
						<div class="tab-content-4 tab-content">
							<p><?php echo $this->get( 'first_tab_content' ) ;?></p>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>

