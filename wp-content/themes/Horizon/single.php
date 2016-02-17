<?php get_header(); ?>



<div class="container top-title">
	<h2 class="title"><?php the_title() ;?></h2>
</div>

<div class="container post">

	<div class="content col-md-12">
		<div class="row">

			<div class="sidebar col-md-2">
				<div class="author">
					<div class="name">
						author
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
						<?php echo get_the_date(); ?>
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

			<div class="news-insights col-md-12">
				<?php $args = array(
					'posts_per_page'   => 3,
					'offset'           => 0,
					'category'         => '',
					'category_name'    => '',
					'orderby'          => 'date',
					'order'            => 'DESC',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => 'post',
					'post_mime_type'   => '',
					'post_parent'      => '',
					'author'	   => '',
					'post_status'      => 'publish',
					'suppress_filters' => true
				);
				$the_query = new WP_Query( $args ); ?>

				<div class="container row">
					<div class="related">
						<span>Related content ></span>
					</div>

					<div class="news">
						<?php
						if ( $the_query->have_posts() ) {

							while ( $the_query->have_posts() ) {
								$the_query->the_post(); ?>

								<div class="col-md-4">
									<div class="row">
										<div class="category">
											category
										</div>
										<div class="date">
											<?php echo get_the_date() ;?>
										</div>
										<h2 class="title">
											<a href="<?php echo get_permalink() ; ?>">
												<?php echo get_the_title() ;?>
											</a>
										</h2>
										<p class="content">
											<?php echo get_the_excerpt() ;?>
										</p>
									</div>
								</div>


							<?php }

						} else {
							// no posts found
						}
						/* Restore original Post Data */
						wp_reset_postdata(); ?>
					</div>
				</div>
			</div>

			<div class="contact col-md-12">
				contact placeholder
			</div>

		</div>
	</div>


</div>

<?php get_footer(); ?> 