<?php
/**
 * Element view file for post input
 * 
 * @author      Pavel
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>
<table>
	<tr class="subelement-post" data-type="post">
                        <?php
				// set default value
				if (!isset($this->values)) :
					$this->values = '';
				endif;
			?>
                        <select data-setting="post" class="make-chosen" name="<?php echo $this->getConfig( 'name' ); ?>" class="subelement" >
                                <option value=""></option>
				<?php foreach ($this->posts as $post): ?>

				<option value="<?php echo $post->post_name; ?>" <?php is_numeric( $this->values ) ? selected($post->ID, $this->values) : selected($post->post_name, $this->values); ?>>
					<?php echo $post->post_title; ?>
				</option>

				<?php endforeach;?>
			</select>
			<p class="description">
				<?php _e( 'Select specific post name to display', 'pagebox' ); ?>
			</p>
	</tr>
</table>