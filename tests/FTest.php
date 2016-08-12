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
}

