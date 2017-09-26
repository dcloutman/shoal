<?php
/**
 * \Shoal\Ui\Element
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;

/**
 * An abstract class containing all common attributes shared by HTML elements. All concrete classes in Shoal\Ui are subclassed from this class.
 */
abstract class Element {
    /**
     * @var string $elementName
     * @internal
     */
    protected $elementName = '';

    /**
     * @var string $style
     * @internal
     */
    protected $style = '';

    /**
     * Combined getter / setter for $this->style
     * @param string style
     * @return mixed A string if a value for style is not passed, the current instance of the object if it is.
     */
    public function style ($style = null) {
        if (null !== $style) {
            $this->style = $style;
            return $this;
        }
        return $this->style;
    }


    /**
     * @var string $class
     * @internal
     */
    protected $class = '';

    /**
     * Combined getter / setter for $this->class. Called 'classAtt' because 'class' is a reserved keyword. :(
     * @param string class
     * @return mixed A string if a value for class is not passed, the current instance of the object if it is.
     */
    public function classAtt ($class = null) {
        if (null !== $class) {
            $this->class = $class;
            return $this;
        }
        return $this->class;
    }

    /**
     * @var string $id
     * @internal
     */
    protected $id = '';

    /**
     * Combined getter / setter for $this->id
     * @param string id
     * @return mixed A string if a value for id is not passed, the current instance of the object if it is.
     */
    public function id ($id = null) {
        if (null !== $id) {
            $this->id = $id;
            return $this;
        }
        return $this->id;
    }

    /**
     * @var string $name
     * @internal
     */
    protected $name = null;

    /**
     * Combined getter / setter for $this->name
     * @param string name
     * @return mixed A string if a value for name is not passed, the current instance of the object if it is.
     */
    public function name ($name = null) {
        if (null !== $name) {
            $this->name = $name;
            return $this;
        }
        return $this->name;
    }

    /**
     * Returns a string of attibutes. Can be called by inheriting classes to ensure consistent behavior.
     * @return string A string of attributes for use in an opening or self closing HTML tag.
     */
    public function getAttributeString () {
        $attributeString = '';

        if (!empty($this->name)) {
            $attributeString .= "name=\"{$this->name}\" ";
        }

        if (!empty($this->id)) {
            $attributeString .= "id=\"{$this->id}\" ";
        }

        if (!empty($this->class)) {
            $attributeString .= "class=\"{$this->class}\" ";
        }

        if (!empty($this->style)) {
            $attributeString .= "style=\"{$this->style}\" ";
        }

        return $attributeString;
    }

    /**
     * A parent constructor to be called by all subclasses of Element.
     */
    public function __construct() {}
}
