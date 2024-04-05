<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitchen_model extends CI_Model {

    public function getKitchenOrders($fromDate=null,$category=null) {
        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $this->db->select('sq.id as quote_id, sq.quote_no, sq.booking_datetime, sq.customer_name, sq.mobile_no, sq.address, p.package_name, sqd.order_date, sqd.quantity, sqd.final_price, c.category_name, GROUP_CONCAT(m.item_name SEPARATOR ", ") as item_name');
        $this->db->from('ca_salesquote sq');
        $this->db->join('ca_salesquote_details sqd', 'sqd.salesquote_id = sq.id AND sqd.quote_no = sq.quote_no', 'left');
        $this->db->join('ca_package p', 'p.id = sqd.quote_package_id', 'left');        
        $this->db->join('ca_category c', 'c.id = p.package_category_id', 'left');        
        $this->db->join('ca_menu m', 'FIND_IN_SET(m.id, sqd.custom_menu_items)', 'left');
        $this->db->where('sq.status', 1);
        $this->db->where('sqd.status', 1);
        $this->db->where('p.package_status', 1); 
       /*  if($fromDate && $toDate) {
            $this->db->where('sqd.order_date >=', $fromDate);
            $this->db->where('sqd.order_date <=', $toDate);
        } else if($fromDate && $toDate==null) {
            $this->db->where('sqd.order_date >=', $fromDate);
        } else if($fromDate==null && $toDate){
            $this->db->where('sqd.order_date <=', $toDate);
        } else {
            $this->db->where('sqd.order_date >=', $curr_date);
        } */
		
		if($fromDate){
			$this->db->where('sqd.order_date =', $fromDate);
		}else {
            $this->db->where('sqd.order_date =', $curr_date);
        }
		
		if ($category) {
        $this->db->where('c.category_name', $category);
        }
		
		
        $this->db->group_by('sqd.salesquote_id, sqd.quote_package_id');
        return $this->db->get()->result();
    }

    public function getKitchenItems($fromDate=null,$category=null) {

        $date = new DateTime("now");
        $curr_date = $date->format('Y-m-d ');

        $this->db->select('sq.id as quote_id, sq.quote_no, sqd.order_date, sqd.quantity,c.category_name, GROUP_CONCAT(m.item_name SEPARATOR ", ") as item_name');
        $this->db->from('ca_salesquote sq');
        $this->db->join('ca_salesquote_details sqd', 'sqd.salesquote_id = sq.id AND sqd.quote_no = sq.quote_no', 'left');
        $this->db->join('ca_package p', 'p.id = sqd.quote_package_id', 'left');        
        $this->db->join('ca_category c', 'c.id = p.package_category_id', 'left');        
        $this->db->join('ca_menu m', 'FIND_IN_SET(m.id, sqd.custom_menu_items)', 'left');
        $this->db->where('sq.status', 1);
        $this->db->where('sqd.status', 1);
        $this->db->where('p.package_status', 1); 
        /* if($fromDate && $toDate) {
            $this->db->where('sqd.order_date >=', $fromDate);
            $this->db->where('sqd.order_date <=', $toDate);
        } else if($fromDate && $toDate==null) {
            $this->db->where('sqd.order_date >=', $fromDate);
        } else if($fromDate==null && $toDate){
            $this->db->where('sqd.order_date <=', $toDate);
        } else {
            $this->db->where('sqd.order_date >=', $curr_date);
        } */
		
		if($fromDate){
			$this->db->where('sqd.order_date =', $fromDate);
		}else {
            $this->db->where('sqd.order_date =', $curr_date);
        }
		
		if ($category) {
        $this->db->where('c.category_name', $category);
        }
		
        $this->db->group_by('sqd.salesquote_id, sqd.quote_package_id');
        return $this->db->get()->result();
    }
	
	public function get_records(){
		
		$sql = "select * from ca_category Where status = 1";
		$result = $this->db->query($sql);
		return $result->result();			
	}
    
}
?>
