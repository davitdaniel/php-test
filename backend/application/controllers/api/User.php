<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct() {
        header('Access-Control-Allow-Origin: *');
   		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
		$this->load->model('api/User_model','um');
    }

    public function signin() {
        $input = $this->input->post();
        $email      = $input['email'];
        $password   = $input['password'];
        $user_info = array(
            'email'     => $email,
            'password'  => $password
        );
        $login_user = $this->um->signin($user_info);
        // ***** Generate Token *****
        $char = "bcdfghjkmnpqrstvzBCDFGHJKLMNPQRSTVWXZaeiouyAEIOUY!@#%";
        $token = '';
        for ($i = 0; $i < 47; $i++) $token .= $char[(rand() % strlen($char))];

        $result = array(
            'success' => false,
            'user'    => '',
            'token'   => '',
            'message' => 'Login Fail'
        );

        if( $login_user > 0 ) {
            $result = array(
                'success' => true,
                'user'    => '',
                'token'   => $token,
                'message' => 'Login Successfully!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        
    }
    
    public function signup() {
        $input = $this->input->post();
        $first_name = $input['firstName'];
        $last_name  = $input['lastName'];
        $email      = $input['email'];
        $password   = $input['password'];
        $describe   = $input['describe'];
        $phone      = $input['phone'];

        $config['upload_path']          = './';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		$config['max_width']            = 6000;
		$config['max_height']           = 6000;

		$this->load->library('upload', $config);
        $logo_file_data = '';
		if ($this->upload->do_upload('file'))
		{
            $upload_logo_file_data = $this->upload->data();
            $logo_file_data = $this->image_crop($upload_logo_file_data["full_path"]);
        }
        
        $user_info = array(
            'first_name'    => $first_name,
            'last_name'     =>$last_name,
            'email'         =>$email,
            'password'      => $password,
            'describe'      => $describe,
            'phone'         => $phone,
            'file'          => $logo_file_data
        );
        $data = $this->um->signup($user_info);
        $result = array(
            'success' => false
        );

        if( $data > 0 ) {
            $result = array(
                'success' => true,
                'message' => 'SignUp Successfully!'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    
    
    public function image_crop($filename) {
        $image_s = imagecreatefromstring(file_get_contents($filename));
        $width = imagesx($image_s);
        $height = imagesy($image_s);
        $image_aspect_ratio = ($width / $height);
        $image_m = $image_s;
        if($width < $height) {
            $image_m = imagecrop($image_s, ['x' => 0, 'y' => ($height - $width)/2, 'width' => $width, 'height' => $width]);
            $height = $width;
        }
        else if($width > $height){
            $image_m = imagecrop($image_s, ['x' => ($width - $height )/2, 'y' => 0, 'width' => $height, 'height' => $height]);
            $width = $height;
        }
        $newwidth = 100;
        $newheight = 100;
        $image = imagecreatetruecolor($newwidth, $newheight);
        imagealphablending($image,true);
        imagecopyresampled($image, $image_m,0,0,0,0,$newwidth,$newheight, $width, $height);
        
        $mask = imagecreatetruecolor($newwidth, $newheight);
        $transparent = imagecolorallocate($mask, 255,0,0);
        imagecolortransparent($mask, $transparent);
        imagefilledellipse($mask, $newwidth/2, $newheight/2, $newwidth,$newheight, $transparent);
        $red = imagecolorallocate($mask,0,0,0);
        imagecopymerge($image, $mask,0,0,0,0,$newwidth,$newheight,100);
        imagecolortransparent($image,$red);
        imagefill($image, 0, 0, $red);

        header('Conent-type: image/png');
        
        imagepng($image, './output.png');
        $binary_data = file_get_contents('./output.png');
        unlink($filename);
        return  $binary_data;
    }
}
