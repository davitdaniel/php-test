<?php

class User_model extends CI_Model{
    
    public function __construct() {		
      parent::__construct();
      $this->load->database();
    }

    public function getUserInfo() {
      $query = $this->db->get("user");
      $result = $query->row_array();
      return $result;
    }
}

