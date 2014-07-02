<?php
class Categories extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('category');
	}

	function index() {
		$data['categories'] = $this->category->get_categories();
		$this->load->view('category_index', $data);
	}

	function category_new() {

		$data['categories'] = $this->category->get_categories();

		$data_tree = $this->_create_categ_tree();
		$data['tree'] = $data_tree['tree'];
		$data['root'] = $data_tree['root'];

		if ($_POST) {

			$data_category = array(
				'name'=>$_POST['category'],
				'parent_category'=>$_POST['parent_category']
			);

			$this->category->insert_category($data_category);
			redirect(base_url().'categories/');
		} else {
			$this->load->view('category_new', $data);
		}
		
	}

	function category_edit($categoryID) {
		if ($_POST) {
			$data_category = array(
				'name'=>$_POST['category'],
				'parent_category'=>$_POST['parent_category']
			);

			$this->category->update_category($categoryID, $data_category);
		}
		$data['categories'] = $this->category->get_categories();
		$data['category'] = $this->category->get_category($categoryID);

		$data_tree = $this->_create_categ_tree();
		$data['tree'] = $data_tree['tree'];
		$data['root'] = $data_tree['root'];
		
		$this->load->view('category_edit', $data);
	}

	function category_delete($categoryID) {
		$this->category->delete_category($categoryID);
		redirect(base_url().'categories/');
	}

	function category_test() {
		$data = $this->_create_categ_tree();
		$this->load->view('category_test', $data);
	}

	function _create_categ_tree() {

		// $this->load->library('treenode');
		// $this->load->library('tree');
		$this->load->helper('tree_helper');

		$categories = $this->category->get_categories();

		/* used from tree_helper.php */
		$data_tree = make_categ_tree($categories);

		return $data_tree;

	}

	function _get_cached_tree() {
		if (! $cache_tree = $this->cache->get('cache_tree')) {
			$tree = $this->_create_categ_tree();

			$this->cache->save('cache_tree', $tree, 120);
			$cache_tree = $tree;
		}

		return $cache_tree;
	}

}
?>
