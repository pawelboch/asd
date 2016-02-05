<?php
/**
 * View file for listing modal
 *
 * It displays all registered modules and
 * allows to add selected module to metabox
 * 
 * @since       1.0.0
 * @author      Max Matloka (max@matloka.me)
 *
 * @package     pagebox
 * @subpackage  pagebox/partials/metabox/modal
 */

$modules = $this->get( 'modules' );
?>

<div id="pagebox-modal-listing">
	<div class="pagebox-title">
		<h1><?php _e('Add new module', 'pagebox'); ?></h1>
	</div>

	<div class="pagebox-tabs">
		<div class="pagebox-router">
			<a href="#pagebox-modules">
				<span>
					<i class="dashicons dashicons-menu"></i>
					<?php _e('Default modules', 'pagebox'); ?>
				</span>
			</a>
			<a href="#pagebox-predefined">
				<span>
					<i class="dashicons dashicons-admin-plugins"></i>
					<?php _e('Modules with predefined settings', 'pagebox'); ?>
				</span>
			</a>
		</div>

		<div id="pagebox-modules" class="pagebox-tab">
			<?php if ( ! $modules ): ?>
			<span class="pagebox-notice">
				<p>
					<?php _e('Please register boxes first.', 'pagebox'); ?>
				</p>
			</span>
			<?php else: ?>
			<div class="pagebox-search">
				<input type="text" class="pagebox" data-action="filter" placeholder="<?php _e('Filter modules', 'pagebox'); ?>" />
			</div>
			<ul>
				<?php 
					foreach ( $modules as $module ):
					$moduleConfig = $module->get_config();

					if ( isset( $moduleConfig[ 'limit' ][ 'width' ] ) && ! ( $_REQUEST[ 'target' ][ 'width' ] >= $moduleConfig[ 'limit' ][ 'width' ][ 0 ] && $_REQUEST[ 'target' ][ 'width' ] <= $moduleConfig[ 'limit' ][ 'width' ][ 1 ] ) ) {
						continue;
					}

					if ( isset( $moduleConfig[ 'limit' ][ 'template' ] ) && ! in_array( substr( $_REQUEST[ 'target' ][ 'id' ], 8), $moduleConfig[ 'limit' ][ 'template' ] ) ) {
						continue;
					}
				?>
				<li class="pagebox module module-<?php echo $moduleConfig[ 'slug' ]; ?>" data-action="new" data-target="<?php echo $_REQUEST[ 'target' ][ 'id' ]; ?>" data-module="<?php echo $moduleConfig[ 'slug' ]; ?>" data-title="<?php echo strtolower( $moduleConfig[ 'title' ] ); ?>">
					<i class="icon"></i>
					<strong>
						<?php echo $moduleConfig[ 'title' ]; ?>
					</strong>
					<div class="description">
						<?php echo $moduleConfig[ 'description' ]; ?>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</div>
		<div id="pagebox-predefined" class="pagebox-tab">
			<?php if ( ! $this->get( 'predefined' )->have_posts() ) : ?>

			<span class="pagebox-notice">
				<p>
					<?php _e('Navigate to Pagebox in side menu to create new modules with predefined settings', 'pagebox'); ?>
				</p>
			</span>

			<?php else: ?>

			<div class="pagebox-search">
				<input type="text" class="pagebox" data-action="filter" placeholder="<?php _e('Filter modules', 'pagebox'); ?>" />
			</div>
			<ul>

				<?php while ( $this->get( 'predefined' )->have_posts() ) : ?>
				<?php $this->get( 'predefined' )->the_post(); ?>

				<?php
					$slug     = get_post_meta( get_the_ID(), 'pagebox_module', true );
					$settings = get_post_meta( get_the_ID(), 'pagebox_modules', true );

					if ( empty( $slug ) || ! isset ( $slug ) ) :
						continue;
					endif;
				?>

				<li class="pagebox module module-<?php echo $slug; ?>" data-action="predefined" data-target="<?php echo $_REQUEST[ 'target' ][ 'id' ]; ?>" data-module="<?php echo $slug; ?>" data-title="<?php echo strtolower( get_the_title() ); ?>">
					<i class="icon"></i>
					<strong>
						<?php echo get_the_title(); ?>
					</strong>
					<div class="description">
						<?php echo $modules[ $slug ]->get_config( 'description' ); ?>
					</div>
					<input type="hidden" value='<?php echo json_encode( $settings ); ?>'>
				</li>

				<?php endwhile; ?>

			</ul>

			<?php endif; ?>	

		</div>
	</div>
</div>