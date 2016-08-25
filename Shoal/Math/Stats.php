<?php
namespace Shoal\Math;

/**
 * A collection of static methods for common statistical computations.
 */
class Stats {
	/** Computes the standard deviation of an array of numbers.
	 *  @param array $numSet
	 *  @return float
	 */
	public static function stddev (array $numSet) {
		$variance = self::variance($numSet);

		// Now return the square root of that average.
		return pow($variance, .5);
	}

	/** Compute the varience of a numeric set. This method is used to compute standard deviation.
	 *  @param array $numSet
	 *  @return float
	 */
	public static function variance (array $numSet) {
		$mean = self::mean($numSet);

		// For each number: subtract the mean and square the result.
		$squaredDiffs = [];
		foreach ($numSet as $x) {
			$squaredDiffs[] = pow(($x - $mean), 2);
		}

		// Average the squared diff.
		return self::mean($squaredDiffs);
	}

	/** Compute the mean of a numeric set.
	 *  @param array $numSet
	 *  @return float
	 */
	public static function mean (array $numSet) {
		$sum = array_sum($numSet);
		$cardinality = count($numSet);

		return $sum / $cardinality;
	}


	/** Compute the median of a numeric set.
	 *  @param array $numSet
	 *  @return float
	 */
	public static function median (array $numSet) {
		sort($numSet); // Array is passed by reference in sort().

		// Get the cardinality of the set.
		$cardinality = count($numSet);

		// There are an even number of items in the set
		if (0 == $cardinality % 2) {
			// Return the average of the two median values.
			return self::mean([
				$numSet[floor(($cardinality - 1) / 2)],
				$numSet[ceil(($cardinality - 1) / 2)],
			]);
		}

		// Odd number of items in the set.
		return $numSet[floor(($cardinality - 1)/ 2)];
	}
}

