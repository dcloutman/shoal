<?php
/** A collection of static utility functions.
 */
class F {

	/** Returns true if a value is an integer or s string representation of an integer.
	 *  @param mixed $test_var The variable to test.
	 *  @return boolean true if $test_var is an integer or a string representation of an integer.
	 */
	public static function is_truthy_int ( $test_var ) {
		if (
			is_integer($test_var) ||
			( is_numeric($test_var) && (integer) $test_var == floor($test_var) )
		) {
			return true;
		}

		return false;
	}


	/** Takes an array of arrays that share a common key with a presumed unique value and returns a new array of arrays indexed by that value.
	 */
	public static function reindex_by_multi_value($array, $index_key) {
		$result = [];
		foreach ($array as $member) {
			$result[$member[$index_key]] = $member;
		}

		return $result;
	}

}

