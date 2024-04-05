<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesinvoice extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'sales';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('salesinvoice_model', 'salesinvoice');
        $this->load->model('salesquote_model', 'salesquote');
        $this->load->model('package_model', 'package');
        $this->load->model('category_model', 'category');
        $this->load->model('menu_model', 'menu');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }
/*
    public function index() {
        $this->data['invoice_details_list'] = null;
        $invoice_details_list = $this->salesinvoice->getInvoiceDetails();
        $this->data['invoice_details_list'] = $invoice_details_list;
        
     
        $this->data['page'] = 'invoice_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }*/
	
	
 public function index() {
		
	  $this->data['invoice_details_list'] = null;
        if ($this->input->post('date_search')) {
            $fromDate = $this->input->post('fromdate');
            $toDate = $this->input->post('todate');
			$type = $this->input->post('type');
            $result_data = $this->salesinvoice->getInvoiceDetails($fromDate, $toDate, $type);
        } else {           
            $result_data = $this->salesinvoice->getInvoiceDetails();
        }
        $this->data['invoice_details_list'] = $result_data;
        $this->data['page'] = 'invoice_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
	}
	
    public function searchQuoteItem($input_search=NULL) {
        $this->data['quote_no'] = null;
        $this->data['quote_item'] = null;
        $this->data['edit_quote_id'] = null;
        $this->data['package_list_count'] = null;
        $this->data['edit_quote_no'] = null;
        $this->data['quote_package_details'] = null;
        if($input_search) {
            $get_search_qoute = $this->salesinvoice->getSearchQuote($input_search);
            if(empty($get_search_qoute)) {
                $this->session->set_flashdata('error', 'Records not found!!');
                redirect(base_url().$this->data['theme']."/salesinvoice");                
            }
            $quote_id = $get_search_qoute->quote_id;
            $quote_no = $get_search_qoute->quote_no;
        
            if ($quote_id) {
                $this->data['quote_no'] = $quote_no;
                $quote_item = $this->salesquote->getSalesquoteItems($quote_id);
                $this->data['quote_item'] = $quote_item; 
                $this->data['quote_package_details'] = $this->salesquote->getSalesquotePackages($quote_no);
                $this->data['edit_quote_id'] = $quote_id;
                $this->data['edit_quote_no'] = $quote_item->quote_no;
                $this->data['selected_package_ids'] = array_column($this->data['quote_package_details'],'quote_package_id');
            }   

            // Generate a new invoice number if not exist
            $invoice_number = $this->db->where(array('quote_id'=>$quote_id,'quote_no'=>$quote_no))->select('invoice_no')->get('ca_invoice_number')->row();
            if($invoice_number) {
                $invoice_number = $invoice_number->invoice_no;
            } else {
                $invoice_number = $this->salesinvoice->generate_invoice_number($quote_id,$quote_no);
            }
            $this->data['invoice_number'] = $invoice_number;
            
            //check paid amount before
            $paid_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('paid_amount as total_paid')->order_by('id', 'DESC')->limit(1)->get('ca_salesinvoice_payment')->row();
            $paid_amount = ($paid_amount) ? $paid_amount->total_paid : 0;
            $this->data['paid_amount'] = $paid_amount;

            //To pay amount
            $this->data['topay_amount'] = 0;
            $discount_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('SUM(discount_amount) as total_discount')->group_by('quote_id','quote_no')->get('ca_salesinvoice_payment')->row();
            $package_amt = $quote_item->quote_total_price;
            $paid_amt = $paid_amount;
            $discount_amt = ($discount_amount) ? $discount_amount->total_discount : 0;
            $topay_amount = $package_amt - ($paid_amt+$discount_amt);
            $this->data['topay_amount'] = $topay_amount;
            $this->data['total_discount'] = $discount_amt;
        
            //package
            $this->data['packages'] = $this->package->getPackageItems();
            $this->data['package_list_count'] = count($this->data['packages']);
            //category
            $this->data['category_items'] = $this->category->getCategoryItems();
            //menu
            $this->data['menu_items'] = $this->menu->getMenuItems();

            $this->data['page'] = 'invoice_add_edit';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        }
    }

    public function insertSalesInvoceItem() {
        //print_r($_POST);
        $this->data['quote_no'] = null;
        $this->data['quote_item'] = null;
        $this->data['edit_quote_id'] = null;
        $this->data['package_list_count'] = null;
        $this->data['edit_quote_no'] = null;
        $this->data['invoice_number'] = null;

        $quote_id = trim($this->input->post('edit_quote_id'));
        $quote_no = trim($this->input->post('quote_no'));

        // Generate a new invoice number if not exist
        $invoice_number = $this->db->where(array('quote_id'=>$quote_id,'quote_no'=>$quote_no))->select('invoice_no')->get('ca_invoice_number')->row();
        if($invoice_number) {
            $invoice_number = $invoice_number->invoice_no;
        } else {
            $invoice_number = $this->salesinvoice->generate_invoice_number($quote_id,$quote_no);
        }
        $this->data['invoice_number'] = $invoice_number;

        if($quote_no) {
            $get_search_qoute = $this->salesinvoice->getSearchQuote($quote_no);
            $quote_id = $get_search_qoute->quote_id;
            $quote_no = $get_search_qoute->quote_no;
        }
        if ($quote_id) {
            $this->data['quote_no'] = $quote_no;
            $quote_item = $this->salesquote->getSalesquoteItems($quote_id);
            $this->data['quote_item'] = $quote_item; 
            $this->data['quote_package_details'] = $this->salesquote->getSalesquotePackages($quote_no);
            $this->data['edit_quote_id'] = $quote_id;
            $this->data['edit_quote_no'] = $quote_item->quote_no;
            $this->data['selected_package_ids'] = array_column($this->data['quote_package_details'],'quote_package_id');
        } 

        $this->form_validation->set_rules('quote_no', 'Quotation No', 'required|trim');
        $this->form_validation->set_rules('booking_datetime', 'Booking Date', 'required|trim');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'Contact Number', 'required|trim');
        $this->form_validation->set_rules('address', 'Contact Address', 'required|trim');
        $this->form_validation->set_rules('total_price', 'Total Price', 'required|trim');
        //$this->form_validation->set_rules('discount_amount', 'Discount Amount', 'required|trim');
        $this->form_validation->set_rules('advance_amount', 'Advance Amount', 'required|trim');
        $this->form_validation->set_rules('balance_amount', 'Balance Amount', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['page'] = 'invoice_add_edit';
            $this->data['packages'] = $this->salesquote->getPackages();
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            $edit_quote_id = $quote_id;
            $quote_no = $quote_no;
            $booking_datetime = trim($this->input->post('booking_datetime'));
            $customer_name = trim($this->input->post('customer_name'));
            $mobile_no = trim($this->input->post('mobile_no'));
            $address = trim($this->input->post('address'));
            $total_price = $this->input->post('total_price');
            $discount_amount = $this->input->post('discount_amount');
            $advance_amount = $this->input->post('advance_amount');
            $balance_amount = $this->input->post('balance_amount');
            $updateInputData = array(
                'booking_datetime' => $booking_datetime,
                'customer_name' => $customer_name,
                'mobile_no' => $mobile_no,
                'address' => $address
            ); 
            //update basic details
            $this->salesquote->updateSalesquoteItem($edit_quote_id, $updateInputData);

            //check paid amount before
            $paid_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('paid_amount as total_paid')->order_by('id','DESC')->limit(1)->get('ca_salesinvoice_payment')->row();
            if($paid_amount!='') {
                $paid_amount = $paid_amount->total_paid; 
                $paid_amount = $paid_amount + $advance_amount;
            } else {
                $paid_amount = $advance_amount;
            }
            $this->data['paid_amount'] = $paid_amount;

            //To pay amount
            $this->data['topay_amount'] = 0;
            $total_discount_amount = $this->db->where(array('quote_id'=>$edit_quote_id, 'quote_no'=>$quote_no))->select('SUM(discount_amount) as total_discount')->group_by('quote_id','quote_no')->get('ca_salesinvoice_payment')->row();
            $package_amt = $quote_item->quote_total_price;
            $paid_amt = $paid_amount;
            $discount_amt = ($total_discount_amount) ? $total_discount_amount->total_discount : 0;
            $topay_amount = $package_amt - ($paid_amt+$discount_amt);
            $this->data['topay_amount'] = $topay_amount;
            $this->data['total_discount'] = $discount_amt;
            
            //insert payment details
            $inputData = array(
                'quote_id' => $edit_quote_id,
                'quote_no' => $quote_no,
                'package_total_price' => $total_price,
                'paid_amount' => $paid_amount,
                'discount_amount' => $discount_amount,
                'advance_amount' => $advance_amount,
                'balance_amount' => $balance_amount
            );
            //print_r($inputData); exit;
            if($this->salesinvoice->addSalesinvoicePayment($inputData)) {
                $db_invoice_number = $this->db->where(array('quote_id'=>$quote_id,'quote_no'=>$quote_no))->select('invoice_no')->get('ca_invoice_number')->row();
                if(empty($db_invoice_number)) {
                    $invoiceData = array(
                        'invoice_no' => $invoice_number,
                        'quote_id' => $edit_quote_id,
                        'quote_no' => $quote_no
                    );
                    $invoice_id = $this->salesinvoice->create_invoice($invoiceData);
                }
                $this->session->set_flashdata('success', 'Sales invoice was added successfully');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong, try again');
            }
            redirect(base_url().$this->data['theme']."/salesinvoice/searchQuoteItem/".$quote_no);
        }
        
    }

    public function searchInvoiceView($input_search=NULL) {
        if($input_search) {
            $get_view_qoute = $this->salesinvoice->getViewQuote($input_search);
            if(empty($get_view_qoute)) {
                $this->session->set_flashdata('error', 'Records not found!!');
                redirect(base_url().$this->data['theme']."/salesinvoice");                
            }
            $quote_id = $get_view_qoute->quote_id;
            $quote_no = $get_view_qoute->quote_no;
            $invoice_no = $get_view_qoute->invoice_no;
        
            if ($quote_id) {
                $this->data['quote_no'] = $quote_no;
                $quote_item = $this->salesquote->getSalesquoteItems($quote_id);
                $this->data['quote_item'] = $quote_item; 
                $this->data['quote_package_details'] = $this->salesquote->getSalesquotePackages($quote_no);
                $this->data['edit_quote_id'] = $quote_id;
                $this->data['edit_quote_no'] = $quote_no;
                $this->data['order_no'] = $quote_item->quote_no;
                $this->data['invoice_no'] = $invoice_no;
                $this->data['selected_package_ids'] = array_column($this->data['quote_package_details'],'quote_package_id');

                //check paid amount before
                $paid_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('paid_amount as total_paid')->order_by('id', 'DESC')->limit(1)->get('ca_salesinvoice_payment')->row();
                $paid_amount = ($paid_amount) ? $paid_amount->total_paid : 0;
                $this->data['paid_amount'] = $paid_amount;

                //To pay amount
                $this->data['topay_amount'] = 0;
                $discount_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('SUM(discount_amount) as total_discount')->group_by('quote_id','quote_no')->get('ca_salesinvoice_payment')->row();
                $package_amt = $quote_item->quote_total_price;
                $paid_amt = $paid_amount;
                $discount_amt = ($discount_amount) ? $discount_amount->total_discount : 0;
                $topay_amount = $package_amt - ($paid_amt+$discount_amt);
                $this->data['topay_amount'] = $topay_amount;
                $this->data['total_discount'] = $discount_amt;

                $delivery_handling_fee = 500;
                $tax = 75;
                $this->data['grand_total'] = $topay_amount + $delivery_handling_fee + $tax;

                $this->data['page'] = 'invoice_view';
                $this->load->vars($this->data);
                $this->load->view($this->data['theme'] . '/template');
            }            
        }
    }
    
    public function searchInvoiceHistory($input_search=NULL) {
        if($input_search) {
            $get_invoice_history = $this->salesinvoice->getInvoiceHistory($input_search);
            if(empty($get_invoice_history)) {
                $this->session->set_flashdata('error', 'Records not found!!');
                redirect(base_url().$this->data['theme']."/salesinvoice");                
            }
            $quote_id = $get_invoice_history->quote_id;
            $quote_no = $get_invoice_history->quote_no;
            $invoice_no = $get_invoice_history->invoice_no;
        
            if ($quote_id) {
                $this->data['quote_no'] = $quote_no;
                $quote_item = $this->salesquote->getSalesquoteItems($quote_id);
                $this->data['quote_item'] = $quote_item; 
                $this->data['quote_package_details'] = $this->salesquote->getSalesquotePackages($quote_no);
                $this->data['edit_quote_id'] = $quote_id;
                $this->data['edit_quote_no'] = $quote_no;
                $this->data['order_no'] = $quote_item->quote_no; 
                $this->data['invoice_no'] = $invoice_no;
                $this->data['invoice_payments'] = $this->salesinvoice->getInvoicePayments($quote_id, $quote_no);
                
                // //check paid amount before
                // $paid_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('paid_amount as total_paid')->order_by('id', 'DESC')->limit(1)->get('ca_salesinvoice_payment')->row();
                // $paid_amount = ($paid_amount) ? $paid_amount->total_paid : 0;
                // $this->data['paid_amount'] = $paid_amount;

                // //To pay amount
                // $this->data['topay_amount'] = 0;
                // $discount_amount = $this->db->where(array('quote_id'=>$quote_id, 'quote_no'=>$quote_no))->select('SUM(discount_amount) as total_discount')->group_by('quote_id','quote_no')->get('ca_salesinvoice_payment')->row();
                // $package_amt = $quote_item->quote_total_price;
                // $paid_amt = $paid_amount;
                // $discount_amt = ($discount_amount) ? $discount_amount->total_discount : 0;
                // $topay_amount = $package_amt - ($paid_amt+$discount_amt);
                // $this->data['topay_amount'] = $topay_amount;
                // $this->data['total_discount'] = $discount_amt;

                // $delivery_handling_fee = 500;
                // $tax = 75;
                // $this->data['grand_total'] = $topay_amount + $delivery_handling_fee + $tax;

                $this->data['page'] = 'invoice_history';
                $this->load->vars($this->data);
                $this->load->view($this->data['theme'] . '/template');
            }
        }
    }


}
?>