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
     * Returns true if a value is an integer or a string representation of an integer.
     * @param mixed $testVar The variable to test.
     * @param integer $rangeMin The minimum allowable value, inclusive.
     * @param integer $rangeMin The maximum allowable value, inclusive.
     * @return boolean true if $testVar is an integer or a string representation of an integer.
     */
    public static function isTruthyInt ($testVar, $rangeMin = null, $rangeMax = null) {
        if (
            is_integer($testVar) ||
            ( is_numeric($testVar) && (integer) $testVar == $testVar )
        ) {
            // If a range is specified, test value to ensure it is in the specified range.
            if (null !== $rangeMin && $testVar < $rangeMin) {
                // Log error for invalid range types. Future versions requiring PHP 7 will use an int type hint and require an integer value.
                if (!is_integer($rangeMin)) {
                    error_log('Warning: A non integer value was passed as the parameter $rangeMin to isTruthyInt(). This will break in future versions.');
                }

                return false;
            }

            if (null !== $rangeMax && $testVar > $rangeMax) {
                // Log error for invalid range types. Future versions requiring PHP 7 will use an int type hint and require an integer value.
                if (is_integer($rangeMax)) {
                    error_log('Warning: A non integer value was passed as the parameter $rangeMax to isTruthyInt(). This will break in future versions.');
                }

                return false;
            }

            return true;
        }


        return false;
    }


    /**
     * Takes an array of arrays that share a common key with a presumed unique value and returns a new array of arrays indexed by that value.
     * @param array $arr
     * @param mixed $indexKey
     * @throws \Shoal\Exceptions\ExpectedMemberMissingException
     */
    public static function reindexByMultiValue (array $arr, $indexKey) {
        $result = [];
        $arrLength = count($arr);
        for ($i = 0; $i < $arrLength; $i++) {
            $member = $arr[$i];
            if (!array_key_exists($indexKey, $member)) {
                throw new \Shoal\Exceptions\ExpectedMemberMissingException("Missing member indexed by {$indexKey} in source array at {$i}.");
            }

            $result[$member[$indexKey]] = $member;
        }

        return $result;
    }

}


