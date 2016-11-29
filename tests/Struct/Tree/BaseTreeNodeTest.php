<?php
use PHPUnit\Framework\TestCase;
use Shoal\Struct\Tree;

class BaseTreeNodeTest extends TestCase {

    /**
     */
    public function testConstruct () {
        $testTree = new IntTreeNode();
        $testTree->setValue(42);
        $this->assertEquals(42, $testTree->getValue());

        return $testTree;
    }

    /**
     *  @depends testConstruct
     */
    public function testGetChildren ($testTree) {
        //var_dump($this);
        $this->assertEmpty($testTree->getChildren());

        return $testTree;
    }

    /**
     *  @depends testGetChildren
     */
    public function testAddChild ($testTree) {
        for ($i = 1; $i < 4; $i++) {
            $child = new IntTreeNode();
            $child->setValue($i);
            $testTree->addChild($child);
        }

        $this->assertEquals(3, count($testTree->getChildren()));

        $children = $testTree->getChildren();
        foreach ($children as $child) {
           $this->assertNotEmpty($child->getParent());
        }

        return $testTree;
    }

    /** Confirm that the values 1, 2, and 3 were applied to the three children.
     *  @depends testAddChild
     */
    public function testGetChildrenChecksum ($testTree) {
        $children = $testTree->getChildren();
        $checkSum = 0;
        foreach ($children as $child) {
            $checkSum += $child->getValue();
        }

        $this->assertEquals(6, $checkSum);

        return $testTree;
    }

    /**
     *  @depends testGetChildrenChecksum
     */
    public function testGetParent ($testTree) {
        $children = $testTree->getChildren();

        // Assert that all the children have the same parent.
        $this->assertTrue((
            $children[0]->getParent() === $children[1]->getParent() &&
            $children[0]->getParent() === $children[2]->getParent() &&
            $children[1]->getParent() === $children[2]->getParent()
        ));

        // The expected value of the parent node of any of the children is 42.
        $this->assertEquals(42, $children[0]->getParent()->getValue());
        $this->assertEquals(42, $children[1]->getParent()->getValue());
        $this->assertEquals(42, $children[2]->getParent()->getValue());

        return $testTree;
    }

    /**
     *  @depends testGetChildrenChecksum
     */
    public function testGetAncestors ($testTree) {
        // The root of the tree should have no ancestors.
        //$this->assertEmpty($testTree->getAncestors());

        $newNode = new IntTreeNode();
        $newNode->setValue(16);
        $this->assertEmpty($newNode->getParent());

        $children = $testTree->getChildren();
        $children[0]->addChild($newNode);
        $this->assertNotEmpty($newNode->getParent());

        // Check to make sure child to parent links are intact.
        $this->assertEquals($newNode->getParent(), $children[0]);
        $this->assertEquals($children[0]->getParent(), $testTree);

        //$this->assertEquals(1, count($children[0]->getAncestors()));

        $this->assertEquals(2, count($newNode->getAncestors()));

        return $testTree;
    }

    /** This test sets all values in $testTree to 1024. It is probably best to run this test last.
     *  @depends testGetAncestors
     */
    public function testApplyFunctionToTree ($testTree) {

        // Add 1 to all the numeric values in the tree.
        $testTree->applyFunctionToTree(function ($node) {
            $node->setValue(1024);
        });

        // Compare all the values to ensure that all were incremented.
        $this->assertEquals($testTree->getValue(), 1024);
        $this->assertEquals($testTree->getChildren()[0]->getValue(), 1024);
        $this->assertEquals($testTree->getChildren()[1]->getValue(), 1024);
        $this->assertEquals($testTree->getChildren()[2]->getValue(), 1024);
        $this->assertEquals($testTree->getChildren()[0]->getChildren()[0]->getValue(), 1024);

        return $testTree;
    }
}



/** A helper class for testing.
 */
class IntTreeNode extends \Shoal\Struct\Tree\BaseTreeNode {
    protected $num = 0;

    function __construct(\Shoal\Struct\Tree\TreeNode $parent = null) {
        parent::__construct($parent);
    }

    public function setValue ($value) {
        $this->num = $value;
    }

    public function getValue () {
        return $this->num;
    }

    public function __toInt () {
        return $this->num;
    }
}


/*

//// Test code.

$trunk->applyFunctionToTree(function ($obj) {
    $obj->num = rand(1,100);
});

var_dump($trunk);

$children = $trunk->getChildren();

foreach ($children as $child) {
    echo $child->getParent()->num . "\n";
}

var_dump($child->getAncestors());
*/

