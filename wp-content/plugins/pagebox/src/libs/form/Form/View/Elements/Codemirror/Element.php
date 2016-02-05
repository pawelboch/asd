<?php
/**
 * Element view file for Codemirror
 * 
 * @author      Kuba Mikita
 * @package     WPGeeks
 * @subpackage  Forms
 */
?>

<textarea class="codemirror" data-mode="<?php echo $this->getConfig('mode'); ?>" name="<?php echo $this->getName(); ?>"><?php echo $this->getValue(); ?></textarea>