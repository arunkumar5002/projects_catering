<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends CI_Controller {

    public $data;

    public function __construct() {
	    parent::__construct();

        if ($this->session->userdata('user_id') == '') {
            redirect(base_url() . 'userlogin');
        }

        $this->data['theme'] = 'web';
        $this->data['module'] = 'dashboard';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();
	
	    $this->load->model('dashboard_model', 'dashboard');
	    $this->load->model('kitchen_model', 'kitchen');
    }

    public function index() {
        $this->data['page'] = 'index';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function orders() {
        $this->data['theme'] = 'web';
        $this->data['module'] = 'kitchen';
        $this->data['kitchen_orders'] = $this->kitchen->getKitchenOrders();
        $this->data['page'] = 'order_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function items() {
        $this->data['theme'] = 'web';
        $this->data['module'] = 'kitchen';
        $this->data['kitchen_items'] = $this->kitchen->getKitchenItems();
        $this->data['page'] = 'item_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

}
