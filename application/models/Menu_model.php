<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {
    // fetch all menu items
    public function getMenuItems($id = NULL) {
        $this->db->where('status', 1);
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->get('ca_menu')->row();
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('ca_menu')->result();
    }

    // insert a new menu item
    public function addMenuItem($data) {
        $this->db->insert('ca_menu', $data);
        return $this->db->insert_id();
    }

    // update a menu item
    public function updateMenuItem($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ca_menu', $data);
        return $this->db->affected_rows();
    }

    // delete a menu item
    public function deleteMenuItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_menu');
    }
}
?>
