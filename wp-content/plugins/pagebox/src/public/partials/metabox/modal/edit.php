<?php
/**
 * View file for edit block modal
 * 
 * @since       1.0.0
 * @author      Max Matloka (max@matloka.me)
 *
 * @package     pagebox
 * @subpackage  pagebox/partials/metabox/modal
 */

$module = $this->get( 'module' );
?>

<div id="pagebox-modal-edit">
	<div class="pagebox-title">
		<h3><?php _e( 'Add new module', 'pagebox' ); ?>: <?php echo $module->get_config( 'title' ); ?></h3>
	</div>
	<div class="pagebox-content">
		<div class="pagebox-form">
			<?php echo $this->get( 'form' )->getRenderedTag(); ?>

				<?php $groups = $module->get_form()->getGroups(); ?>
				<?php if (!empty($groups)) : ?>

					<div class="pagebox-tabs">
					
						<div class="pagebox-router">
							<?php foreach ($module->get_form()->getGroups() as $group) : ?>
								<a href="#"><?php echo $group; ?></a>
							<?php endforeach; ?>
						</div>

						<?php foreach ($module->get_form()->getGroups() as $group) : ?>

							<div class="pagebox-tab">
								<table>
									<?php echo $module->get_form()->render($group); ?>
								</table>
								<div class="fieldset buttonset align-right">
									<button class="pagebox button-primary button-large" data-action="save"><?php echo ( $this->get( 'edit' ) != false ) ? _e( 'Update', 'pagebox' ) : _e( 'Add', 'pagebox' ); ?></button>
								</div>
							</div>

						<?php endforeach; ?>

					</div>

				<?php else: ?>

					<table>
						<?php echo $module->get_form()->render(); ?>
					</table>
					<div class="fieldset buttonset align-right">
						<button class="pagebox button-primary button-large" data-action="save"><?php echo ( $this->get( 'edit' ) != false ) ? _e( 'Update', 'pagebox' ) : _e( 'Add', 'pagebox' ); ?></button>
					</div>

				<?php endif; ?>
			</form>
		</div>
	</div>
</div>