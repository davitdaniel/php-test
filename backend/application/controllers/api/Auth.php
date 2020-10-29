<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	public function __construct() {
        header('Access-Control-Allow-Origin: *');
   		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		parent::__construct();
        $this->load->model('api/User_model','um');
        
    }

    public function signin() {
        $this->load->library('session');
        $data = $this->retrieveJsonPostData();
        $email      = $data->email;
        $password   = $data->password;
        $user_info = array(
            'email'     => $email,
            'password'  => $password
        );
        $login_user = $this->um->signin($user_info);

        $result = array(
            'success' => false,
            'error'    => 'invalid_credentials'
        );

        if( $login_user > 0 ) {
            $this->session->set_userdata(array(
                'email' => $email
            ));
            $login_user = $this->um->getUserInfo($email);
            $result = array(
                'success' => true,
                'token_type'    => 'bearer',
                'id' => $login_user['id'],
                'user_name' => $login_user["first_name"],
                'email' => $login_user["email"],
                'file' => '',//$login_user["file"],
                'access_token'   => session_id(),
                'message' => 'Login Successfully!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        
    }

    public function user_photo($id) {
        $data = $this->retrieveJsonPostData();
        // $id      = $data->id;
        $login_user = $this->um->getUserInfoById($id);
        $file = $login_user['file'];
        header('Content-Type: image/png');
        echo $file;
    }
    
    public function refresh() {
        $result = array(
            'success' => false,
            'message' => 'error message'
        );
        $session_data = $this->checkUser();
        if(isset($session_data) && $session_data['email'] != '') {
            $login_user = $this->um->getUserInfo($session_data['email']);
            if( isset($login_user)) {
                $this->session->set_userdata(array(
                    'email' => $login_user['email']
                ));
                session_regenerate_id();
                $result = array(
                    'success' => true,
                    'token_type'    => 'bearer',
                    'access_token'   => session_id(),
                    'message' => 'Refresh token Successfully!'
                );
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function resetPassword() {

    }

    public function checkUser() {
        $headers = $this->input->request_headers();
        $access_token = $headers["access_token"];
        $_COOKIE['ci_session'] = $access_token;
        $this->load->library('session');
        $session_data = $this->session->get_userdata("email");
        return $session_data;
    }

    public function getInfo() {
        $session_data = $this->checkUser();
        if(isset($session_data) && $session_data['email'] != '') {
            $login_user = $this->um->getUserInfo($session_data['email']);
        }
        header('Content-Type: application/json');
        if(isset($login_user)) {
            $result = array(
                'success' => true,
                'data'    => array(
                    'id' => $login_user['id'],
                    'email' => $login_user['email'],
                    'first_name' => $login_user['first_name'],
                    'last_name' => $login_user['last_name'],
                    'phone' => $login_user['phone'],
                    'describe' => $login_user['describe']
                )
            );
        }
        else {
            $result = array(
                'success' => true,
                'error'    => "invalid_credentials"
             );
        }
        echo json_encode( $result);
    }

    public function changePassword() {
        header('Content-Type: application/json');
        $session_data = $this->checkUser();
        if(isset($session_data) && $session_data['email'] != '') {
            $data = $this->retrieveJsonPostData();
            $id      = $data->id;
            $password   = $data->password;
            if ($password == '') {
                $result = array(
                    'success' => false,
                    'message'    => 'The password field is required.'
                );
                echo json_encode($result);
                return;
            }
    
            if (strlen($password) < 8) {
                $result = array(
                    'success' => false,
                    'message'    => 'The password must be at least 8 characters.'
                );
                echo json_encode($result);
                return;
            }
    
            $user_info = array(
                'id'     => $id,
                'password'  => $password
            );
    
            $flag = $this->um->changePassword($user_info);
            
            if($flag > 0) {
                $result = array(
                    'success' => true,
                    'message'    => 'updated password'
                );
            }
        }
        else {
            $result = array(
                'success' => false,
                'message'    => 'Unauthenticated.'
            );
            echo json_encode($result);
            return;
        }
       echo json_encode($result);
    }

    private function retrieveJsonPostData()
    {
        // get the raw POST data
        $rawData = file_get_contents("php://input");
        // this returns null if not valid json
        return json_decode($rawData);
    }

    public function signout() {
        header('Content-Type: application/json');
        $session_data = $this->checkUser();
        if(isset($session_data) && $session_data['email'] != '') {
            $login_user = $this->um->getUserInfo($session_data['email']);
            if(isset($login_user)) {
                session_destroy();
                $result = array(
                    'success' => true,
                    'message'    => 'Logout Successfully.'
                );
            }
            else {
                $result = array(
                    'success' => false,
                    'message'    => 'Unauthenticated.'
                );
            }
            
        }
        echo json_encode($result);
    }

    public function updateUserInfo() {
        $data = $this->retrieveJsonPostData();
        $id      = $data->id;
        $email      = $data->email;
        $user_name   = $data->user_name;

        $flag = $this->um->updateUserInfo($id, $email, $user_name);
    }

    public function update_avatar() {
        $input = $this->input->post();
        $config['upload_path']          = './';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100000;
		$config['max_width']            = 60000;
		$config['max_height']           = 60000;

		$this->load->library('upload', $config);
        $logo_file_data = '';
		if ($this->upload->do_upload('user_avatar'))
		{
            $upload_logo_file_data = $this->upload->data();
            $logo_file_data = $this->image_crop($upload_logo_file_data["full_path"]);
        }
        
        $data = $this->um->updateUserAvatar($input["id"], $logo_file_data);
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
