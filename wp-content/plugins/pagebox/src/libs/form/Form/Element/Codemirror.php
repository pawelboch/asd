<?php
/**
 * Form helper
 * Single element class - Codemirror editor
 *
 * Alvailable modes:
 * - htmlmixed
 * - javascript
 * - css
 * 
 * @author      Kuba Mikita
 * @package     WPGeeks
 * @subpackage  Forms
 */

class WPGeeks_Form_Element_Codemirror extends WPGeeks_Form_Element {

    public function __construct($name, array $elementConfig) {

        parent::__construct($name, $elementConfig);

    }

}