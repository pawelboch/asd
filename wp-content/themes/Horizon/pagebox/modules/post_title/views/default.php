<?php
/**
 * Post_title view
 */
?>

<div class="pagebox-post_title-module container-fluid background">

	<?php if($this->get('category') != false): ?>

	<div class="category <?php echo strtolower(get_the_category()[0]->name) ;?>">
		<?php echo get_the_category()[0]->name ;?>
	</div>

	<?php else: ?>
		<!-- switch off -->
	<?php endif ;?>

	<?php if($this->get('title') != false): ?>
	<div class="title">
		<?php echo get_the_title() ;?>
	</div>

	<?php else: ?>
		<!-- title switch off -->
	<?php endif ;?>
</div>
