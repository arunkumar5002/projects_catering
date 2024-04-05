<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vessels_model extends CI_Model {
    // fetch all vessels items
    public function getVesselsItems($id = NULL) {
        $this->db->where('status', 1);
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->get('ca_vessels')->row();
        }
        $this->db->order_by('id', 'desc');
        return $this->db->get('ca_vessels')->result();
    }

    // insert a new vessels item
    public function addVesselsItem($data) {
        $this->db->insert('ca_vessels', $data);
        return $this->db->insert_id();
    }

    // update a vessels item
    public function updateVesselsItem($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ca_vessels', $data);
        return $this->db->affected_rows();
    }

    // delete a vessels item
    public function deleteVesselsItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_vessels');
    }
}
?>
