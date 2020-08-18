<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class UpdateImage extends REST_Controller {

	public function __construct() {
		header('Access-Control-Allow-Origin: *');
   		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
		$this->load->model('api/Print_model','pm');
    }

    public function index_get($id = 0) {
        $data = $this->pm->getPrintInfo($id);
         
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    public function index_post() {
        $id = $this->input->get("id");
        $input = $this->post();
        
		$config['upload_path']          = './';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('product_logo'))
		{
                $error = array('error' => $this->upload->display_errors());
                $this->response($error, REST_Controller::HTTP_OK);
		}
		else
		{
            $upload_product_logo_file_data = $this->upload->data();
            $this->image_crop($upload_product_logo_file_data["full_path"]);
            $binary_data = file_get_contents('./output.png');
			$data = array(
                'compay_logo_file' => '',
                'user_avatar_file' => '',
                'product_logo_file' => $binary_data
            );
            $update_id = $this->pm->update_image($data,$id);
         
            $data = $this->pm->getPrintInfo($update_id);
         
            $this->response($data, REST_Controller::HTTP_OK);
        }
          
    }
    
    public function image_crop($filename) {
        $image_s = imagecreatefromstring(file_get_contents($filename));
        $width = imagesx($image_s);
        $height = imagesy($image_s);
        $newwidth = 285;
        $newheight = 285;
        $image = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($image,true);
        imagecopyresampled($image, $image_s,0,0,0,0,$newwidth,$newheight, $width, $height);

        $mask = imagecreatetruecolor($newwidth, $newheight);
        $transparent = imagecolorallocate($mask, 255,0,0);
        imagecolortransparent($mask, $transparent);
        imagefilledellipse($mask, $newwidth/2, $newheight/2, $newwidth, $newheight, $transparent);
        $red = imagecolorallocate($mask,0,0,0);
        imagecopymerge($image, $mask,0,0,0,0,$newwidth,$newheight,100);
        imagecolortransparent($image,$red);
        imagefill($image, 0, 0, $red);

        header('Conent-type: image/png');
        imagepng($image);
        imagepng($image, './output.png');
        imagedestory($image);
        imagedestory($mask);
    }
}
