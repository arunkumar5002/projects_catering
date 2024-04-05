<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    // fetch all category items
    public function getCategoryItems($id = NULL) {
        $this->db->where('status', 1);
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->get('ca_category')->row();
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('ca_category')->result();
    }

    // insert a new category item
    public function addCategoryItem($data) {
        $this->db->insert('ca_category', $data);
        return $this->db->insert_id();
    }

    // update a category item
    public function updateCategoryItem($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ca_category', $data);
        return $this->db->affected_rows();
    }

    // delete a category item
    public function deleteCategoryItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_category');
    }
}
?>
