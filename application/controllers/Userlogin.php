<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userlogin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->data['theme']    = 'web';
        $this->data['module']    = 'login';
        $this->data['page']     = '';
        $this->data['base_url'] = base_url();

        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index() {
        if (empty($this->session->userdata['user_id'])) {
	  		$this->load->view($this->data['theme'].'/modules/'.$this->data['module'].'/login');
	    }
	    else {
	      redirect(base_url().$this->data['theme']."/user_dashboard");
	    }
    }

    public function is_valid_login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->data['theme'].'/modules/'.$this->data['module'].'/login2');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->user_model->login_check($email, $password);
            
            if ($user) {
                $this->session->set_userdata('user_id', $user['id']);
                $this->session->set_userdata('user_name', $user['username']);
                $this->session->set_userdata('user_email', $user['email']);
                $this->session->set_userdata('user_mobile', $user['mobile']);
                redirect(base_url().$this->data['theme']."/user_dashboard");
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
