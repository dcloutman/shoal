<?php
/**
 * \Shoal\Struct\Circle\CircleNode
 *
 * The Circle object expects doubly linked nodes. In use, it is expected that this class will
 * be extended to include whatever data each node needs to store.
 *
 * It is important to note that Circle object are responsible for maintaining relationships between
 * nodes, so setting next or previous nodes directly on the node object will break the integrity of
 * the circle.
 *
 * @package \Shoal\Struct\Circle
 * @author David Cloutman
 * @license MIT
 */
declare(strict_types=1);
namespace Shoal\Struct\Circle;


/**
 * This class defines individual nodes to be used with the Circle data structure.
 */
class CircleNode {
    /**
     * @var \Shoal\Struct\Circle\CircleNode Stores a reference to the next node in a circle.
     * @internal
     */
    protected $nextNode;

    /**
     * @var \Shoal\Struct\Circle\CircleNode Stores a reference to the previous node in a circle.
     * @internal
     */
    protected $previousNode;

    /**
     * Creates a new CircleNode and links it to itself.
     */
    public function __construct() {
        // Default next and previous nodes to the current node.
        $this->nextNode = $this;
        $this->previousNode = $this;
    }

    /**
     * Changes the reference to the next node in the circle.
     * @param CircleNode $nextNode
     * @return void
     * @internal
     */
    public function setNext(CircleNode $nextNode): void {
        $this->nextNode = $nextNode;
    }

    /**
     * Get a reference to the next CircleNode in a circle.
     * @return CircleNode The next node in the circle.
     */
    public function getNext(): CircleNode {
        return $this->nextNode;
    }

    /**
     * Changes the reference to the previous node in the circle.
     * @param CircleNode $previousNode
     * @return void
     * @internal
     */
    public function setPrevious(CircleNode $previousNode): void {
        $this->previousNode = $previousNode;
    }

    /**
     * Get a reference to the next CircleNode in a circle.
     * @return CircleNode The previous node in the circle.
     */
    public function getPrevious(): CircleNode {
        return $this->previousNode;
    }
}
