<?php
/**
 * Post_title view
 */
?>

<div class="<?php echo $this->get('css_class'); ?> background">
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
