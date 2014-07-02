<?php if (!defined('BASEPATH')) exit('No direct script access allowded');

class Tree {
	private $_root;

	function __construct($root) {
		$this->_root = $root['root'];
	}

	function preorder_trav($treeNode, $space_counter) {
		if ($treeNode != null) {

			echo "<option value=\"". $treeNode->get_id() ."\">";
			for ($i=0; $i < $space_counter; $i++) {
				echo "&nbsp; &nbsp;";
				if ($i == $space_counter - 1) { echo "&#8627;";}
			}
			echo  "". $treeNode->get_name() . "</option>";
			
			$space_counter++;

			$children = $treeNode->get_children();
			if (count($children) != 0) {
				foreach ($children as $n) {
					$this->preorder_trav($n, $space_counter);
				}
			} 
		}
	}

}
?>
