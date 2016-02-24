<?php
/**
 * Contact view
 */
?>

	<div class="container <?php echo $this->get('css_class'); ?>">
		<div class="col-md-6 left-part">
			<h2 class="title">
				<?php echo $this->get('title') ;?>
			</h2>

			<div class="description">
				<?php echo $this->get('description') ;?>
			</div>

		</div>
		<div class="col-md-6 contact-form">
			<?php echo do_shortcode($this->get('contact_form')) ;?>
		</div>
	</div>

