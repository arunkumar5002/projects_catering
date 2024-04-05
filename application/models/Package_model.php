<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_model extends CI_Model {
    
    public function getPackageItems($id = NULL) {
        $this->db->where('package_status', 1);
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->get('ca_package')->row();
        }
        $this->db->order_by('id', 'asc');
        return $this->db->get('ca_package')->result();
    }

    public function getPackageCategoryItem($id = NULL) {

        $result = array();
        $category = array();
        $menu = array();

        $this->db->select('p.id as package_id,p.package_name,p.package_item_id as item_ids,p.package_price,c.id as category_id,c.category_name,m.id as item_id,GROUP_CONCAT(m.item_name SEPARATOR ", ") as item_name');
        $this->db->from('ca_package p');
        $this->db->join('ca_category c', 'c.id = p.package_category_id', 'left');
        $this->db->join('ca_menu m', 'FIND_IN_SET(m.id, p.package_item_id)', 'left');
        $this->db->where('p.package_status', 1);
        $this->db->where('c.status', 1);
        $this->db->where('m.status', 1);
        if($id) {
            $this->db->where('p.id', $id);
            return $this->db->get()->row();
        }
        $this->db->group_by('p.id');
        return $package = $this->db->get()->result();
    }

    // insert a new package item
    public function addPackageItem($data) {
        $this->db->insert('ca_package', $data);
        return $this->db->insert_id();
    }

    // update a package item
    public function updatePackageItem($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ca_package', $data);
        return $this->db->affected_rows();
    }

    // delete a package item
    public function deletePackageItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_package');
    }   



}
?>
