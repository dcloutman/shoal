<?php
use PHPUnit\Framework\TestCase;
use Shoal\Struct\Circle\CircleNode;
use Shoal\Struct\Circle\Circle;
use Shoal\Struct\Circle\LastCircleNodeException;
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
    public function testIteration ($circle) {
        // Construct a small circle of prime numbers.
        $circle = new Circle(new NumericCircleNode(1));

        // Test counting algorithms.
        $this->assertTrue($circle->hasOnlyOneNode());
        $this->assertEquals(1, $circle->count());

        $circle->insertAfterCurrent(new NumericCircleNode(2));
        $this->assertEquals(1, $circle->getCurrent()->getValue());
        $this->assertEquals(2, $circle->getNext()->getValue());
        $this->assertEquals(2, $circle->getPrevious()->getValue());
        $this->assertEquals(1, $circle->getNext()->getNext()->getValue());
        $this->assertEquals(1, $circle->getPrevious()->getPrevious()->getValue());
        $circle->next();

        // Test counting algorithms.
        $this->assertFalse($circle->hasOnlyOneNode());
        $this->assertEquals(2, $circle->count());

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
    public function testReverseIteration ($circle) {
        // Check sanity by contatinating, adding, and multiplying all values.
        $cat = '';
        $sum = 0;
        $product = 1;

        do {
            $cat .= $circle->getCurrent();
            $sum += $circle->getCurrent()->getValue();
            $product *= $circle->getCurrent()->getValue();
            $circle->reverse();
        } while (!$circle->isFirstCurrent());

        $this->assertEquals('1117532', $cat);
        $this->assertEquals(29, $sum);
        $this->assertEquals(2310, $product);

        return $circle;
    }

    /**
     * @depends testReverseIteration
     */
    public function testSetFirst ($circle) {
        $circle->rewind();

        $this->assertEquals(1, $circle->getCurrent()->getValue());
        $this->assertEquals(1, $circle->getFirst()->getValue());
        $this->assertTrue($circle->getCurrent() === $circle->getFirst());
        $this->assertTrue($circle->isFirstCurrent());

        // Store a reference to the original first node.
        $originalFirst = $circle->getFirst();

        //Turn twice.
        $circle->turn();
        $circle->turn();


        // Ensure that turning the circle worked as expected.
        $this->assertFalse($circle->getCurrent() === $circle->getFirst());
        $this->assertFalse($circle->isFirstCurrent());
        $this->assertEquals(3, $circle->getCurrent()->getValue());
        $this->assertEquals(1, $circle->getFirst()->getValue());

        // Now set the first node to the current node. 
        $circle->setFirst($circle->getCurrent());

        // Sanity check.
        $this->assertEquals(3, $circle->getCurrent()->getValue());
        $this->assertEquals(3, $circle->getFirst()->getValue());
        $this->assertTrue($circle->getCurrent() === $circle->getFirst());
        $this->assertTrue($circle->isFirstCurrent());

        // Turn again and sanity check.
        $circle->turn();
        $this->assertFalse($circle->getCurrent() === $circle->getFirst());
        $this->assertFalse($circle->isFirstCurrent());
        $this->assertEquals(5, $circle->getCurrent()->getValue());
        $this->assertEquals(3, $circle->getFirst()->getValue());

        // Now rewind and check that it points to the new first node.
        $circle->rewind();
        $this->assertEquals(3, $circle->getCurrent()->getValue());
        $this->assertEquals(3, $circle->getFirst()->getValue());
        $this->assertTrue($circle->getCurrent() === $circle->getFirst());
        $this->assertTrue($circle->isFirstCurrent());


        // Now return the circle to it's original state.
        $circle->setFirst($originalFirst);

        $this->assertEquals(1, $circle->getFirst()->getValue());
        $this->assertEquals(3, $circle->getCurrent()->getValue());

        $circle->rewind();
        $this->assertEquals(1, $circle->getCurrent()->getValue());
        $this->assertTrue($circle->getCurrent() === $circle->getFirst());
        $this->assertTrue($circle->isFirstCurrent());

        return $circle;
    }


    /**
     * @depends testSetFirst
     */
    public function testInsertBeforeCurrent ($circle) {
        // Sanity test.
        $this->assertTrue($circle->isFirstCurrent());
        $this->assertEquals(1, $circle->getCurrent()->getValue());
        $this->assertEquals(11, $circle->getPrevious()->getValue());
        $this->assertEquals(2, $circle->getNext()->getValue());

        $circle->insertBeforeCurrent(new NumericCircleNode(-1));

        $this->assertEquals(1, $circle->getCurrent()->getValue());
        $this->assertEquals(-1, $circle->getPrevious()->getValue());
        $this->assertEquals(2, $circle->getNext()->getValue());

        $circle->reverse();
        $this->assertEquals(-1, $circle->getCurrent()->getValue());
        $this->assertEquals(11, $circle->getPrevious()->getValue());
        $this->assertEquals(1, $circle->getNext()->getValue());

        return $circle;
    }

    /**
     * @depends testSetFirst
     */
    public function testRemove ($circle) {
        $expectedCount = 7;

        // Sanity test.
        $this->assertEquals(-1, $circle->getCurrent()->getValue());
        $this->assertEquals($expectedCount, $circle->count());
        $this->assertEquals($expectedCount, count($circle));

        $circle->remove($circle->getPrevious());
        $expectedCount--;

        $this->assertEquals($expectedCount, count($circle));
        $this->assertEquals(7, $circle->getPrevious()->getValue());
        $this->assertEquals(1, $circle->getNext()->getValue());

        // The next node is also the first node, so its next node should become the first node.        $circle->remove($circle->getNext());
        $circle->remove($circle->getNext());
        $expectedCount--;

        $this->assertEquals($expectedCount, count($circle));
        $this->assertEquals(7, $circle->getPrevious()->getValue());
        $this->assertEquals(2, $circle->getNext()->getValue());

        // Removing the current node will advance current to the next node, which should also be 
        // the first node.
        $circle->remove($circle->getCurrent());
        $expectedCount--;

        $this->assertEquals($expectedCount, count($circle));
        $this->assertTrue($circle->isFirstCurrent());
        $this->assertEquals(2, $circle->getCurrent()->getValue());
        $this->assertEquals(7, $circle->getPrevious()->getValue());
        $this->assertEquals(3, $circle->getNext()->getValue());

        // Attempt to remove all the nodes. This should throw an exception.
        $e = null;
        while (count($circle)) {
            try {
                $circle->remove($circle->getCurrent());
                $expectedCount--;

                $this->assertEquals($expectedCount, count($circle));
            }
            catch (LastCircleNodeException $e) {
                break;
            }
        }

        // Make sure the exception was caught and is of the right type.
        $this->assertNotNull($e);
        $this->assertTrue($e instanceof LastCircleNodeException);

        // The circle should have only one node at this point and it should be linked to
        // itself.
        $this->assertEquals($expectedCount, count($circle));
        $this->assertEquals(1, count($circle));
        $this->assertEquals(7, $circle->getCurrent()->getValue());
        $this->assertTrue($circle->getCurrent() === $circle->getNext());
        $this->assertTrue($circle->getCurrent() === $circle->getPrevious());
        $this->assertTrue($circle->getNext() === $circle->getPrevious());

        return $circle;
    }
}
