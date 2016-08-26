<?php
/**
 * \Shoal\Struct\Tree\TreeNode
 * @package \Shoal\Struct\Tree
 * @author David Cloutman
 * @license MIT
 */

namespace Shoal\Struct\Tree;


/**
 * This interface defines functionality for the TreeNode type. A defeault implementation the
 * TreeNodeTrait trait. This interface, combined with that trait, can be added to any class to
 * make it a TreeNode. The BaseTreeNode class demonstrates this implementation technique.
 */
interface TreeNode {
	/**
	 * This construction optionally sets the parent of the new node.
	 * @param TreeNode $parent
	 */
	public function __construct (TreeNode $parent = null);

	/**
	 * Adds a child node to this node and points the child node's parent member to this node.
	 * @param Treenode $newChild
	 */
	public function addChild (TreeNode $newChild);

	/**
	 * Assigns this node a new parent node.
	 * @param TreeNode $parent
	 */
	public function setParent(TreeNode $parent);

	/**
	 * Returns the parent node. The return value will be null if the node has no parent. (E.g. The node is a the top of the tree.)
	 * @return TreeNode|null
	 */
	public function getParent();

	/**
	 * Returns an array of the node's children.
	 * @return array An array of TreeNodes.
	 */
	public function getChildren();

	/**
	 * Applies to callback function to the node and then its children through recursion.
	 * @param callable $func The function to be applied. The function must one parameter which will store each instance of TreeNode to which the callback is passed.
	 */
	public function applyFunctionToTree (callable $func);

	/**
	 * Returns an array of the node's ancestors.
	 * @return Array An array of TreeNode objects.
	 */
	public function getAncestors();
}
