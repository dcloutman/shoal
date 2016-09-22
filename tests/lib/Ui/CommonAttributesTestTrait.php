<?php
namespace TestUtils\Ui;

/**
 * A trait that can be used by classes tesing Ui\Element inheriting classes for methods that get / set  attributes. $this->element must be created in the
 * setUp() method.
 */
trait CommonAttributesTestTrait {
    public function testCommonAttributes () {
        $id = 'foo';
        $name = 'bar';
        $class = 'biz baz buz';
        $style = 'font-family: MS Comic Sans';

        $this->element->id($id);
        $this->assertEquals($id, $this->element->id());

        $this->element->name($name);
        $this->assertEquals($name, $this->element->name());

        $this->element->classAtt($class);
        $this->assertEquals($class, $this->element->classAtt());

        $this->element->style($style);
        $this->assertEquals($style, $this->element->style());

    }
}
