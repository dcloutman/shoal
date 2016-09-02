<?php
namespace TestUtils\Ui;

class Utilities {
    /**
     * A helper function for setting attibutes on objects that inherit from \Shoal\Ui|Element
     * @param \Shoal\Ui\Element $element
     * @return \Shoal\Ui\Element
     */
    public static function setCommonAttributes (\Shoal\Ui\Element $element) {
        static $callNum = 1;
        $element->id("uniqueValue{$callNum}")->class_att("freshStyle")->style('color: #c3c3c3; background-color: #030303;border: 1px solid pink;')->name('testElements[]');

        $callNum++;
        return $element;
    }
}
