<?php
/**
 * View file for templates menu used in metabox
 * 
 * @since       1.0.0
 *
 * @package     pagebox
 * @subpackage  pagebox/partials/metabox
 */
?>

<div class="pagebox-navigation">
	<a href="#previews" data-action="metabox-tabs" class="pagebox<?php if ( ! $this->get( 'template' ) ) : ?> current<?php endif; ?>">Templates</a>
	<a href="#sections" data-action="metabox-tabs" class="pagebox<?php if ( $this->get( 'template' ) ) : ?> current<?php endif; ?>">Modules</a>
</div>

<div class="metabox">

	<?php 
	/**
	 * Display default templates menu. It allows user to pick
	 * template and start pagebox
	 *
	 * @since  1.0.0 
	 */
	?>
	<?php if ( ! $this->get( 'templates' )->get_templates() ) : ?>

	<div id="message" class="updated">
		<p><?php _e( 'Please add template to use pagebox.', 'pagebox' ); ?></p>
	</div>

	<?php else: ?>

	<div id="previews" class="previews<?php if ( ! $this->get( 'template' ) ) : ?> current<?php endif; ?>">
		<ul>

		<?php foreach ( $this->get( 'templates' )->get_templates() as $template ) : ?>

			<li class="pagebox tooltip <?php if ( $this->get( 'template_name' ) == $template->get_slug() ) echo 'current-template'; ?>" 
				data-action="template"
				data-tooltip="<?php echo $template->get_config( 'description' ); ?>"
				data-template="<?php echo $template->get_slug(); ?>">

				<div class="pagebox-template-preview preview-<?php echo $template->get_slug(); ?>">

					<?php foreach ( $template->get_config( 'sections' ) as $slug => $section ) : ?>

						<div class="preview-section section-<?php echo $slug; ?> section-width-<?php echo $section[ 'size' ]; ?>">
						</div>

					<?php endforeach; ?>

				</div>

				<h4>
					<?php echo $template->get_config( 'name' ) ?>
				</h4>

			</li>

		<?php endforeach; ?>

		</ul>
	</div>

	<?php endif; ?>

	<?php 
	/**
	 * If template is avaiable (it was chosen by user) show
	 * modules structure
	 *
	 * @since  1.0.0 
	 */
	?>
	<div id="sections" class="sections<?php if ( $this->get( 'template' ) ) : ?> current<?php endif; ?>">
	<?php if ( $this->get( 'template' ) ) : ?>

		<?php echo $this->get( 'template' ); ?> 

	<?php endif; ?>
	</div>

	<div style="display: none;">
		<?php wp_editor('', uniqid(time())); ?>
	</div>

	<?php wp_nonce_field( 'pagebox-actions', 'pagebox-nonce' ); ?>
</div>