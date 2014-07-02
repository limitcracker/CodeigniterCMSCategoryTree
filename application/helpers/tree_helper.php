<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('make_categ_tree'))
{
	function make_categ_tree($categories)
	{
		if (count($categories) != 0) {
			$treeNodes = array();
			$data_tree = array();

			/* Make node for each category and store them */
			foreach ($categories as $category) {

				$params = array(
					'id'=>$category['id'], 
					'name'=>$category['name'],
					'parent'=>$category['parent_category'], 
					'children'=>array()
				);

				/* $ci instead of $this */
				$ci =& get_instance();
				$ci->load->library('TreeNode', $params); 

				$currentTreeNode = new TreeNode($params);

				$treeNodes[$category['id']] = $currentTreeNode; 
			}

			/* Make the relationships between nodes while traverse them */
			foreach ($categories as $category) {
				if ($category['id'] != 1) {
					$currentTreeNode = $treeNodes[$category['id']];
					$parentTreeNode = $treeNodes[$currentTreeNode->get_parent()];
					$parentTreeNode->add_child($currentTreeNode);

				} 
			}

			$root = $treeNodes[1];
			$params_tree = array('root'=>$root);
			$ci->load->library('Tree', $params_tree);	/* $ci instead of $this */
			$tree = new Tree($params_tree);

			/* send the tree obj and the root node to view */
			$data_tree['tree'] = $tree;
			$data_tree['root'] = $root;

			return $data_tree;
		} 
		
		return null;
	}   
}

?>
