<?php
use PHPUnit\Framework\TestCase;
use Shoal\Struct\Circle\CircleNode;
use Shoal\Struct\Circle\Circle;
use TestUtils\Struct\Circle\NumericCircleNode;

class CircleTest extends TestCase {
    public function setUp () {
    }

    /**
     * @depends CircleNodeTest::testPrevious
     */
    public function testConstruct () {
        $testNode = new CircleNode();
        $circle = new Circle($testNode);
        $this->assertInstanceOf(Circle::class, $circle);

        // Test that the internal linking on the first node is set up.
        $this->assertNotNull($circle->getFirst());
        $this->assertNotNull($circle->getNext());
        $this->assertNotNull($circle->getPrevious());
        $this->assertTrue($circle->getCurrent() === $circle->getNext());
        $this->assertTrue($circle->getCurrent() === $circle->getPrevious());
        $this->assertTrue($circle->getNext() === $circle->getPrevious());
        
        return $circle;
    }

    /**
     * @depends testConstruct
     */
    public function testIteration () {
        // Construct a small circle of prime numbers.
        $circle = new Circle(new NumericCircleNode(1));
        $circle->insertAfterCurrent(new NumericCircleNode(2));
        $circle->next();
        $circle->insertAfterCurrent(new NumericCircleNode(3));
        $circle->next();
        $circle->insertAfterCurrent(new NumericCircleNode(5));
        $circle->next();
        $circle->insertAfterCurrent(new NumericCircleNode(7));
        $circle->next();
        $circle->insertAfterCurrent(new NumericCircleNode(11));
        $circle->next();

        $circle->rewind();

        // Check sanity by contatinating, adding, and multiplying all values.
        $cat = '';
        $sum = 0;
        $product = 1;

        do {
            $cat .= $circle->getCurrent();
            $sum += $circle->getCurrent()->getValue();
            $product *= $circle->getCurrent()->getValue();
            $circle->turn();
        } while (!$circle->isFirstCurrent());

        $this->assertEquals('1235711', $cat);
        $this->assertEquals(29, $sum);
        $this->assertEquals(2310, $product);

        return $circle;
    }

    /**
     * @depends testIteration
     */
    public function testSetFirstNode ($circle) {
        //$circle->setFirstNode($testNode);


        return $circle;
    }

    /** depends tes
    public function testInsertNodeAfterCurrent () {

    }*/
}
