<?php
class Common_model extends CI_Model
{

	public function  insert( $sTableName = NULL , $aData = array() )
	{
		if ( !empty( $sTableName ) AND !empty( $aData ) ) {
			$this->db->insert($sTableName,$aData);
			return $this->db->insert_id();
		} else {
			return false;
		}
	}
	
	public function  update( $sTableName = NULL , $aData = array() , $aWhere = array() )
	{
		if ( !empty( $sTableName ) AND !empty( $aData ) AND !empty( $aWhere ) ) {
			$this->db->where( $aWhere );
			return $this->db->update( $sTableName , $aData );
		} else {
			return false;
		}
	}
	
	public function  delete( $sTableName = NULL , $aWhere = array() )
	{
		if ( !empty( $sTableName ) AND !empty( $aWhere ) ) {
			$this->db->where( $aWhere );
			return $this->db->delete( $sTableName );
		} else {
			return false;
		}
	}
	
	public function get_records($table,$fields='*',$where='')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			return $this->db->get($table)->result();		
			
	}
	
	public function get_record($table,$fields='*',$where='')
	{
			if($fields)
				$this->db->select($fields);
			if(!empty($where))
				$this->db->where($where);
			return $this->db->get($table)->row();					
	}
	
	
}

?>