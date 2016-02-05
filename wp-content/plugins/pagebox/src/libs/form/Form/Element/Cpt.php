<?php
/**
 * Form helper
 * Single element class - textarea
 * 
 * @author      Max Matloka (max@matloka.me)
 * @package     WPGeeks
 * @subpackage  Forms
 */

class WPGeeks_Form_Element_Cpt extends WPGeeks_Form_Element
{
    public function __construct($name, array $elementConfig)
    {
        parent::__construct($name, $elementConfig);
        
        // set default tag
        $this->element->setTag('select');

        // add default name
        $this->element->setAttribute('name', $this->name);

        // set class for chosen
        $this->element->setAttribute('class', 'make-chosen');

        // set attributes
        $this->setAttributes($elementConfig);

        return $this;
    }

    public function renderElement()
    {
        // render <select> tag
        $output  = $this->element->getRenderedTag();

        // render options
        
        if ( ! $this->getConfig('post_type') ) {
            $post_type = 'post';
        } else {
            $post_type = $this->getConfig('post_type');
        }

        $options = get_posts( array(
            'post_type' => $post_type,
            'posts_per_page' => -1
        ) );

        if (is_array($options) && !empty($options)) {

            if ( $this->getConfig('empty') == true ) {
                
                $option = new WPGeeks_HTML('option');
                $option->setAttribute('value', '');
                
                $output .= $option->getRenderedTag();
                $output .= $option->getRenderedClosingTag();

            }

            foreach ($options as $post) {
                // create <option> tag
                $option = new WPGeeks_HTML('option');
                $option->setAttribute('value', $post->ID);

                // set value
                if ($this->getValue() != null && $this->getValue() == $post->ID) {
                    $option->setAttribute('selected', 'selected');
                }
                
                $output .= $option->getRenderedTag();
                $output .= $post->post_title;
                $output .= $option->getRenderedClosingTag();
            }
        }

        $output .= $this->element->getRenderedClosingTag();

        return $output;
    }
}