<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesinvoice_model extends CI_Model {
    // get search quote 
    public function getSearchQuote($search_value = NULL) {
        
        $this->db->select('sq.id as quote_id, sq.quote_no');
        $this->db->from('ca_salesquote sq');
        $this->db->where('sq.status', 1);
        $this->db->where('sq.quote_no', $search_value);
        $this->db->or_where('sq.mobile_no', $search_value);
        return $this->db->get()->row();
    }

    // get view quote by invoice
    public function getViewQuote($search_value = NULL) {
        
        $this->db->select('sq.id as quote_id, sq.quote_no, in.invoice_no');
        $this->db->from('ca_invoice_number in');
        $this->db->join('ca_salesquote sq', 'sq.id=in.quote_id AND sq.quote_no=in.quote_no', 'left');
        $this->db->where('sq.status', 1);
        $this->db->where('in.invoice_no', $search_value);
        $this->db->or_where('sq.mobile_no', $search_value);
        return $this->db->get()->row();
    }

    // get invoice payment history
    public function getInvoiceHistory($search_value = NULL) {
        
        $this->db->select('sq.id as quote_id, sq.quote_no, in.invoice_no');
        $this->db->from('ca_invoice_number in');
        $this->db->join('ca_salesquote sq', 'sq.id=in.quote_id AND sq.quote_no=in.quote_no', 'left');
        $this->db->where('sq.status', 1);
        $this->db->where('in.invoice_no', $search_value);
        $this->db->or_where('sq.mobile_no', $search_value);
        return $this->db->get()->row();
    }

    public function getInvoicePayments($quote_id, $quote_no) {
        
        $this->db->select('*');
        $this->db->from('ca_salesinvoice_payment sip');
        $this->db->where('sip.quote_id', $quote_id);
        $this->db->where('sip.quote_no', $quote_no);
        return $this->db->get()->result();
    }

    // insert a new sales invoice payment
    public function addSalesinvoicePayment($data) {
        $this->db->insert('ca_salesinvoice_payment', $data);
        return $this->db->insert_id();
    }

    // insert a new sales invoice payment
    public function create_invoice($data) {
        $this->db->insert('ca_invoice_number', $data);
        return $this->db->insert_id();
    }

    // get list
    public function getInvoiceDetails_copy() {
        $this->db->select('sq.id as quote_id,sq.quote_no,sq.customer_name, sq.mobile_no, sq.booking_datetime, sqd.order_date, sip.package_total_price as total_package_amount, sip.paid_amount as total_paid_amount, sip.balance_amount as total_balance_amount,sip.create_at');
        $this->db->from('ca_salesquote sq');
        $this->db->join('ca_salesquote_details sqd', 'sqd.salesquote_id = sq.id AND sqd.quote_no = sq.quote_no', 'left');
        $this->db->join('ca_salesinvoice_payment sip', 'sip.quote_id = sq.id AND sip.quote_no = sq.quote_no', 'left');
        $this->db->where('sq.status', 1);
        //$this->db->group_by('sq.id');
        $this->db->order_by('sip.id', 'desc');
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getInvoiceDetails($fromDate=null, $toDate=null, $type=null) {
    $this->db->select('sq.id as quote_id, sq.quote_no, sq.customer_name, sq.mobile_no, sq.booking_datetime, sqd.order_date, sip.package_total_price as total_package_amount, sip.paid_amount as total_paid_amount, sip.balance_amount as total_balance_amount, sip.create_at');
    $this->db->from('ca_salesinvoice_payment sip');
    $this->db->join('ca_salesquote sq', 'sip.quote_id = sq.id AND sip.quote_no = sq.quote_no', 'left');
    $this->db->join('ca_salesquote_details sqd', 'sqd.salesquote_id = sq.id AND sqd.quote_no = sq.quote_no', 'left');
    $this->db->where('sq.status', 1);

    if ($fromDate && $toDate) {
        $this->db->where('sqd.order_date >=', $fromDate);
        $this->db->where('sqd.order_date <=', $toDate);
    }
    
	if($type){
		if($type == 'Paid'){
			$this->db->where('sip.paid_amount >= sip.package_total_price');
		}else if($type == 'Partially'){
			$this->db->where('sip.paid_amount >', 0);
            $this->db->where('sip.paid_amount < sip.package_total_price');
		}else{
			$this->db->where('sip.paid_amount', 0);
		}
	}
	
    $this->db->group_by('sq.id');
    $this->db->order_by('sip.id', 'desc');

    return $this->db->get()->result();
}

    public function generate_invoice_number($quote_id,$quote_no) {
        // Get the current date
        $current_date = date('Ymd');
        // Get the last invoice number from the database
        $last_invoice = $this->db->select('invoice_no')->order_by('in.id', 'DESC')->limit(1)->get('ca_invoice_number in')->row();
        // If there are no invoices in the database, start from 1
        if (!$last_invoice) {
            $new_invoice_no = $current_date . '001';
        } else {
            // Extract the numeric part of the last invoice number
            $last_invoice_no = intval(substr($last_invoice->invoice_no, -3));
            // Increment the last invoice number and pad it with zeros
            $new_invoice_no = $current_date . str_pad($last_invoice_no + 1, 3, '0', STR_PAD_LEFT);
        }
        return $new_invoice_no;
    }


}
?>