<?php
/**
 * Element view file for WPeditor
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>
<button class="add-image button button-secondary"><?php _e('Add Media'); ?></button><br/><br/>

<div class="editor-tabs" style="display:none;">
	<a href="#" class="current">
		<span>
			<?php _e('Visual'); ?>
		</span>
	</a>
	<a href="#">
		<span>
			<?php _e('Text'); ?>
		</span>
	</a>
</div>

<?php
echo wp_editor($this->getValue(), $this->getID(), array(
	'textarea_name' => $this->getName(),
    'quicktags'     => false,
    'media_buttons' => false,
    'textarea_rows' => 20,
    'editor_class'  => 'pagebox pagebox-editor'
));