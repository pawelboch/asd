<?php
/**
 * Form helper
 * Single element class - WordPress editor
 * 
 * @author      Kuba Mikita
 * @package     WPGeeks
 * @subpackage  Forms
 */

class WPGeeks_Form_Element_Editor extends WPGeeks_Form_Element {

    protected $media_buttons;

    public function __construct($name, array $elementConfig) {

        parent::__construct($name, $elementConfig);

    }
    
    public function setValue($value) {
       
       $this->element->setAttribute('value', wpautop( $value ) );

       return $this;
   }

}