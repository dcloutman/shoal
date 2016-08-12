<?php
use PHPUnit\Framework\TestCase;
use Shoal\F;

class FTest extends TestCase {
    public function testIsTruthyInt () {

        $this->assertEquals(true, F::isTruthyInt(0));
        $this->assertEquals(true, F::isTruthyInt(-1));
        $this->assertEquals(true, F::isTruthyInt(1));
        $this->assertEquals(true, F::isTruthyInt(3141));
        $this->assertEquals(true, F::isTruthyInt('0'));
        $this->assertEquals(true, F::isTruthyInt('1'));
        $this->assertEquals(true, F::isTruthyInt('-1'));
        $this->assertEquals(true, F::isTruthyInt('314159'));
        $this->assertEquals(false, F::isTruthyInt(3.14159));
        $this->assertEquals(false, F::isTruthyInt('3.14159'));
        $this->assertEquals(false, F::isTruthyInt('Moo cow'));
        $this->assertEquals(false, F::isTruthyInt([]));

    }

    public function testReindexByMultiValue () {
        $sourceArray = [
            ['id' => 'one', 'data' => 1],
            ['id' => 'two', 'data' => 2],
            ['id' => 'three', 'data' => 3],
            ['id' => 'four', 'data' => 4],
            ['id' => 'five', 'data' => 5],
            ['id' => 'six', 'data' => 6],
            ['id' => 'one-thousand twenty-four', 'data' => 1024],
        ];
        
        $resultArray = F::reindexByMultiValue($sourceArray, 'id');
        
        $this->assertArrayHasKey('one', $resultArray);
        $this->assertEquals(1, $resultArray['one']['data']);
        $this->assertArrayHasKey('two', $resultArray);
        $this->assertEquals(2, $resultArray['two']['data']);
        $this->assertArrayHasKey('three', $resultArray);
        $this->assertEquals(3, $resultArray['three']['data']);
        $this->assertArrayHasKey('one-thousand twenty-four', $resultArray);
        $this->assertEquals(1024, $resultArray['one-thousand twenty-four']['data']);
        $this->assertEquals(false, isset($resultArray['1']));
        $this->assertEquals(false, isset($resultArray[0]));
        $this->assertEquals(count($sourceArray), count($resultArray));
    }
}

