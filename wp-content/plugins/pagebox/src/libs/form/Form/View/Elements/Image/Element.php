<?php
/**
 * Element view file for repeater
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>

<div class="pagebox-image-preview">
	<?php if ($this->getValue() == null) : ?>
		<img src="http://placehold.it/150x150" alt="" />
	<?php else: ?>
		<?php echo wp_get_attachment_image($this->getValue()); ?>
	<?php endif; ?>
</div>
<a href="#" class="button button-secondary pagebox" data-action="image_upload">
	<?php _e('Select image', 'pagebox'); ?>
</a>
<?php echo $this->element->getRenderedTag(); ?>