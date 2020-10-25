<?php

class User_model extends CI_Model{

    protected $_table = "user";

    public function __construct() {		
      parent::__construct();
      $this->load->database();
    }

    public function signin($user_info) {
        $email = $user_info['email'];
        $password = md5($user_info['password']);
        $login_user = $this->db->select("count(*) as count")->get_where($this->_table, ['email' => $email, 'password' => $password])->row_array();
        
      	return $login_user['count'];
	}
	
    public function signup($user_info)
	{
        $user_info['password'] = md5($user_info['password']);
    	$this->db->insert($this->_table, $user_info);
		return $this->db->insert_id();
  }
  
  public function getUserInfo($email) {
    $login_user = $this->db->select("*")->get_where($this->_table, ['email' => $email])->row_array();
    return $login_user;
  }

  public function changePassword($user_info) {
    $this->db->where('id', $user_info['id']);
    $this->db->set('password', md5($user_info['password']));
    $result = $this->db->update($this->_table);
    return $result;
  }
  
}