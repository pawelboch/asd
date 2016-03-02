<?php

/*
Template Name: Team
*/

?>

<?php get_header(); ?>



<div class="main team-page">

	<div class="persons">

		<?php for ($i = 1; $i <= 6; $i++): ;?>

		<div class="person">
			<div class="picture">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/Dan_Otoole-b&w.jpg' ;?>" alt="person-img">
			</div>
			<div class="description">
				<h2>
					Name
				</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet at dolor et fugit laboriosam modi, molestias nulla pariatur quia ratione sit tempora. Dignissimos ea in molestias perferendis veritatis. Enim. <?php echo $i ;?>
				</p>
			</div>
			<div class="expand">
				button
			</div>
		</div>
			<div class="team-desc">
				desc <?php echo $i ;?>
			</div>
		<?php endfor ;?>

</div>

</div>

<?php get_footer(); ?> 