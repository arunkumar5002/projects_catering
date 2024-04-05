<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'package';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");

    }

    public function get_package_items() {
        $response = array();
        $package_id = $this->input->post('package_id');
        $item_ids = $this->db->select('package_item_id')->where(array('id' => $package_id, 'package_status' => 1))->get('ca_package')->row_array();
        if(!empty($item_ids)) {
            $response['item_ids'] = explode(",", $item_ids['package_item_id']);              
        }
        echo json_encode($response);
    }
	
	public function get_vessels_items() {
        $response = array();
        $challan_id = $this->input->post('challan_id');
        $item_ids = $this->db->select('vessels_item_id')->where(array('id' => $challan_id, 'status' => 1))->get('ca_delivery_challan')->row_array();
        if(!empty($item_ids)) {
            $response['item_ids'] = explode(",", $item_ids['vessels_item_id']);              
        }
        echo json_encode($response);
    }

    public function update_custom_package_items() {
        //print_r($_POST); exit;
        $package_id = $this->input->post('package_id');
        $quote_no = $this->input->post('quote_no');
        //$quote_no = substr($quote_no, 3);
        $package_items = $this->input->post('package_items', TRUE);
        $items_ids = '';
        if ($package_items) {
            $items_id_array = array_filter(array_unique($package_items));
            $items_ids = implode(',', $items_id_array);
        }
        
        $update_custom_package_items_details = $this->db->where(array('quote_no' => $quote_no, 'quote_package_id' => $package_id, 'status' => 1))->get('ca_salesquote_details')->row();        
        if ($update_custom_package_items_details->id > 0) {
            $update_qry = array(
                'custom_menu_items' => $items_ids,
                'status' => 1
            );
            $this->db->where('quote_no', $quote_no);
            $this->db->where('quote_package_id', $package_id);
            $this->db->update('ca_salesquote_details', $update_qry);
        } else {
            $update_ids = array();
            $update_ids['quote_no'] = $quote_no;
            $update_ids['quote_package_id'] = $package_id;
            $update_ids['custom_menu_items'] = $items_ids;
            $this->db->insert('ca_salesquote_details', $update_ids);
        }
    }

    public function get_quote_package_details($quote_no) {        
        $this->db->select('sqd.quote_package_id,p.package_name,sqd.order_date,c.category_name,GROUP_CONCAT(DISTINCT m.item_name SEPARATOR ", ") as item_name');
        $this->db->from('ca_salesquote_details sqd');        
        $this->db->join('ca_package p', 'p.id = sqd.quote_package_id', 'left');
        $this->db->join('ca_category c', 'c.id = p.package_category_id', 'left');
        $this->db->join('ca_menu m', 'FIND_IN_SET(m.id, p.package_item_id)', 'left');
        $this->db->where('sqd.status', 1);
        $this->db->where('p.package_status', 1);
        $this->db->where('m.status', 1);
        $this->db->where('sqd.id', $quote_no);
        $this->db->group_by('sqd.salesquote_id, sqd.quote_package_id');
        return $this->db->get()->result();
    }


}