<?php
class Category extends CI_Model {
	
	function get_categories() {
		$this->db->select('*');
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_category($categoryID) {
		$this->db->select()->from('categories')->where('id', $categoryID);
		$query = $this->db->get();
		return $query->first_row('array');
	}

	function insert_category($data) {
		$this->db->insert('categories', $data);
		return $this->db->insert_id();
	}

	function update_category($categoryID, $data) {
		$this->db->where('id', $categoryID);
		$this->db->update('categories', $data);
	}

	function delete_category($categoryID) {
		$this->db->where('id', $categoryID);
		$this->db->delete('categories');
	}
	
}
?>
