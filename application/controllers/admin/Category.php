<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'category';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('category_model', 'category');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
        $this->data['category_items'] = $this->category->getCategoryItems();
        $this->data['page'] = 'category_list';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function addEditCategoryItem($category_id=NULL) {
        $this->data['category_item'] = null;
        if ($category_id) {
            $this->data['category_item'] = $this->category->getCategoryItems($category_id);
        }
        $this->data['page'] = 'category_add_edit';
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }

    public function insertCategoryItem($category_id=NULL) {
        $this->data['category_item'] = null;
        if ($category_id) {
            $this->data['category_item'] = $this->category->getCategoryItems($category_id);
        }

        $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->data['page'] = 'category_add_edit';
            $this->load->vars($this->data);
            $this->load->view($this->data['theme'] . '/template');
        } else {
            $inputData = array(
                'category_name' => $this->input->post('category_name'),
            );
            if($category_id) { // Edit
                if($this->category->updateCategoryItem($category_id, $inputData)) {
                    $this->session->set_flashdata('success', 'Category was edited successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/category");
            } else { // Add
                if($this->category->addCategoryItem($inputData)) {
                    $this->session->set_flashdata('success', 'Category was added successfully');
                } else {
                    $this->session->set_flashdata('error', 'Something went wrong, try again');
                }
                redirect(base_url().$this->data['theme']."/category/addEditCategoryItem");
            }            
        }
    }
    
    public function deleteCategoryItem($id) {
        $this->db->where('id', $id);
        $this->db->delete('ca_category');
        $this->session->set_flashdata('success', 'Selected category was deleted successfully');
        redirect(base_url().$this->data['theme']."/category");
    }
}
?>
