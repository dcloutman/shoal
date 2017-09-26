<?php
/**
 * \Shoal\Ui\CheckableInput
 * @author David Cloutman
 * @package \Shoal\Ui
 * @license MIT
 */

namespace Shoal\Ui;


/** A parent class for checkboxes and radio buttons or any input that uses a "checked" attibute.
 */
abstract class CheckableInput extends Input {
    /**
     * @var boolean $checked
     * @internal
     */
    protected $checked =  false;

    /**
     * Combined getter / setter for $this->checked
     * @param boolean $checked
     * @return mixed A boolean if a value for checked is not passed, the current instance of the object if it is.
     */
    public function checked ($checked = null) {
        if (null !== $checked) {
            $this->checked = $checked;
            return $this;
        }
        return $this->checked;
    }

    /**
     * A parent constructor to be called by all subclasses of CheckableInput.
     */
    function __construct () {
        parent::__construct();
    }
}
