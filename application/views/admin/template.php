<?php
if (isset($this->session->userdata['admin_id'])) {
    $this->load->view($theme . '/includes/leftmenu');
    $this->load->view($theme . '/includes/header');;
    $this->load->view($theme . '/modules/' . $module . '/' . $page);
    $this->load->view($theme . '/includes/footer');
} else {
   redirect(base_url().'admin/login');
}
?>