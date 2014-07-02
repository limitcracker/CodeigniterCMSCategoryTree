<?php if (!defined('BASEPATH')) exit('No direct script access allowded');

class TreeNode {
	private $_parent;
	private $_children = array();
	private $_id;
	private $_name;

	function __construct($data) {
		$this->_parent = $data['parent'];
		$this->_children = $data['children'];
		$this->_id = $data['id'];
		$this->_name = $data['name'];
	}

	function add_child($childTreeNode) {
		$this->_children[] = $childTreeNode;
	}

	function get_parent() {
		return $this->_parent;
	}

	function get_children() {
		return $this->_children;
	}

	function get_id() {
		return $this->_id;
	}

	function get_name() {
		return $this->_name;
	}

	function display() {
		print_r($this);
	}


}
?>
