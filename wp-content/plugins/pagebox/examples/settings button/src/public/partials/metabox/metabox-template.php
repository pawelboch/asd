<?php
/**
 * View file for pagebox contents
 * 
 * @since       1.0.0
 *
 * @package     pagebox
 * @subpackage  pagebox/partials/metabox
 */
$contents = $this->get( 'contents' );
$modules  = $this->get( 'modules' );
?>

<?php if ( is_array( $this->get( 'template' )->get_sections() ) ) : ?>

	<?php $i = 1; ?>
	<?php $overflow = 0; ?>

	<?php foreach ( $this->get( 'template' )->get_sections() as $slug => $section ): ?>

		<?php if ( $overflow == 0 ): ?>

		<div class="section-wrap">

		<?php endif; ?>

			<div id="section-<?php echo $slug; ?>"
				 class="section section-<?php echo $slug; ?> section-width-<?php echo $section[ 'size' ]; ?>"
				 data-width="<?php echo $section[ 'size' ]; ?>"
				 data-section="<?php echo $slug; ?>">

				<div class="modules">

					<?php 
						if ( isset ( $contents[ 'section-' . $slug ] ) && ! empty ( $contents[ 'section-' . $slug ] ) ) :
							foreach ( $contents[ 'section-' . $slug ] as $module_data_JSON ) : 
								$module_data = json_decode( $module_data_JSON );

								// get module data
								$module = $modules->get_module( $module_data->slug ); 
								$module->display_backend( $module->get_slug(), $module_data_JSON, $slug );
							endforeach;
						endif;
					?>

				</div>
                <div class="settings_cont" >
                    <a href="#" class="pagebox" data-action="add">+

                    </a>
                    <button class="pagebox button-secondary">
                        <span class="">Settings </span>
                    </button>
                </div>
			</div>
			<?php $overflow += $section[ 'size' ]; ?>

		<?php if ( $overflow >= 95 || $i == count( $this->get( 'template' )->get_sections() ) ) : $overflow = 0; $i++; ?>
			</div>
		<?php endif; ?>

	<?php endforeach; ?>

<?php endif; ?>

<input type="hidden" value="<?php echo $this->get( 'template' )->get_slug(); ?>" name="pagebox_template" />

<?php wp_nonce_field( 'pagebox-actions', 'pagebox-nonce' ); ?>
