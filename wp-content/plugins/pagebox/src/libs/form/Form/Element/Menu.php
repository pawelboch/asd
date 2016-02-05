<?php
/**
 * Form helper
 * Single element class - WordPress Menu
 * 
 * @author      Kuba Mikita
 * @package     WPGeeks
 * @subpackage  Forms
 */

class WPGeeks_Form_Element_Menu extends WPGeeks_Form_Element
{
    public function __construct($name, array $elementConfig)
    {
        parent::__construct($name, $elementConfig);
        
        // set default tag
        $this->element->setTag('select');

        // add default name
        $this->element->setAttribute('name', $this->name);

        // set attributes
        $this->setAttributes($elementConfig);

        return $this;
    }

    public function renderElement()
    {
        // render <select> tag
        $output  = $this->element->getRenderedTag();

        // render options
        $options = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 

        if (is_array($options) && !empty($options)) {

            foreach ($options as $menu) {
                // create <option> tag
                $option = new WPGeeks_HTML('option');
                $option->setAttribute('value', $menu->term_id);

                // set value
                if ($this->getValue() != null && $this->getValue() == $menu->term_id) {
                    $option->setAttribute('selected', 'selected');
                }
                
                $output .= $option->getRenderedTag();
                $output .= $menu->name;
                $output .= $option->getRenderedClosingTag();
            }

        }

        $output .= $this->element->getRenderedClosingTag();

        return $output;
    }
}