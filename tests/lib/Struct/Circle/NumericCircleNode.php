<?php
namespace TestUtils\Struct\Circle;

class NumericCircleNode extends \Shoal\Struct\Circle\CircleNode  {
    protected $value = 0;

    function __construct ($value) {
        if (!is_numeric($value)) {
            throw new Exception('Expecting a numeric value. What the hell. man?');
        }

        parent::__construct();

        $this->value = $value;
    }

    function getValue() {
        return $this->value;
    }

    function __toString () {
        return (string) $this->value;
    }
}
