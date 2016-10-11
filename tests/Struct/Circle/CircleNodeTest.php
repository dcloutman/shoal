<?php
use PHPUnit\Framework\TestCase;
use Shoal\Struct\Circle\CircleNode;

class CircleNodeTest extends TestCase {
    public function setUp () {
    }

    /**
     */
    public function testConstruct () {
        $node = new CircleNode() ;

        $this->assertInstanceOf(CircleNode::class, $node);

        return $node;
    }


    /**
     * @depends testConstruct
     */
    public function testNext ($node) {
        // By default the next node should be the current node.
        $this->assertTrue($node === $node->getNext());

        $newNode = new CircleNode();

        $this->assertFalse($node === $newNode);

        $node->setNext($newNode);
        $this->assertTrue($newNode === $node->getNext());
        $this->assertFalse($node === $node->getNext());

        return $node;
    }

    /**
     * @depends testNext
     */
    public function testPrevious ($node) {
        // By default the previous node should be the current node.
        $this->assertTrue($node === $node->getPrevious());
        $newNode = new CircleNode();

        $this->assertFalse($node === $newNode);

        $node->setPrevious($newNode);
        $this->assertTrue($newNode === $node->getPrevious());
        $this->assertFalse($node === $node->getPrevious());

        return $node;
    }
}