<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->data['theme']    = 'admin';
        $this->data['module']    = 'login';
        $this->data['page']     = '';
        $this->data['base_url'] = base_url();

        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->library("session");
    }

    public function index() {
        if (empty($this->session->userdata['admin_id'])) {	  		
	  		$this->load->view($this->data['theme'].'/modules/'.$this->data['module'].'/login');
	    }
	    else {
	      redirect(base_url().$this->data['theme']."/dashboard");
	    }
    }

    public function is_valid_login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->data['theme'].'/modules/'.$this->data['module'].'/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->admin_model->login_check($email, $password);
            
            if ($user) {
                $this->session->set_userdata('admin_id', $user['id']);
                $this->session->set_userdata('username', $user['username']);
                $this->session->set_userdata('email', $user['email']);
                $this->session->set_userdata('mobile', $user['mobile']);
                $this->session->set_userdata('role', $user['role']);
                redirect(base_url().$this->data['theme']."/dashboard");
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect(base_url().$this->data['theme']."/login");
            }
        }
    }

    public function logout() {
        // Load the session library
        $this->load->library('session');
        // Destroy the session
        $this->session->sess_destroy();
        // Redirect 
        redirect(base_url());
    }
}
