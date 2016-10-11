<?php
/**
 * \Shoal\Struct\Tree\TreeNodeTrait
 * @package \Shoal\Struct\Tree
 * @author David Cloutman
 * @license MIT
 */

namespace Shoal\Struct\Tree;


/**
 *  This trait provides a default implementation of the TreeNode interface. It provides logic for a node 
 *  intended for use in a tree type data structure. 
 *  @see TreeNode
 */
trait TreeNodeTrait {
	/**
	 * @var \Shoal\Struct\TreeNode $parent
	 * @internal
	 */
	protected $parent = null;

	/**
	 * @var array $children
	 * @internal
	 */
	protected $children = [];

	/**
	 * This construction optionally sets the parent of the new node.
	 * @param TreeNode $parent
	 */
	public function __construct (TreeNode $parent = null) {
		$this->parent = $parent;
	}

	/**
	 * Adds a child node to this node and points the child node's parent member to this node.
	 * @param TreeNode $newChild
	 */
	public function addChild (TreeNode $newChild) {
		$newChild->setParent($this);
		$this->children[] = $newChild;
	}

	/**
	 * Assigns this node a new parent node.
	 * @param TreeNode $parent
	 */
	public function setParent(TreeNode $parent) {
		$this->parent = $parent;
	}

	/**
	 * Returns the parent node. The return value will be null if the node has no parent. (E.g. The node is a the top of the tree.)
	 * @return TreeNode|null
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Returns an array of the node's children.
	 * @return array An array of TreeNodes.
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * Applies to callback function to the node and then its children through recursion.
	 * @param callable $func The function to be applied. The function must take one parameter which will be assigned the instance of TreeNode to which the callback is passed.
	 */
	public function applyFunctionToTree (callable $func) {
		$func($this);

		foreach ($this->children as $child) {
			$child->applyFunctionToTree($func);
		}
	}

	/**
	 * Returns an array of the node's ancestors.
	 * @return Array An array of TreeNode objects.
	 */
	public function getAncestors() {
		return $this->recurseAncestors();
	}

	/**
	 * A helper function for getAncestors.
	 * @param array An array of ancestor TreeNode objects.
	 * @return array
	 */
	protected function recurseAncestors(array $ancestors = []) {
		if (null !== $this->parent) {
			$ancestors[] = $this->parent;
			$ancestors = $this->parent->recurseAncestors($ancestors);
		}
		return $ancestors;
	}
}
