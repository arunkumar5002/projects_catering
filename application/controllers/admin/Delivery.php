<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_id') == '' ||  ($this->session->userdata['admin_id'] != 1)) {
            redirect(base_url() . 'admin/login');
        } 

        $this->data['theme'] = 'admin';
        $this->data['module'] = 'delivery';
        $this->data['page'] = '';
        $this->data['base_url'] = base_url();

        $this->load->model('Delivery_model', 'delivery');
		$this->load->model('Common_model', 'common');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library("pagination");
    }

    public function index() {
		
        $this->data['page'] = 'delivery_add';
		$records = $this->common->get_records("ca_delivery_challan","*",array("status"=>1));
		$this->data['challanno'] = count($records)+1;
		$this->data['invoicenumber'] = $this->delivery->get_records();
        $this->data['get_vessels'] = $this->delivery->get_vessels();		
        $this->load->vars($this->data);
        $this->load->view($this->data['theme'] . '/template');
    }
	
	public function submit_delivery_challan(){
		
    $challan_id = $this->input->post('challan_id');
    
    $data_arr = array(
        'invoice_number' => $this->input->post('invoice_number'),
        'driver_name' => $this->input->post('driver_name'),
        'driver_phone' => $this->input->post('driver_phone'),
        'vehicle_number' => $this->input->post('vehicle_number'),
        'package_category' => $this->input->post('package_category'),
    );

    
    if (empty($challan_id)) {
        $this->common->insert('ca_delivery_challan', $data_arr);
        $challan_id = $this->db->insert_id();
        $output = array(
            'status' => 'Success',
            'msg' => 'Delivery Challan Added Successfully',
        );
    } else {
        $where = "challan_id='$challan_id'";
        $this->common->update('ca_delivery_challan', $data_arr, $where);
        $output = array(
            'status' => 'Success',
            'msg' => 'Delivery Challan Updated Successfully',
        );
    }

    
    $vessels = $this->input->post("vessels");
    $quantity = $this->input->post("quantity");

    if (!empty($vessels) && !empty($quantity)) {
        foreach ($vessels as $key => $vessels_name) {
            $data = array(
                'challan_id' => $challan_id,
                'vessels_name' => $vessels_name,
                'quantity' => $quantity[$key],
            );
            $this->common->insert("ca_delivery_challan_details", $data);
        }
    }

    echo json_encode($output);
}

	
	public function list_delivery_challan(){
		$data = $row = array();
		$memData 	= $this->delivery->getRows($_POST);
		$i 			= $_POST['start'];
		
		foreach($memData as $member){
			$i++;
			
			
			$action=	"<button type='button' class='btn btn-primary btn-sm edit_data' data-challan_id='".$member->challan_id."' data-invoice_number='".$member->invoice_number."' data-driver_name='".$member->driver_name."'  data-driver_phone='".$member->driver_phone."'  data-vehicle_number='".$member->vehicle_number."'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;";
			$action.=	"<button type='button' class='btn btn-danger btn-sm delete_data' data-challan_id='".$member->challan_id."'><i class='fa fa-trash'></i></button>&nbsp;&nbsp;";
			$action .= "<a href='" . base_url() . "printchallan?id=" . $member->challan_id . "' class=' print_data btn btn-info btn-sm' target='_blank'><i class='fa fa-print'></i></a>";
             

			
			
			$data[] = array($i, $member->invoice_number,$member->driver_name,$member->driver_phone,$member->vehicle_number, $action);
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->delivery->countAll($_POST),
			"recordsFiltered" 	=> $this->delivery->countFiltered($_POST),
			"data" 				=> $data,
		);
		echo json_encode($output);
	}
	
	public function delete_delivery_challan(){
		$challan_id = $this->input->post('keys');
		
		$where = "challan_id='$challan_id'";
		$result = $this->common->delete('ca_delivery_challan',$where);
		
		if($result==true){
			$output = array(
				'status'	=> 'Success',
				'msg'		=> 'Delivery Challan Deleted Successfully',
			);
		}else{
			$output = array(
				'status'	=> 'Warning',
				'msg'		=> 'Unable to Delete the Delivery Challan Details',
			);
		}
		echo json_encode($output);
	}
	
	public function get_invoicedetails(){
		
		$quote_no = trim(strip_tags($this->input->post('quote_no')));			
		$data = $this->common->get_record("ca_salesquote_details","*",array("status"=>1,"quote_no"=>$quote_no));	
		echo json_encode($data);
	}
	
	public function get_row(){
		
		$this->data['rowid'] = trim(strip_tags($this->input->post('rowid')));			
		$this->data['get_vessels'] = $this->delivery->get_vessels();	
		$this->load->view('admin/modules/delivery/delivery_addrow',$this->data);
	}
				
	public function get_challan_details(){
		
		$challan_id = $_GET['id']; 
	    $this->data['get_challan'] = $this->common->get_record("ca_delivery_challan","*",array("challan_id"=>$challan_id));
		$this->data['get_challan_records'] = $this->common->get_records("ca_delivery_challan_details","*",array("challan_id"=>$challan_id));
		$this->load->view('admin/modules/delivery/print_delivery_challan',$this->data);
		
	}		
 
}
?>

