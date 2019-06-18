<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Records_model extends CI_Model {
	//deleteRecord
	public function delete($id){
		$this->db->where('id', $id)->delete('bf_records');
		
	}
	
	//getRecord
	public function getRecord($id){
		return $this->db->get_where('bf_records', array('id'=>$id))->row_object();
	}
	
	
	//getAllRecords
	public function getAllRecords(){
		return $this->db->select('
							bf_records.id,
							bf_records.first_name,
							bf_records.last_name,
							bf_records.position,
							bf_records.salary					
							')
				->from('bf_records')
				->order_by('id', 'ASC')
				->get()->result_object();
	}
	
    //save user
    public function save($data){
        $this->db->insert('bf_records', $data);
    }
  
  
}
