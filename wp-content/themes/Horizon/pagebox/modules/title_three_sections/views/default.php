<?php
/**
 * two_images view
 */
?>

	<div class="container title_three_sections-module">

		<div class="title text-sm-center">
			<h2>
				<?php echo $this->get( 'title' ) ;?>
			</h2>
		</div>

		<div class="first col-md-4">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'first_image' ) ) ;?>">
			<p><?php echo $this->get( 'first_title' ) ;?></p>
			<p>description placeholder</p>
			col-1
		</div>

		<div class="second col-md-4">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'second_image' ) ) ;?>">
			<p>title placeholder</p>
			<p>description placeholder</p>
			col-2
		</div>

		<div class="third col-md-4">
			<img src="<?php echo wp_get_attachment_url( $this->get( 'third_image' ) ) ;?>">
			<p>title placeholder</p>
			<p>description placeholder</p>
			col-3
		</div>

	</div>

