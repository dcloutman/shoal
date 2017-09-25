<?php
/**
 * \Shoal\F
 * @author David Cloutman
 * @package \Shoal
 * @license MIT
 */

namespace Shoal;

/**
 * A collection of static utility functions.
 */
class F {

    /**
     * Returns true if a value is an integer or s string representation of an integer.
     * @param mixed $testVar The variable to test.
     * @return boolean true if $testVar is an integer or a string representation of an integer.
     */
    public static function isTruthyInt ( $testVar ) {
        if (
            is_integer($testVar) ||
            ( is_numeric($testVar) && (integer) $testVar == $testVar )
        ) {
            return true;
        }

        return false;
    }


    /**
     * Takes an array of arrays that share a common key with a presumed unique value and returns a new array of arrays indexed by that value.
     * @param array $arr
     * @param mixed $indexKey
     */
    public static function reindexByMultiValue(array $arr, $indexKey) {
        $result = [];
        foreach ($arr as $member) {
            $result[$member[$indexKey]] = $member;
        }

        return $result;
    }

}


