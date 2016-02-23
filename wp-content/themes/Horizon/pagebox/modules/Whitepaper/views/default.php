<?php
/**
 * Contact view
 */
?>

	<div class="container <?php echo $this->get('css_class'); ?>">
		<div class="col-md-4 single">
			<div class="title">
				<?php echo $this->get('title1') ;?>
			</div>
			<div class="description">
				Nullam eu ultricies lacus. Aliquam nec lacinia justo. Phasellus tempus consequat ex non fringilla...
			</div>
			<div class="download">
				<a href="#">
					<div class="ico"></div>
					<span class="text"> <?php echo $this->get('download_btn') ;?> </span>
				</a>
			</div>
		</div>

		<div class="col-md-4 single">
			<div class="title">
				<?php echo $this->get('title2') ;?>
			</div>
			<div class="description">
				Nullam eu ultricies lacus. Aliquam nec lacinia justo. Phasellus tempus consequat ex non fringilla...
			</div>
			<a href="#">
				<div class="download">
					<div class="ico"></div>
					<span class="text"> <?php echo $this->get('download_btn') ;?> </span>
				</div>
			</a>
		</div>

		<div class="col-md-4 single">
			<div class="title">
				<?php echo $this->get('title3') ;?>
			</div>
			<div class="description">
				Nullam eu ultricies lacus. Aliquam nec lacinia justo. Phasellus tempus consequat ex non fringilla...
			</div>
			<a href="#">
				<div class="download">
					<div class="ico"></div>
					<span class="text"> <?php echo $this->get('download_btn') ;?> </span>
				</div>
			</a>
		</div>
	</div>

