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

namespace Shoal\Struct\Circle;


/**
 * This class defines the Circle type which is a circularly linked list.
 */
class Circle implements \Iterator {
    /**
     * @var \Shoal\Struct\Circle\CircleNode Stores a reference to the first node in the circle.
     * @internal
     */
    protected $firstNode = null;

    /**
     * @var \Shoal\Struct\Circle\CircleNode Stores an internal reference pointing to the current node in a circle.
     * @internal
     */
    protected $currentNode = null;

    /**
     * This construction optionally takes an initial node.
     * @param CircleNode|null $first Sets the first node in the circle by reference. Empty Circle instances are not allowed.
     */
    public function __construct (CircleNode $first) {
        $this->setFirst($first);
        $this->setCurrent($first);
    }

    /**
     * Set the first node in the circle.
     * @param CircleNode $first Sets the first node in the circle by reference.
     */
    public function setFirst (CircleNode $first) {
        $this->firstNode = $first;
    }

    /**
     * Cet a reference to the first node being pointed to in the.
     * @return CircleNode
    */
    public function getFirst () {
        return $this->firstNode;
    }

    /**
     * Set the current node in the circle by reference.
     * @param CircleNode $current Sets the current node in the circle by reference.
     */
    public function setCurrent (CircleNode $current) {
        $this->currentNode = $current;
   }

    /**
     * Cet a reference to the current node being pointed to in the.
     * @return CircleNode
    */
    public function getCurrent () {
        return $this->currentNode;
    }
   
    /**
     * Get the next node in the circle without changing the current node.
     * @return CircleNode The next node in the circle.
     */
    public function getNext () {
        return $this->currentNode->getNext();
    }

    /**
     * Get the previous node in the circle without changing the current node.
     * @return CircleNode The previous node in the circle.
     */
    public function getPrevious () {
        return $this->currentNode->getPrevious();
    }

    /**
     * Adds a CircleNode ahead of the current node.
     * @param CircleNode $newChild
     */
    public function insertAfterCurrent (CircleNode $newNode) {
        $newNode->setNext($this->currentNode->getNext());
        $this->currentNode->setNext($newNode);
    }

    /**
     * Adds a CircleNode before the current node.
     * @param CircleNode $newChild
     */
    public function insertBeforeCurrent (CircleNode $newNode) {
        $newNode->setPrevious($this->currentNode->getPrevious());
        $this->currentNode->setPrevious($newNode);
    }

    /**
     * Returns true when the first node is current.
     * @return boolean
     */
    public function isFirstCurrent () {
        if ($this->currentNode === $this->firstNode) {
            return true;
        }

        return false;
    }

    /**
     * Advances the current node to the next node and then returns the new current node. Essentially the same as calling next() and then current().
     * @return CircleNode
     */
    public function turn () {
        $this->next();
        return $this->getCurrent();
    }

    /**
     * Applies acallback function to each node in the circle.
     * @param callable $func The function to be applied. The function must one parameter which will store each instance of TreeNode to which the callback is passed.
     */
    public function applyFunction (callable $func) {

    }
    
    /**
     * Returns the current node in the circle. Implements Iterator interface. 
     * @return mixed
     */
    public function current () {
        return $this->getCurrent();
    }
    
    /**
     * Returns a unique identifier for the current CircleNode object. Implements Iterator interface. 
     * @return mixed A scalar value.
     */
    public function key () {
        return spl_object_hash($this->currentNode);
    }
    
    /**
     * Implements Iterator interface. 
     * @return void
     */
    public function next () {
        $this->currentNode = $this->currentNode->getNext();
    }
    
    /**
     * Implements Iterator interface. 
     * @return void
     */
    public function rewind () {
        $this->currentNode = $this->firstNode;
    }
    
    /**
     * This will always return true, provided the circle is unbroken as there is always a next item.
     * Implements Iterator interface. 
     * @return boolean
     */
    public function valid () {
        if ($this->currentNode instanceof CircleNode) {
            return true;
        }

        return false;
    }


}
