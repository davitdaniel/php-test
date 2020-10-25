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
            $result = array(
                'success' => true,
                'token_type'    => 'bearer',
                'access_token'   => session_id(),
                'message' => 'Login Successfully!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        
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
}
