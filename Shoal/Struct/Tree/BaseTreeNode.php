<?php

/** This class is a node intended for use in a tree type data structure. It can be extended to store whatever
 *  data one wants to store in the tree. It has a parent node and child nodes. The top of the tree has a null
 *  parent.
 */

class TreeNode {
	protected $parent = null;
	protected $children = [];

	/** This construction optionally sets the parent of the new node.
	 *  @param TreeNode $parent
	 */
	public function __construct (TreeNode $parent = null) {
		$this->parent = $parent;
	}

	/** Adds a child node to this node and points the child node's parent member to this node.
	 *  @param Treenode $newChild
	 */
	public function addChild (TreeNode $newChild) {
		$newChild->setParent($this);
		$this->children[] = $newChild;
	}

	/** Assigns this node a new parent node.
	 *  @param TreeNode $parent
	 */
	public function setParent(TreeNode $parent) {
		$this->parent = $parent;
	}

	/** Returns the parent node. The return value will be null if the node has no parent. (E.g. The node is a the top of the tree.)
	 *  @return TreeNode|null
	 */
	public function getParent() {
		return $this->parent;
	}

	/** Returns an array of the node's children.
	 *  @return array An array of TreeNodes.
	 */
	public function getChildren() {
		return $this->children;
	}

	/** Applies to callback function to the node and then its children through recursion.
	 *  @param callable $func The function to be applied. The function must one parameter which will store each instance of TreeNode to which the callback is passed.
	 */
	public function applyFunctionToTree (callable $func) {
		$func($this);

		foreach ($this->children as $child) {
			$child->applyFunctionToTree($func, $params);
		}
	}
}


//// Test code.
/*
class IntTreeNode extends TreeNode {
	public $num = 0;
}


$trunk = new IntTreeNode();
for ($i = 0; $i < 3; $i++) { 
	$trunk->addChild(new IntTreeNode());
}

var_dump($trunk);

$trunk->applyFunctionToTree(function ($obj) {
	$obj->num = rand(1,100);
});

var_dump($trunk);

$children = $trunk->getChildren();

foreach ($children as $child) {
	echo $child->getParent()->num . "\n";
}

*/
