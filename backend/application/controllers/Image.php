<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Image extends CI_Controller {
    public function company_logo($id) {
        $this->load->model('api/Print_model','pm');
        $data = $this->pm->getCompanyLogoImageById($id);
        $this->output_image($data);
    }

    public function user_avatar($id) {
        $this->load->model('api/Print_model','pm');
        $data = $this->pm->getUserAvatarById($id);
        $this->output_image($data);
        
        
    }

    public function product_logo($id) {
        $this->load->model('api/Print_model','pm');
        $data = $this->pm->getProductLogoImageById($id);
        $this->output_image($data);
    }

    public function output_image($data) {
        if($data != '') {
            $im = imagecreatefromstring($data);
            if ($im !== false) {
                header('Content-Type: image/png');
                imagepng($im);
                imagedestroy($im);

            }
        }
    }
    
}
