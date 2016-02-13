<?php
/**
 * two_images view
 */
?>

	<div class="container title_three_sections-module-fg23gh">

		<div class="title text-sm-center text-xs-center">
			<h2>
				<?php echo $this->get( 'title' ) ;?>
			</h2>
		</div>

		<div class="first col-md-4 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'first_image' ) ) ;?>">
			<h3><?php echo $this->get( 'first_title' ) ;?></h3>
			<p><?php echo $this->get( 'first_description' ) ;?></p>
		</div>

	<?php if($this->get('border') !== ''): ?>
		<div class="second col-md-4 text-sm-center text-xs-center" style="border-left: <?php echo $this->get('border') ;?>; border-right: <?php echo $this->get('border') ;?>">
	<?php else: ;?>
		<div class="second col-md-4 text-sm-center text-xs-center">
	<?php endif ;?>

			<img src="<?php echo wp_get_attachment_url( $this->get( 'second_image' ) ) ;?>">
			<h3><?php echo $this->get( 'second_title' ) ;?></h3>
			<p><?php echo $this->get( 'second_description' ) ;?></p>
		</div>

		<div class="third col-md-4 text-sm-center text-xs-center">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'third_image' ) ) ;?>">
			<h3><?php echo $this->get( 'third_title' ) ;?></h3>
			<p><?php echo $this->get( 'third_description' ) ;?></p>
		</div>

	</div>

