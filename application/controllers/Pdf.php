<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Pdf extends CI_Controller {
    public function index() {
        $this->load->view('pdf');
    }
}
