<?php
/**
 * \Shoal\Struct\Tree\BaseTreeNode
 * @package \Shoal\Struct\Tree
 * @author David Cloutman
 * @license MIT
 */

namespace Shoal\Struct\Tree;


/**
 * This class is a node intended for use in a tree type data structure. It can be extended to store whatever
 * data one wants to store in the tree. It is implemented by combining the TreeNodeTrait trait with the TreeNode
 * interface. Type hints check against the interface in method calls.
 * @see TreeNode
 */
class BaseTreeNode implements TreeNode {
	use TreeNodeTrait;
}
