<?php
namespace Shoal\Struct\Tree;

/** This class is a node intended for use in a tree type data structure. It can be extended to store whatever
 *  data one wants to store in the tree. It is implemented by combining the TreeNodeTrait trait with the TreeNode
 *  interface. Type hints check against the interface in method calls.
 *  @see TreeNode
 */
class BaseTreeNode implements TreeNode {
	use TreeNodeTrait;
}


/*
//// Test code.

require_once (__DIR__ . '/TreeNode.php');
require_once (__DIR__ . '/TreeNodeTrait.php');


class IntTreeNode extends BaseTreeNode {
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

var_dump($child->getAncestors());
*/
