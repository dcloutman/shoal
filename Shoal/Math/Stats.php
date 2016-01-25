<?php
namespace Shoal\Math;

class Stats {
	/** Computes the standard deviation of an array of numbers.
	 *  @param array $num_set
	 *  @return float
	 */
	public static function stddev ($num_set) {
		$variance = self::variance($num_set);

		// Now return the square root of that average.
		return pow($variance, .5);
	}

	/** Compute the varience of a numeric set. This method is used to compute standard deviation.
	 *  @param array $num_set
	 *  @return float
	 */
	public static function variance ($num_set) {
		$mean = self::mean($num_set);

		// For each number: subtract the mean and square the result.
		$squared_diffs = [];
		foreach ($num_set as $x) {
			$squared_diffs[] = pow(($x - $mean), 2);
		}

		// Average the squared diff.
		return self::mean($squared_diffs);
	}

	/** Compute the mean of a numeric set.
	 *  @param array $num_set
	 *  @return float
	 */
	public static function mean ($num_set) {
		$sum = array_sum($num_set);
		$card = count($num_set);

		return $sum / $card;
	}


	public static function median ($num_set) {
		$num_set = sort($num_set);

		// Get the cardinality of the set.
		$card = count($num_set);

		// There are an even number of items in the set
		if (0 == $card % 2) {
			// Return the average of the two median values.
			return $num_set[self::mean([ floor($card / 2), ceil($card / 2) ])];
		}

		// Odd number of items in the set.
		return $num_set[$card / 2];

	}
}

/*
$test_vals = [9, 2, 5, 4, 12, 7, 8, 11, 9, 3, 7, 4, 12, 5, 4, 10, 9, 6, 9, 4];
echo count($test_vals) . "\n";
echo Stats::stddev($test_vals) . "\n";
echo Stats::mean($test_vals) . "\n";
*/
