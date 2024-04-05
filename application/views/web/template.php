<?php
    $this->load->view($theme . '/includes/leftmenu');
    $this->load->view($theme . '/includes/header');
    $this->load->view($theme . '/modules/' . $module . '/' . $page);
    $this->load->view($theme . '/includes/footer');
?>