<?php
/**
 * View file for listing view
 *
 * It displays all registered modules and
 * allows to select module to define
 * 
 * @since       1.0.0
 * @author      Max Matloka (max@matloka.me)
 *
 * @package     pagebox
 * @subpackage  pagebox/partials/predefined/listing
 */
?>

<div id="pagebox-modules">
	<?php if ( ! $this->get( 'modules' ) ): ?>
	<span class="pagebox-notice">
		<p>
			<?php _e('Please register boxes first.', 'pagebox'); ?>
		</p>
	</span>
	<?php else: ?>
	<?php /*<div class="pagebox-search">
		<input type="text" class="pagebox" data-action="filter" placeholder="<?php _e('Filter modules', 'pagebox'); ?>" />
	</div>*/ ?>
	<ul>
		<?php 
			foreach ( $this->get( 'modules' ) as $module ):
			$moduleConfig = $module->get_config();
		?>
		<li class="pagebox module module-<?php echo $moduleConfig['slug']; ?>" data-action="select" data-module="<?php echo $moduleConfig['slug']; ?>" data-title="<?php echo strtolower($moduleConfig['title']); ?>">
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