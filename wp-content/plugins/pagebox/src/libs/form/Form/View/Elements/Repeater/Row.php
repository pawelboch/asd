<?php
/**
 * Form table view file for repeater
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */

$buttons = $this->getConfig('buttons');
$labels  = $this->getConfig('labels');
?>

<tr class="row pagebox element-<?php echo $this->getConfig('type'); ?>" data-element="repeater">

	<th class="label">
		<?php echo $labels[ 'plural' ];?>
	</th>

	<td class="input">

		<div class="iterator">
		<?php foreach ($this->getGroups() as $group) : ?>
			<table>
				<tbody>
					<tr class="header">
						<td colspan="2">
							<?php echo $labels[ 'singular' ];?>
						</td>
					</tr>

					<?php foreach ($group as $element) : ?>
						<?php echo $element->renderRow(); ?>
					<?php endforeach; ?>

					<tr class="buttonset">
						<td colspan="2">
							<a href="#" class="button button-secondary pagebox" data-action="repeater_add">
								<?php echo $buttons['add'];?>
							</a>
							<a href="#" class="button button-secondary pagebox" data-action="repeater_remove">
								<?php echo $buttons['remove'];?>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		<?php endforeach; ?>
		</div>

		<textarea style="display:none;" class="pagebox" data-action="repeater_boilerplate">
			<?php echo $this->renderBoilerplate(); ?>
		</textarea>
		
	</td>
</tr>

