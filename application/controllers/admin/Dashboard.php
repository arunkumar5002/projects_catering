<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $data;

    public function __construct() {
	    parent::__construct();

        if ($this->session->userdata('admin_id') == '') {
            redirect(base_url() . 'admin/login');
        }

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'dashboard';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();
	
	    $this->load->model('dashboard_model', 'dashboard');
    }

    public function index() {
        $this->data['page'] = 'index';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

}
