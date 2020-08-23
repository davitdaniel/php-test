<?php

class Print_model extends CI_Model{

    protected $_table = "sellify_print_info";

    public function __construct() {		
      parent::__construct();
      $this->load->database();
    }

    public function getPrintInfo($id) {
    	if(!empty($id)){
            $data = $this->db->select("id, first_name, sur_name, title, company_name,company_logo, company_website, business_goals,textbox1, textbox2,textbox3,textbox4, created_at ")->get_where($this->_table, ['id' => $id])->row_array();
        }else{
            $data = $this->db->select("id, first_name, sur_name, title, company_name, company_logo, company_website, business_goals,textbox1, textbox2,textbox3,textbox4, created_at ")->get($this->_table)->result();
        }
      	
      	return $data;
	}
	
	public function getPrintInfoWithFile($id) {
		if(!empty($id)){
            $data = $this->db->select("*")->get_where($this->_table, ['id' => $id])->row_array();
        }
      	
      	return $data;
	}

	
	public function getCompanyLogoImageById($id) {
    	if(!empty($id)){
            $data = $this->db->select("company_logo_file")->get_where($this->_table, ['id' => $id])->row_array()["company_logo_file"];
        }
      	else {
			  $data = '';
		  }
      	return $data;
	}
	
	public function getUserAvatarById($id) {
    	if(!empty($id)){
            $data = $this->db->select("user_avatar_file")->get_where($this->_table, ['id' => $id])->row_array()["user_avatar_file"];
        }
      	else {
			  $data = '';
		  }
      	return $data;
	}
	
	public function getProductLogoImageById($id) {
    	if(!empty($id)){
            $data = $this->db->select("product_logo_file")->get_where($this->_table, ['id' => $id])->row_array()["product_logo_file"];
        }
      	else {
			  $data = '';
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
			'company_website' => $data['company_website'],
			'business_goals' => $data['business_goals'],
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
		return $id;
	}
}