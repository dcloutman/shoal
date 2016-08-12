<?php
use PHPUnit\Framework\TestCase;
use Shoal\Math\Stats;

class StatsTest extends TestCase {
    public function testMean () {
        $this->assertEquals(7, Stats::mean($this->getTestInts()));
    }

    public function testMedian () {
        $this->assertEquals(5, Stats::median([2, 8, 4, 6]));
        $this->assertEquals(6, Stats::median([2, 8, 4, 13, 6]));

        $this->assertEquals(7, Stats::median($this->getTestInts()));
    }

    public function testStddev () {
        $this->assertEquals(2.9832867780353, Stats::stddev($this->getTestInts()));
    }

    private function getTestInts () {
        return [9, 2, 5, 4, 12, 7, 8, 11, 9, 3, 7, 4, 12, 5, 4, 10, 9, 6, 9, 4];
    }
}

