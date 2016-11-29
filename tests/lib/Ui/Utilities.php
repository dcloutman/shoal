<?php
namespace TestUtils\Ui;

class Utilities {
    /**
     * A helper function for setting attibutes on objects that inherit from \Shoal\Ui|Element
     * @param \Shoal\Ui\Element $element
     * @return \Shoal\Ui\Element
     */
    public static function setCommonAttributes (\Shoal\Ui\Element $element) {
        $element->id("uniqueValue1")->classAtt("freshStyle")->style('color: #c3c3c3; background-color: #030303;border: 1px solid pink;')->name('testElements[]');

        return $element;
    }
}
