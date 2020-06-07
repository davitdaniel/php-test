<?php

class Print_model extends CI_Model{
    
    protected $_table = "sellify_print_info";

    public function __construct() {		
      parent::__construct();
      $this->load->database();
    }

    public function getPrintInfo($id) {
    	if(!empty($id)){
            $data = $this->db->get_where($this->_table, ['id' => $id])->row_array();
        }else{
            $data = $this->db->get($this->_table)->result();
        }
      	
      	return $data;
    }

    public function insert($data)
	{
		$this->db->insert($this->_table, $data);
		
		return $this->db->insert_id();
	}

	public function update($data, $id)
	{
		 $data = $this->db->update($this->_table, $data, array('id'=>$id));
		return $data;
	}

	public function delete($id)
	{
		return $this->db->delete($this->_table, array('id'=>$id));
	}
}