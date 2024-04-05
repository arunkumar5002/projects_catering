<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salesquote extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'sales';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('salesquote_model', 'salesquote');
        $this->load->model('package_model', 'package');
        $this->load->model('category_model', 'category');
        $this->load->model('menu_model', 'menu');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
        $this->data['quote_items'] = $this->salesquote->getSalesquoteItems();
        $this->data['quote_package_details'] = null;
        $post_quote_no = $this->input->post('quote_no');
        $this->data['page'] = 'quote_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function get_quote_package_details() {
        $quote_no = $this->input->post('quote_no'); 
        $quote_package_details = $this->salesquote->getSalesquotePackages($quote_no);
        echo json_encode($quote_package_details);
    }

    public function addEditQuoteItem($quote_id=NULL) {
        $this->data['quote_item'] = null;
        $this->data['edit_quote_id'] = null;
        $this->data['package_list_count'] = null;
        $this->data['edit_quote_no'] = null;
        $this->data['quote_package_details'] = null;
        if ($quote_id) {
            $quote_item = $this->salesquote->getSalesquoteItems($quote_id);
            $this->data['quote_item'] = $quote_item;
            $this->data['edit_quote_id'] = $quote_id;
            $this->data['edit_quote_no'] = $quote_item->quote_no;
            $this->data['quote_package_details'] = $this->salesquote->getSalesquotePackages($quote_item->quote_no);
        }

        //quotation no
        $this->data['quote_no'] = null;
        $quote_no = 1001;
        $qno_frm_db = $this->db->where('status',1)->select('quote_no')->order_by('id', 'desc')->limit('1')->get('ca_salesquote')->row();
        $last_qno_frm_db = ($qno_frm_db) ? (($qno_frm_db->quote_no) + 1) : $quote_no;
        $this->data['quote_no'] = $last_qno_frm_db;
        //package
        $this->data['packages'] = $this->package->getPackageItems();
        $this->data['package_list_count'] = count($this->data['packages']);
        // //category
        $this->data['category_items'] = $this->category->getCategoryItems();
        //menu
        $this->data['menu_items'] = $this->menu->getMenuItems();
        $this->data['page'] = 'quote_add_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function editQuoteItem($quote_id=NULL,$quote_no=NULL) {
        $this->data['quote_item'] = null;
        $this->data['edit_quote_id'] = null;
        $this->data['package_list_count'] = null;
        if ($quote_id && $quote_no) {
            $this->data['quote_item'] = $this->salesquote->getSalesquoteItems($quote_id);
            $this->data['quote_package_details'] = $this->salesquote->getSalesquotePackages($quote_no);
            $this->data['edit_quote_id'] = $quote_id;
            $this->data['selected_package_ids'] = array_column($this->data['quote_package_details'],'quote_package_id');
        }
        //package
        $this->data['packages'] = $this->package->getPackageItems();
        $this->data['package_list_count'] = count($this->data['packages']);
        //category
        $this->data['category_items'] = $this->category->getCategoryItems();
        //menu
        $this->data['menu_items'] = $this->menu->getMenuItems();
        $this->data['page'] = 'quote_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function insertSalesquoteItem($quote_id=NULL) {
        //print_r($_POST); exit;
        $this->data['edit_quote_id'] = null;        
        $this->data['quote_item'] = null;
        $this->data['package_list_count'] = null;
        $this->data['edit_quote_no'] = null;
        $this->data['quote_package_details'] = null;
        if ($quote_id) {
            $this->data['quote_item'] = $this->salesquote->getSalesquoteItems($quote_id);
            $this->data['edit_quote_id'] = $quote_id;
        }

        //quotation no
        $this->data['quote_no'] = null;
        $quote_no = 1001;
        $qno_frm_db = $this->db->where('status',1)->select('quote_no')->order_by('id', 'desc')->limit('1')->get('ca_salesquote')->row();
        $last_qno_frm_db = ($qno_frm_db) ? (($qno_frm_db->quote_no) + 1) : $quote_no;
        $this->data['quote_no'] = $last_qno_frm_db;

        //package
        $this->data['packages'] = $this->salesquote->getPackages();
        $this->data['package_list_count'] = count($this->data['packages']);
        //menu
        $this->data['menus'] = $this->menu->getMenuItems();

        $this->form_validation->set_rules('booking_datetime', 'Booking Date', 'required|trim');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'Contact Number', 'required|trim');
        $this->form_validation->set_rules('address', 'Contact Address', 'required|trim');
        // $this->form_validation->set_rules('quote_package_name[]', 'Package', 'required|trim');
        // $this->form_validation->set_rules('order_date[]', 'Order Date', 'required|trim');
        // $this->form_validation->set_rules('quantity[]', 'Quantity', 'required|trim');
        // $this->form_validation->set_rules('final_price[]', 'Final Price', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['page'] = 'quote_add_edit';
            $this->data['packages'] = $this->salesquote->getPackages();
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            //$quote_no = substr(trim($this->input->post('quote_no')), 3);
            $quote_no = trim($this->input->post('quote_no'));
            $booking_datetime = $this->input->post('booking_datetime');
            $customer_name = $this->input->post('customer_name');
            $mobile_no = trim($this->input->post('mobile_no'));
            $address = $this->input->post('address');
            $quote_package_id = $this->input->post('quote_package_name');
            $order_date = $this->input->post('order_date');
            $quantity = $this->input->post('quantity');
            $final_price = $this->input->post('final_price');
            $inputData = array(
                'quote_no' => $quote_no,
                'booking_datetime' => $booking_datetime,
                'customer_name' => $customer_name,
                'mobile_no' => $mobile_no,
                'address' => $address
            );  
                     
            if($quote_id) { // Edit
                $this->salesquote->updateSalesquoteItem($quote_id, $inputData);
                for ($i=0; $i<count($quote_package_id); $i++) { 
                    $update_inputDataArray = array(
                        'salesquote_id' => $quote_id,
                        //'quote_package_id' => $quote_package_id[$i],
                        'order_date' => $order_date[$i],
                        'quantity' => $quantity[$i],
                        'final_price' => $final_price[$i],
                        'status' => 1
                    );
                    $this->db->where('quote_no', $quote_no);
                    $this->db->where('quote_package_id', $quote_package_id[$i]);
                    $this->db->update('ca_salesquote_details', $update_inputDataArray);
                }
                $this->session->set_flashdata('success', 'Sales quote was edited successfully');
                redirect(base_url().$this->data['theme']."/salesquote");
            } else { // Add
                if($this->salesquote->addSalesquoteItem($inputData)) {
                    $salesquote_insert_id = $this->db->insert_id();

                    if($salesquote_insert_id > 0) {
                        for ($i=0; $i<count($quote_package_id); $i++) { 
                            $update_inputDataArray = array(
                                'salesquote_id' => $salesquote_insert_id,
                                //'quote_package_id' => $quote_package_id[$i],
                                'order_date' => $order_date[$i],
                                'quantity' => $quantity[$i],
                                'final_price' => $final_price[$i],
                                'status' => 1
                            );
                            $this->db->where('quote_no', $quote_no);
                            $this->db->where('quote_package_id', $quote_package_id[$i]);
                            $this->db->update('ca_salesquote_details', $update_inputDataArray);
                        }
                    }
                    $this->session->set_flashdata('success', 'Sales quote was added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/salesquote");
            }            
        }
    }
    
    public function deleteQuoteItem($id) {        
        $this->db->where('id', $id);
        $this->db->delete('ca_salesquote');
        $this->db->where('salesquote_id', $id);
        $this->db->delete('ca_salesquote_details');
        $this->db->where('quote_id', $id);
        $this->db->delete('ca_salesinvoice_payment');
        $this->session->set_flashdata('success', 'Selected sales quote was deleted successfully');
        redirect(base_url().$this->data['theme']."/salesquote");
    }

    // for dependent dropdown
    public function get_package_categories() {
        $package_id = $this->input->post('package_id');
        $quote_no = $this->input->post('quote_no');
        $package_details = $this->package->getPackageCategoryItem($package_id);

        $updated_data = $this->db->select('custom_menu_items as item_ids')->where(array('quote_no' => $quote_no,'quote_package_id' => $package_id, 'status' => 1))->get('ca_salesquote_details')->row();
              
        $item_ids =  explode(",", $package_details->item_ids);            
        if(!empty($updated_data)) {
            $item_ids =  explode(",", $updated_data->item_ids);
        }

        $results = array();
        $results = array('package_details'=>$package_details,'package_items'=>$item_ids);
        echo json_encode($results);
    }

    public function get_package_menus($id,$quote_no) {
        $response = array();
        //$quote_no = substr($quote_no, 3);
        $updated_data = $this->db->select('custom_menu_items')->where(array('quote_no' => $quote_no,'quote_package_id' => $id, 'status' => 1))->get('ca_salesquote_details')->row_array();
        $data = $this->db->select('menu_id')->where(array('package_id' => $id, 'status' => 1))->get('ca_package_menu')->row_array();
        $response['menu_ids'] = explode(",", $data['menu_id']);              
        if(!empty($updated_data)) {
            $response['menu_ids'] = explode(",", $updated_data['custom_menu_items']);              
        }
        echo json_encode($response);
    }

    public function update_custom_package_items_copy() {
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

    // for view quote
    public function viewQuoteItem($id=NULL) {
        if($id) {
            $salesquote_items = $this->salesquote->getSalesquoteItems();
            $this->data['quote_items'] = $this->salesquote->getSalesquoteItems();
            $this->data['page'] = 'quote_view';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');    
        }
    }



}
?>
