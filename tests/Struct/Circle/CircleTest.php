<?php
use PHPUnit\Framework\TestCase;
use Shoal\Struct\Circle\CircleNode;
use Shoal\Struct\Circle\Circle;
use TestUtils\Struct\Circle\NumericCircleNode;

class CircleTest extends TestCase {
    public function setUp () {
    }

    public function testConstruct () {
        $testNode = new CircleNode();
        $circle = new Circle($testNode);
        $this->assertInstanceOf(Circle::class, $circle);

        // Test that the internal linking on the first node is set up.
        $this->assertNotNull($circle->getFirstNode());
        $this->assertNotNull($circle->getNextNode());
        $this->assertNotNull($circle->getPreviousNode());
        $this->assertTrue($circle->getCurrentNode() === $circle->getNextNode());
        $this->assertTrue($circle->getCurrentNode() === $circle->getPreviousNode());
        $this->assertTrue($circle->getNextNode() === $circle->getPreviousNode());
        
        return $circle;
    }

    /**
     * @depends testConstruct
     */
    public function testIteration () {
        $circle = new Circle(new NumericCircleNode(1));

        $circle->insertNodeAfterCurrent(new NumericCircleNode(2));
        $circle->next();
        $circle->insertNodeAfterCurrent(new NumericCircleNode(3));
        $circle->next();
        $circle->insertNodeAfterCurrent(new NumericCircleNode(5));
        $circle->next();

        $circle->rewind();

        $cat = '';
        $sum = 0;
        $product = 1;

        do {
            $cat .= $circle->getCurrentNode();
            $sum += $circle->getCurrentNode()->getValue();
            $product *= $circle->getCurrentNode()->getValue();
            $circle->turn();
        } while (!$circle->isFirstCurrent());

        $this->assertEquals('1235', $cat);
        $this->assertEquals(11, $sum);
        $this->assertEquals(30, $product);

        return $circle;
    }

    /**
     * @depends testConstruct
     */
    public function testSetFirstNode ($circle) {
        //$circle->setFirstNode($testNode);


        return $circle;
    }

    /** depends tes
    public function testInsertNodeAfterCurrent () {

    }*/
}
