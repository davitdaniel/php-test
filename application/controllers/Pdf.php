<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Pdf extends CI_Controller {
    public function print($id) {
        $this->load->model('api/Print_model','pm');
        $data = $this->pm->getPrintInfo($id);
        $this->load->view('pdf', $data);
    }
}
