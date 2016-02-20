<?php
/**
 * two_images view
 */
?>

<?php $args = array(
	'posts_per_page'   => $this->get('news_number'),
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
$posts_array = get_posts( $args ); ?>

	<div class="container <?php echo $this->get('css_class'); ?>">
		<div class="title col-md-12">
			<h2><?php echo $this->get( 'title' ) ;?></h2>
		</div>

		<div class="news clearfix">
			<?php foreach($posts_array as $post):?>

				<?php if($this->get( 'news_number' ) == 1) :?> <!-- Display one 100% width news -->
					<div class="news_insights col-md-12">
				<?php elseif($this->get( 'news_number' ) == 3) :?> <!-- Display three 33.3% width news -->
					<div class="news_insights col-md-4">
				<?php endif ;?>

				<?php if($this->get( 'news_number' ) == 6) :?> <!-- Display six 33.3% width news in two rows -->
					<div class="news_insights col-md-4">
				<?php endif ;?>

					<div class="category <?php echo strtolower(get_the_category($post->ID)[0]->name) ;?>">
						<?php echo get_the_category($post->ID)[0]->name ;?>
					</div>
					<div class="date">
						<?php echo $post->post_date ;?>
					</div>
					<h2 class="title">
						<a href="<?php echo $post->guid ; ?>">
							<?php echo $post->post_title ;?>
						</a>
					</h2>
					<p class="content">
						<?php echo wpautop( wppb_excerpt($post->ID, 25) );?>
					</p>
				</div>

			<?php endforeach ;?>
		</div>

		<div class="col-md-12">
			<a class="col-xs-12 col-md-3 learn-more-btn article" href="#"><?php echo $this->get( 'learn_more' ) ;?><span></span></a>
		</div>


	</div>