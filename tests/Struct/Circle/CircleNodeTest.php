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
        $this->assertTrue($node === $node->getNextNode());

        $newNode = new CircleNode();

        $this->assertFalse($node === $newNode);

        $node->setNextNode($newNode);
        $this->assertTrue($newNode === $node->getNextNode());
        $this->assertFalse($node === $node->getNextNode());

        return $node;
    }

    /**
     * @depends testNext
     */
    public function testPrevious ($node) {
        // By default the previous node should be the current node.
        $this->assertTrue($node === $node->getPreviousNode());
        $newNode = new CircleNode();

        $this->assertFalse($node === $newNode);

        $node->setPreviousNode($newNode);
        $this->assertTrue($newNode === $node->getPreviousNode());
        $this->assertFalse($node === $node->getPreviousNode());

        return $node;
    }
}