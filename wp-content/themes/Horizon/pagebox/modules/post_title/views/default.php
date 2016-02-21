<?php
/**
 * Post_title view
 */
?>

<?php global $post ;?>

<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

	<div class="<?php echo $this->get('css_class'); ?>" style="background-image: url('<?php echo $image[0]; ?>')">
		<div class="transparency">
			<div class="container">

					<div class="category <?php echo strtolower(get_the_category()[0]->name) ;?>">
						<?php echo get_the_category()[0]->name ;?>
					</div>


					<div class="title">
						<?php echo get_the_title() ;?>
					</div>

			</div>
		</div>
	</div>

<?php endif; ?>