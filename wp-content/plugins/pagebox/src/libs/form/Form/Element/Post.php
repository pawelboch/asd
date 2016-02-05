<?php
/**
 * Form helper
 * Single element class - post selector
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */

class WPGeeks_Form_Element_Post extends WPGeeks_Form_Element
{
    public function __construct($name, array $elementConfig)
    {
        parent::__construct($name, $elementConfig);

        $this->pages = get_pages();
        $this->posts = get_posts(array(
            'posts_per_page' => -1
        ));

        $this->categories = get_categories();
        $this->tags = get_tags();

    }

    public function setValue($values)
    {
        $this->values = $values;
    }

    public function getValue()
    {
        return $this->values;
    }

    public function renderElement()
    {
        return parent::renderElement();
    }
}