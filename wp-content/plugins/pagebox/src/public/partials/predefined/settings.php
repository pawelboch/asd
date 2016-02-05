<?php
/**
 * View file for settings view
 *
 * It displays all module settings
 * to define
 * 
 * @since       1.0.0
 * @author      Max Matloka (max@matloka.me)
 *
 * @package     pagebox
 * @subpackage  pagebox/partials/predefined/settings
 */

if ( ! $this->get( 'module' )) : ?>

<p class="pagebox-notice">
	<?php _e('Please, select module you\'d like to define and use in the future.', 'pagebox'); ?>
</p>

<?php else : ?>

<div class="pagebox-form">
	<table>
		<?php echo $this->get( 'module' )->get_form()->render(); ?>
	</table>
</div>

<input type="hidden" name="pagebox_module" value="<?php echo $this->get( 'module' )->get_slug(); ?>"/>

<?php endif; ?>

