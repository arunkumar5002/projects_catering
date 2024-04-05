<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    
    public function login_check($email, $password) {
        $this->db->where('email', $email);
        //$this->db->where('password', md5($password)); // password is stored as MD5 hash
        $this->db->where('password', $password);
        $this->db->where('status', 1);
        
        $query = $this->db->get('ca_admin');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
