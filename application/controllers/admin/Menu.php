<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'menu';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('Menu_model', 'menu');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
        $this->data['menu_items'] = $this->menu->getMenuItems();
        $this->data['page'] = 'menu_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function addEditMenuItem($menu_id=NULL) {
        $this->data['menu_item'] = null;
        if ($menu_id) {
            $this->data['menu_item'] = $this->menu->getMenuItems($menu_id);
        }
        $this->data['page'] = 'menu_add_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function insertMenuItem($menu_id=NULL) {
        $this->data['menu_item'] = null;
        if ($menu_id) {
            $this->data['menu_item'] = $this->menu->getMenuItems($menu_id);
        }

        $this->form_validation->set_rules('item_name', 'Item Name', 'required|trim');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['page'] = 'menu_add_edit';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            $inputData = array(
                'item_name' => $this->input->post('item_name'),
                'quantity' => $this->input->post('quantity'),
                'price' => $this->input->post('price')
            );
            if($menu_id) { // Edit
                if($this->menu->updateMenuItem($menu_id, $inputData)) {
                    $this->session->set_flashdata('success', 'Item was edited successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/menu");
            } else { // Add
                if($this->menu->addMenuItem($inputData)) {
                    $this->session->set_flashdata('success', 'Item was added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/menu/addEditMenuItem");
            }            
        }
    }
    
    public function deleteMenuItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_menu');
        $this->session->set_flashdata('success', 'Selected item was deleted successfully');
        redirect(base_url().$this->data['theme']."/menu");
    }
}
?>
