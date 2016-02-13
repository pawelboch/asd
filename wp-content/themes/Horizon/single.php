<?php get_header(); ?>

<div class="container post">

	<div class="col-md-12">
		<h2 class="title"><?php the_title() ;?></h2>
	</div>

	<div class="sidebar col-md-2">
		<div class="author">
			<div class="name">
				Jon Jon
			</div>

			<div class="position">
				Asset Menager
			</div>
		</div>

		<div class="details">
			<div class="title">
				Published on
			</div>

			<div class="date">
				<?php the_date('Y-m-d'); ?>
			</div>
		</div>

		<div class="share_print">
			<span class="social">
				share
			</span>

			<span class="print">
				print
			</span>
		</div>
	</div>

	<div class="content col-md-10">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				the_content();
			}
		}
		?>
	</div>

</div>

<?php get_footer(); ?> 