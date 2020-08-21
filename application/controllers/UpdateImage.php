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
        $user_avatar_file_data = '';
        $product_logo_file_data = '';
		if ($this->upload->do_upload('product_logo'))
		{
            $upload_product_logo_file_data = $this->upload->data();
            $product_logo_file_data = $this->image_crop($upload_product_logo_file_data["full_path"]);
		}
       if ($this->upload->do_upload('user_avatar'))
		{
            $upload_user_avatar_file_data = $this->upload->data();
            $user_avatar_file_data = $this->image_crop($upload_user_avatar_file_data["full_path"]);
		}
        $data = array(
            'compay_logo_file' => '',
            'user_avatar_file' => $user_avatar_file_data,
            'product_logo_file' => $product_logo_file_data
        );
        if($data->user_avatar_file == '' && $data->user_avatar_file == '' ) {
            $data = $this->pm->getPrintInfo($id);
            $this->response($data, REST_Controller::HTTP_OK);
        }
        
        $update_id = $this->pm->update_image($data,$id);
     
        $data = $this->pm->getPrintInfo($update_id);
     
        $this->response($data, REST_Controller::HTTP_OK);
          
    }
    
    public function image_crop($filename) {
        $image_s = imagecreatefromstring(file_get_contents($filename));
        $width = imagesx($image_s);
        $height = imagesy($image_s);
        $image_aspect_ratio = ($width / $height);
        $newwidth = 285 * $image_aspect_ratio ;
        $newheight = 285;
        $image = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($image,true);
        imagecopyresampled($image, $image_s,0,0,0,0,$newwidth,$newheight, $width, $height);

        $mask = imagecreatetruecolor($newwidth, $newheight);
        $transparent = imagecolorallocate($mask, 255,0,0);
        imagecolortransparent($mask, $transparent);
        imagefilledellipse($mask, $newwidth/2, $newheight/2, min($newwidth,$newheight), min($newwidth,$newheight), $transparent);
        $red = imagecolorallocate($mask,0,0,0);
        imagecopymerge($image, $mask,0,0,0,0,$newwidth,$newheight,100);
        imagecolortransparent($image,$red);
        imagefill($image, 0, 0, $red);

        header('Conent-type: image/png');
        imagepng($image);
        imagepng($image, './output.png');
        $binary_data = file_get_contents('./output.png');
        return  $binary_data;
    }
}
