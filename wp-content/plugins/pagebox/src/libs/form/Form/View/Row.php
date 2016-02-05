<?php
/**
 * Form table view file
 * 
 * @author      Kuba Mikita
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>

<tr class="row element-<?php echo $this->getConfig('type'); ?>" data-element="<?php echo $this->getConfig('type'); ?>">
	<?php if ($this->getConfig('label')) : ?>
	<th class="label" scope="row">
		<?php echo $label->getRenderedTag() . $this->getConfig('label') . $label->getRenderedClosingTag(); ?>
	</th>
	<?php endif; ?>

	<?php if ($this->getConfig('label')) : ?>
	<td class="input">
	<?php else: ?>
	<td class="input full-size" colspan="2">
	<?php endif; ?>

		<?php echo $element; ?>
		
		<?php if ($this->getConfig('description')): ?>
			<p class="description"><?php echo $this->getConfig('description'); ?></p>
		<?php endif; ?>

	</td>
</tr>