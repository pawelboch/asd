<?php
/**
 * Contact view
 */
?>

	<div class="container contact-module-fg23gh">
		<div class="col-md-6 left-part">
			<h2 class="title">
				<?php echo $this->get('title') ;?>
			</h2>

			<p class="description">
				<?php echo $this->get('description') ;?>
			</p>

		</div>
		<div class="col-md-6 contact-form">
			<?php echo do_shortcode($this->get('contact_form')) ;?>
		</div>
	</div>

