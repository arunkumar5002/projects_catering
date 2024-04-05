<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->data['theme'] = 'web';
        $this->data['module'] = 'home';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();
    }

    public function index() {
        //$this->data['page'] = 'index';
        //$this->load->vars($this->data);
        $this->load->view($this->data['theme'].'/modules/'.$this->data['module'].'/home.php');
    }

    
}
?>
