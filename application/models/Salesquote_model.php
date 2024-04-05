<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesquote_model extends CI_Model {
    // fetch all salesquote items
    public function getSalesquoteItems($id = NULL) {        
        // if($id) {
        //     $this->db->select('sqd.quote_package_id,p.package_name,sqd.order_date,c.category_name,GROUP_CONCAT(DISTINCT m.item_name SEPARATOR ", ") as item_name');
        // }
        $this->db->select('sq.id as quote_id, sq.quote_no, sq.booking_datetime, sq.customer_name, sq.mobile_no, sq.address, SUM(sqd.final_price) as quote_total_price');
        $this->db->from('ca_salesquote sq');
        $this->db->join('ca_salesquote_details sqd', 'sqd.salesquote_id = sq.id AND sqd.quote_no = sq.quote_no', 'left');        
        $this->db->join('ca_package p', 'p.id = sqd.quote_package_id', 'left');  
        // if($id) {
        //     $this->db->join('ca_category c', 'c.id = p.package_category_id', 'left');
        //     $this->db->join('ca_menu m', 'FIND_IN_SET(m.id, sqd.custom_menu_items)', 'left');
        // }      
        $this->db->where('sq.status', 1);
        $this->db->where('sqd.status', 1);
        $this->db->where('p.package_status', 1);
        
        // if ($id) {
        //     $this->db->where('m.status', 1);
        //     $this->db->group_by('sqd.salesquote_id, sqd.quote_package_id');
        //     $this->db->where('sq.id', $id);
        //     return $this->db->get()->row();
        // }
        if($id) {
            $this->db->where('sq.id', $id);
            return $this->db->get()->row();
        }

        $this->db->group_by('sq.quote_no');
        return $this->db->get()->result();
    }
    
    public function getSalesquotePackages($quote_no) {        
        $this->db->select('sqd.quote_package_id,p.package_name,p.package_price,sqd.order_date,c.category_name,GROUP_CONCAT(DISTINCT m.item_name SEPARATOR ", ") as item_name, sqd.quantity, sqd.final_price');
        $this->db->from('ca_salesquote_details sqd');        
        $this->db->join('ca_package p', 'p.id = sqd.quote_package_id', 'left');
        $this->db->join('ca_category c', 'c.id = p.package_category_id', 'left');
        $this->db->join('ca_menu m', 'FIND_IN_SET(m.id, sqd.custom_menu_items)', 'left');
        $this->db->where('sqd.status', 1);
        $this->db->where('p.package_status', 1);
        $this->db->where('m.status', 1);
        $this->db->where('sqd.quote_no', $quote_no);
        $this->db->group_by('sqd.salesquote_id, sqd.quote_package_id');
        return $this->db->get()->result();
    }

    // insert a new salesquote item
    public function addSalesquoteItem($data) {
        $this->db->insert('ca_salesquote', $data);
        return $this->db->insert_id();
    }

    // update a salesquote item
    public function updateSalesquoteItem($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('ca_salesquote', $data);
        return $this->db->affected_rows();
    }

    // delete a salesquote item
    public function deleteSalesquoteItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_salesquote');
    }

    // for dependent dropdown
    public function getPackages() {
        $this->db->select('id,package_name');
        $this->db->where('package_status', 1);
        return $this->db->get('ca_package')->result();
    }
    public function getPackagewiseCategories($package_id=NULL) {
        $package_categories = array();
        if($package_id) {
            $this->db->select('GROUP_CONCAT(c.category_name SEPARATOR ", ") as category_name');
            $this->db->from('ca_package_category pc');
            $this->db->join('ca_category c', 'c.id = pc.category_id', 'left');
            $this->db->where('pc.package_id', $package_id);
            $this->db->where('pc.status', 1);
            $this->db->where('c.status', 1);
            $package_categories = $this->db->get()->row();
        }
        return $package_categories;
    }
    public function getPackageCategorywiseMenus($package_id=NULL) {
        $package_category_menus = array();
        if($package_id) {
            $this->db->select('m.id, m.item_name');
            $this->db->from('ca_package_menu pm');
            $this->db->join('ca_menu m', 'm.id = pm.menu_id', 'left');
            $this->db->where('pm.package_id', $package_id);
            $this->db->where('pm.status', 1);
            $this->db->where('m.status', 1);
            $package_category_menus = $this->db->get()->result_array();
        }
        return $package_category_menus;
    }


    /// end ////


}
?>