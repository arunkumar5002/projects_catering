<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kitchen extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '') {
            redirect(base_url() . 'admin/login');
        }

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'kitchen';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('Kitchen_model', 'kitchen');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
        $this->data['kitchen_orders'] = null;
        if ($this->input->post('date_search')) {
            $fromDate = $this->input->post('fromdate');
            $category = $this->input->post('category');
            $result_data = $this->kitchen->getKitchenOrders($fromDate, $category);
        } else {           
            $result_data = $this->kitchen->getKitchenOrders();
        }
        $this->data['kitchen_orders'] = $result_data;
		$category = $this->kitchen->get_records();
		//print_r($category);
		//exit();
		$this->data['categorys'] = $category;
        $this->data['page'] = 'order_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function items() {
        $this->data['kitchen_items'] = null;
        if ($this->input->post('date_search')) {
            $fromDate = $this->input->post('fromdate');
            $category = $this->input->post('category');
            $result_data = $this->kitchen->getKitchenItems($fromDate, $category);
        } else {           
            $result_data = $this->kitchen->getKitchenItems();
        }
        $this->data['kitchen_items'] = $result_data;
		$category = $this->kitchen->get_records();
		//print_r($category);
		//exit();
		$this->data['categorys'] = $category;
        $this->data['page'] = 'item_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    
}
?>
