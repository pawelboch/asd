<?php
/**
 * Post_title view
 */
?>

<div class="pagebox-post_title-module">
	<div class="category <?php echo strtolower(get_the_category()[0]->name) ;?>">
		<?php echo get_the_category()[0]->name ;?>
	</div>
	<div class="title">
		<?php echo get_the_title() ;?>
	</div>
</div>
