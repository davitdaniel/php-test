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
		$data = array(
			'first_name' => $data['first_name'],
			'sur_name' => $data['sur_name'],
			'title' => $data['title'],
			'company_name' => $data['company_name'],
			'company_logo' => $data['company_logo'],
			'company_website' => $data['company_website'],
			'business_goals' => $data['business_goals'],
			'compay_logo_file' => $data['compay_logo_file'],
			'user_avatar_file' => $data['user_avatar_file'],
			'product_logo_file' => $data['product_logo_file'],
			'textbox1' => $data['textbox1'],
			'textbox2' => $data['textbox2'],
			'textbox3' => $data['textbox3'],
			'textbox4' => $data['textbox4']
		);

		$date = date("Y-m-d H:i:s");
		$expired = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($date)));
		$this->db->where(array('created_at<' => $expired))->delete($this->_table);
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

	public function update_image($data, $id)
	{
		 $data = $this->db->update($this->_table, $data, array('id'=>$id));
		return $data;
	}
}