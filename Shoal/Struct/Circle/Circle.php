<?php
/**
 * \Shoal\Struct\Circle\Circle
 *
 * An implementation of a circularly linked list data type. This data type is useful for
 * lists of items that occur in a repeating sequence where the beginning and end are
 * conceptually linked.
 *
 * Circle instances wrap CircleNode instances. The CircleNode class can be extended to store
 * whatever data the user wishes to place in the Circle.
 *
 * @package \Shoal\Struct\Circle
 * @author David Cloutman
 * @license MIT
 */
declare(strict_types=1);
namespace Shoal\Struct\Circle;


/**
 * This class defines the Circle type which is a circularly linked list.
 */
class Circle implements \Iterator, \Countable {
    /**
     * @var \Shoal\Struct\Circle\CircleNode Stores a reference to the first node in the circle.
     * @internal
     */
    protected $firstNode = null;

    /**
     * @var integer Tracks the number of CircleNode objects in the circle.
     * @internal
     */
    protected $count = 0;

    /**
     * @var \Shoal\Struct\Circle\CircleNode Stores an internal reference pointing to the current node in a circle.
     * @internal
     */
    protected $currentNode = null;

    /**
     * This construction optionally takes an initial node.
     * @param CircleNode|null $first Sets the first node in the circle by reference. Empty Circle instances are not allowed.
     */
    public function __construct(CircleNode $first) {
        $this->setFirst($first);
        $this->setCurrent($first);

        $this->count++;
    }

    /**
     * Set the first node in the circle.
     * @param CircleNode $first Sets the first node in the circle by reference.
     * @return void
     */
    public function setFirst(CircleNode $first): void {
        $this->firstNode = $first;
    }

    /**
     * Cet a reference to the first node being pointed to in the.
     * @return CircleNode
    */
    public function getFirst(): CircleNode {
        return $this->firstNode;
    }

    /**
     * Set the current node in the circle by reference.
     * @param CircleNode $current Sets the current node in the circle by reference.
     */
    public function setCurrent(CircleNode $current): void {
        $this->currentNode = $current;
   }

    /**
     * Cet a reference to the current node being pointed to in the.
     * @return CircleNode
    */
    public function getCurrent(): CircleNode {
        return $this->currentNode;
    }

    /**
     * Get the next node in the circle without changing the current node.
     * @return CircleNode The next node in the circle.
     */
    public function getNext(): CircleNode {
        return $this->currentNode->getNext();
    }

    /**
     * Get the previous node in the circle without changing the current node.
     * @return CircleNode The previous node in the circle.
     */
    public function getPrevious(): CircleNode {
        return $this->currentNode->getPrevious();
    }

    /**
     * Adds a CircleNode ahead of the current node.
     * @param CircleNode $newNode
     */
    public function insertAfterCurrenth(CircleNode $newNode): CircleNode {
        // Set links inside new node.
        $newNode->setNext($this->currentNode->getNext());
        $newNode->setPrevious($this->currentNode);

        // Link adjacent nodes to new node.
        $this->currentNode->getNext()->setPrevious($newNode);
        $this->currentNode->setNext($newNode);

        $this->count++;
    }

    /**
     * Adds a CircleNode before the current node.
     * @param CircleNode $newNode
     */
    public function insertBeforeCurrent(CircleNode $newNode): CircleNode {
        // Set links inside new node.
        $newNode->setPrevious($this->currentNode->getPrevious());
        $newNode->setNext($this->currentNode);

        // Link adjacent nodes to new node.
        $this->currentNode->getPrevious()->setNext($newNode);
        $this->currentNode->setPrevious($newNode);

        $this->count++;
    }

    /**
     * Returns true when the first node is current.
     * @return boolean
     */
    public function isFirstCurrent(): boolean {
        if ($this->currentNode === $this->firstNode) {
            return true;
        }

        return false;
    }

    /**
     * Tests to see if the circle has only one node.
     * @return boolean
     */
    public function hasOnlyOneNode(): boolean {
        if (
            $this->currentNode->getNext() === $this->currentNode &&
            $this->currentNode->getPrevious() === $this->currentNode
        ) {
            return true;
        }

        return false;
    }

    /**
     * Advances the current node to the next node and then returns the new current node. Essentially the same as calling next() and then current().
     * @return CircleNode
     */
    public function turn(): CircleNode {
        $this->next();
        return $this->getCurrent();
    }

    /**
     * Reverses the current node to the previous node and then returns the new current node. The opposite of turn().
     * @return CircleNode
     */
    public function reverse(): CircleNode {
        $this->currentNode = $this->currentNode->getPrevious();
        return $this->getCurrent();
    }


    /**
     * Remove a node from the circle. If the current node is removed, the next node will become the current node.
     * @param CircleNode $nodeToRemove
     * @param boolean $unsetNode By default, a node is unset from memory when it is removed. Passing false insures that other references to the node are preserved.
     */
    public function remove(CircleNode $nodeToRemove) {
        // Test to see if the node is the only node in the Circle.
        if ($this->hasOnlyOneNode()) {
            // If it is, throw an exception. Circles are not allowed to be empty.
            throw new LastCircleNodeException();
        }
        // If the node to be deleted is the first node, set the next node as the first node.
        if ($nodeToRemove === $this->firstNode) {
            $this->firstNode = $nodeToRemove->getNext();
        }

        // Make the previous node the previous node of the next node.
        $nodeToRemove->getNext()->setPrevious($nodeToRemove->getPrevious());
        // Make the next node the next node of the previous node.
        $nodeToRemove->getPrevious()->setNext($nodeToRemove->getNext());

        // If the current node is being remove, point the currentNode variable at the next node. This avoids a null pointer.
        if ($this->currentNode === $nodeToRemove) {
            $this->currentNode = $nodeToRemove->getNext();
        }

        // Unlink the node so that other variable referencing the CircleNode don't iterate over the Circle.
        $nodeToRemove->setNext($nodeToRemove);
        $nodeToRemove->setPrevious($nodeToRemove);

        $this->count--;
    }


    /**
     * Removes the node previous to the current node from the circle.
     */
    public function removePrevious() {
        $this->remove($this->currentNode->getPrevious());
    }

    /**
     * Removes the current node from the circle and sets the next node as the current node.
     */
    public function removeCurrent() {
        $this->remove($this->currentNode);
    }

    /**
     * Removes the node next from the current node from the circle.
     */
    public function removeNext() {
        $this->remove($this->currentNode->getNext());
    }

    /** TODO: Implement or delete. 2018-09-24 DWC
     * Applies a callback function to each node in the circle.
     * @param callable $func The function to be applied. The function must have one parameter of the type CircleNode which will take a CircleNode from within the Circle.
     * @param object $bindable An object to which $this inside $func should be bound. This is a great mechanism for capturing results of the callback.
     * @return void
     */
    public function applyFunction(callable $func, ?object $bindable = null): void {
        if (null !== $bindable) {
            $func->bindTo($bindable);
        }

        $node = $startingNode = $this->getCurrent();
        do {
            $func($node);
            $node = $this->getNext();
        } while($node !== $currentNode);
    }

    /**
     * Returns the current node in the circle. Implements Iterator interface.
     * @return mixed
     */
    public function current() {
        return $this->getCurrent();
    }

    /**
     * Returns a unique identifier for the current CircleNode object. Implements Iterator interface.
     * @return mixed A scalar value.
     */
    public function key() {
        return spl_object_hash($this->currentNode);
    }

    /**
     * Implements Iterator interface.
     * @return void
     */
    public function next(): void {
        $this->currentNode = $this->currentNode->getNext();
    }

    /**
     * Implements Iterator interface.
     * @return void
     */
    public function rewind(): void {
        $this->currentNode = $this->firstNode;
    }

    /**
     * This will always return true, provided the circle is unbroken as there is always a next item.
     * Implements Iterator interface.
     * @return boolean
     */
    public function valid(): bool {
        if ($this->currentNode instanceof CircleNode) {
            return true;
        }

        return false;
    }

    /**
     * Returns the number of CircleNodes objects in the Circle.
     * @return boolean
     */
    public function count() {
        return $this->count;
    }
}
