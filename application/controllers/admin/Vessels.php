<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vessels extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'vessels';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('Vessels_model', 'vessels');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
        $this->data['vessels_items'] = $this->vessels->getVesselsItems();
        $this->data['page'] = 'vessels_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function addEditVesselsItem($vessels_id=NULL) {
        $this->data['vessels_item'] = null;
        if ($vessels_id) {
            $this->data['vessels_item'] = $this->vessels->getVesselsItems($vessels_id);
        }
        $this->data['page'] = 'vessels_add_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function insertVesselsItem($vessels_id=NULL) {
        $this->data['vessels_item'] = null;
        if ($vessels_id) {
            $this->data['vessels_item'] = $this->vessels->getVesselsItems($vessels_id);
        }

        $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');;
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
        $this->form_validation->set_rules('cost_of_vessels', 'Cost of Vessels', 'required|numeric|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['page'] = 'vessels_add_edit';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            $inputData = array(
                'product_name' => $this->input->post('product_name'),
                'quantity' => $this->input->post('quantity'),
                'cost_of_vessels' => $this->input->post('cost_of_vessels')
            );
            if($vessels_id) { // Edit
                if($this->vessels->updateVesselsItem($vessels_id, $inputData)) {
                    $this->session->set_flashdata('success', 'Vessels was edited successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/vessels");
            } else { // Add
                if($this->vessels->addVesselsItem($inputData)) {
                    $this->session->set_flashdata('success', 'Vessels was added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/vessels/addEditvesselsItem");
            }            
        }
    }
    
    public function deleteVesselsItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_vessels');
        $this->session->set_flashdata('success', 'Selected vessels was deleted successfully');
        redirect(base_url().$this->data['theme']."/vessels");
    }
}
?>
