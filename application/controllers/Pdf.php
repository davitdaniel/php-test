<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Pdf extends CI_Controller {
    public function print($id) {
        $this->load->model('api/Print_model','pm');
        $data = $this->pm->getPrintInfoWithFile($id);
        $data["exist_avatar"] = 1;
        $data["exist_product_logo"] = 1;
        if (!isset($data["product_logo_file"]) || $data["product_logo_file"] === "") {
            $data["exist_product_logo"] = 0;
        }
        if (!isset($data["user_avatar_file"]) || $data["user_avatar_file"] === "") {
            $data["exist_avatar"] = 0;
        }

        $this->load->helper('url');
        $this->load->view('pdf', $data);
    }
}
