<?php
/**
 * two_images view
 */
?>

	<div class="container <?php echo $this->get('css_class'); ?>">

		<div class="title text-sm-center text-xs-center">
			<h2>
				<?php echo $this->get( 'title' ) ;?>
			</h2>
		</div>

		<?php if($this->get('switch') !== false): ?>

		<div class="first part col-md-4 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'first_image' ) ) ;?>">
			<h3><?php echo $this->get( 'first_title' ) ;?></h3>
			<p><?php echo $this->get( 'first_description' ) ;?></p>
		</div>

		<div class="second part col-md-4 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'second_image' ) ) ;?>">
			<h3><?php echo $this->get( 'second_title' ) ;?></h3>
			<p><?php echo $this->get( 'second_description' ) ;?></p>
		</div>

		<div class="third part col-md-4 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'third_image' ) ) ;?>">
			<h3><?php echo $this->get( 'third_title' ) ;?></h3>
			<p><?php echo $this->get( 'third_description' ) ;?></p>
		</div>

		<?php else: ?>

		<div class="first part col-md-6 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'first_image' ) ) ;?>">
			<h3><?php echo $this->get( 'first_title' ) ;?></h3>
			<p><?php echo $this->get( 'first_description' ) ;?></p>
		</div>

		<div class="second part col-md-6 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'second_image' ) ) ;?>">
			<h3><?php echo $this->get( 'second_title' ) ;?></h3>
			<p><?php echo $this->get( 'second_description' ) ;?></p>
		</div>

		<?php endif ;?>

	</div>

