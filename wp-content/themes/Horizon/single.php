<?php get_header(); ?>

<div class="container post">

	<div class="col-md-12">
		<h2 class="title"><?php the_title() ;?></h2>
	</div>

	<div class="content col-md-12">
		<div class="row">

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
					<div class="published">
						Published on:
					</div>

					<div class="date">
						12.12.2012
					</div>
				</div>

				<div class="share-print">
					<span class="social">
						<i class="fa fa-share-alt"></i>
						share
					</span>

					<span class="print">
						print
					</span>
				</div>
			</div>

			<div class="post-text col-md-10">
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
	</div>


</div>

<?php get_footer(); ?> 