<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'package';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('package_model', 'package');
        $this->load->model('category_model', 'category');
        $this->load->model('menu_model', 'menu');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
        $this->data['package_category_item'] = $this->package->getPackageCategoryItem();
        //echo $this->db->last_query(); exit;
        $this->data['page'] = 'package_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function addEditPackageItem($package_id=NULL) {
        $this->data['package_category_item'] = null;
        if ($package_id) {
            $this->data['package_category_item'] = $this->package->getPackageCategoryItem($package_id);
        }
        //category
        $this->data['category_items'] = $this->category->getCategoryItems();
        //menu
        $this->data['menu_items'] = $this->menu->getMenuItems();

        $this->data['page'] = 'package_add_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function insertPackageItem($package_id=NULL) {
        //print_r($_POST); exit;
        $this->data['package_category_item'] = null;
        if ($package_id) {
            $this->data['package_category_item'] = $this->package->getPackageCategoryItem($package_id);
        }

        $this->form_validation->set_rules('package_name', 'Package Name', 'required|trim');
        $this->form_validation->set_rules('package_category_id', 'Package Category', 'required|trim');
        $this->form_validation->set_rules('pacakge_item_list[]', 'Package Items', 'required|trim');
        $this->form_validation->set_rules('package_price', 'Price', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['page'] = 'package_add_edit';
            $this->data['category_items'] = $this->category->getCategoryItems();
            $this->data['menu_items'] = $this->menu->getMenuItems();
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            $package_name = trim($this->input->post('package_name'));
            $package_category_id = trim($this->input->post('package_category_id'));
            $pacakge_item_ids = implode(',', $this->input->post('pacakge_item_list'));
            $package_price = trim($this->input->post('package_price'));
            $inputData = array(
                'package_name' => $package_name,
                'package_category_id' => $package_category_id,
                'package_item_id' => $pacakge_item_ids,
                'package_price' => $package_price,
            );           
            if($package_id) { // Edit
                if($this->package->updatePackageItem($package_id, $inputData)) {
                    $this->session->set_flashdata('success', 'Package was edited successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/package");
            } else { // Add
                if($this->package->addPackageItem($inputData)) {
                    $this->session->set_flashdata('success', 'Package was added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/package/addEditPackageItem");
            }            
        }
    }
    
    public function deletePackageItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_package');
        $this->session->set_flashdata('success', 'Selected package was deleted successfully');
        redirect(base_url().$this->data['theme']."/package");
    }
}
?>
