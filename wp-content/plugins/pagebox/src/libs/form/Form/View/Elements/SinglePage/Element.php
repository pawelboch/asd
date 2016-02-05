<?php
/**
 * Element view file for page input
 * 
 * @author      Pavel modified by Tomek & Szymek & Darek
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>
<table>
	<tr class="subelement-post" data-type="page">
                        <?php
				// set default value
				if (!isset($this->values)) :
					$this->values = '';
				endif;
                                echo $this->values;
			?>
                        <select data-setting="page" class="make-chosen subelement" name="<?php echo $this->getConfig( 'name' ); ?>" >
                                <option value=""></option>
				<?php foreach ($this->pages as $page): ?>
                    <option value="<?php echo $page->post_name; ?>" <?php selected($page->post_name, $this->values); ?>>
                        <?php             
                        if( $page->post_parent != '' ){
                             $parent = get_post( $page->post_parent ); ?>                        
                                <optgroup label="<?php echo ( $parent ) ? $parent->post_title : ''; ?>">                    
                                    <option value="<?php echo ( $parent ) ? $parent->post_name : ''; ?>"><?php echo ( $parent ) ? $parent->post_title : ''; ?></option>
                                    <option value="<?php echo $page->post_name; ?>"><?php echo $page->post_title; ?> </option>
                                </optgroup>                         

                        <?php 
                            } else {
                                $parent = false;      
                            ?>
                                <option value="<?php echo $page->post_name; ?>"><?php echo $page->post_title; ?> </option>
                        <?php
                            }
                            ?>
				    </option>
				<?php endforeach;?>
			</select>
	</tr>
</table>