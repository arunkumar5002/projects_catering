<?php 

function list_employee_department(){
	$CI 	= &get_instance();
	$result = $CI->db->select('*')->where('department_status','Active')->order_by('department_name','ASC')->get('tbl_department_category')->result_array();
	return $result;
}

function load_datatables(){
	$output = '<link rel="stylesheet" href="'.base_url().'assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">';
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">';
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">';
	
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2/css/select2.min.css">';
	$output.= '<link rel="stylesheet" href="'.base_url().'assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">';

	$output.= '<script src="'.base_url().'assets/plugins/datatables/jquery.dataTables.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>';
	$output.= '<script src="'.base_url().'assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>';
	
	$output.='<style>
		.select2-container .select2-selection--single .select2-selection__rendered {
			padding-left: 0px !important;
		}
		
		select.form-control-sm~.select2-container--default .select2-selection--single .select2-selection__arrow {
			top: 3px !important;
			padding-right: 30px;
		}
	</style>';
	
	return $output;
}

?>