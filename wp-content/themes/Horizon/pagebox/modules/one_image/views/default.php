<?php
/**
 * one_image view
 */
?>

	<div class="container <?php echo $this->get('css_class'); ?>" style="background-image: url(<?php echo wp_get_attachment_url($this->get('image')) ;?>); border-bottom: <?php echo $this->get('border') ;?>">


	</div>

