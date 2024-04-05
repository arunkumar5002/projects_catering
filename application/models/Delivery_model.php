<?php
class Delivery_model extends CI_Model{
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		
		$this->table = 'ca_delivery_challan';       
		$this->column_order = array(
            '0'=>'challan_id',
            '1'=>'invoice_number',
            '2'=>'driver_name',
			'3'=>'driver_phone',
            '4'=>'vehicle_number',
			'5'=>'status'
        );
		$this->column_search = array(
            '0'=>'invoice_number',
            '1'=>'driver_name',
			'2'=>'driver_phone',
            '3'=>'vehicle_number',
			'4'=>'status'
        );
        $this->order = array('invoice_number' => 'ASC');
	}
	
	public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function countAll($postData){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData){
		$this->db->select('*');
        $this->db->from($this->table);
		
        $i = 0;
        foreach($this->column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                if(count($this->column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }
		
        if(isset($postData['order'])){
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
	
	
	public function get_records(){
		
		$sql = "select * from ca_invoice_number";
		$result = $this->db->query($sql);
		return $result->result();			
	}
	
	public function get_vessels(){
		
		$sql = "select * from ca_vessels Where status = '1'";
		$result = $this->db->query($sql);
		return $result->result();			
	}
}
?>