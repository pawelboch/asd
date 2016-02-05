<?php
/**
 * Form helper
 * Repeater class
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */

class WPGeeks_Form_Element_Repeater extends WPGeeks_Form_Element
{
    private $elements;
    private $values;

    public function __construct($name, array $elementConfig)
    {
        $this->name     = $name;
        $this->config   = $elementConfig;

        $this->elements = array();
        $this->values   = array();

        return $this;
    }

    public function getGroups()
    {
        return $this->elements;
    }

    public function setValue($values)
    {
        $this->values = $values;
    }

    public function getValue()
    {
        return $this->values;
    }

    public function registerSubelements()
    {
        $i = 0;

        // register groups of elements
        foreach ($this->iterator as $group) {

            // register elements for each groups
            foreach ($this->config['fields'] as $field) {
                $class = 'WPGeeks_Form_Element_' . ucfirst($field['type']);
            
                if (!class_exists($class)) {
                    continue;
                }

                // store original name 
                $fieldName = $field['name'];

                // update field name
                $field['name'] = $this->getConfig('name') . '[' . $i . '][' . $field['name'] . ']';

                // add class name
                if (!isset($field['class'])) {
                    $field['class'] = 'subelement';
                } else {
                    $field['class'] .= ' subelement';
                }

                // generate new input
                $input = new $class($field['name'], $field);

                // set validators
                if (isset($field['validators']) && !empty($field['validators'])) {
                    foreach ($field['validators'] as $validator) {

                        $input->setValidator($validator);

                    }
                }

                // set value
                if (isset($group[$fieldName])) {
                    $input->setValue($group[$fieldName]);
                }

                $this->elements[$i][] = $input;
            }

            $i++;
        }

        return $this;
    }

    public function renderRow($template = null) 
    {
        $values = $this->getValue();

        if (empty($values)) {
            // if values array is empty just display first group of inputs
            $this->iterator = array(array());

        } else {
            // if there are some values register subelements for them
            $this->iterator = $values;

        }
        
        $this->registerSubelements();
        
        return parent::renderRow($template);
    }

    public function renderBoilerplate()
    {
        $boilerplate = '';

        $buttons = $this->getConfig( 'buttons' );
        $labels  = $this->getConfig( 'labels' );
        $groups  = $this->getGroups();
        $group   = end($groups);

        $boilerplate .= '<tr class="header"><td colspan="2">' . $labels[ 'singular' ] . '</td></tr>';

        foreach ($group as $element) {
            $element->setValue('');
            $boilerplate .= $element->renderRow();
        }

        $boilerplate .= '<tr class="buttonset"><td colspan="2"><a href="#" class="button button-secondary pagebox" data-action="repeater_add">' . $buttons['add'] . '</a><a href="#" class="button button-secondary pagebox" data-action="repeater_remove">' . $buttons['remove'] . '</a></td></tr>';

        return json_encode(str_replace('\'', '\"', $boilerplate));
    }

    public function renderElement() {}

}