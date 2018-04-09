<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;
require_once(APPPATH.'libraries/JWT.php');
require_once(APPPATH.'libraries/REST_Controller.php');

class Auth extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('User_model');
    }
	
    public function login_post()
    {
		$input = json_decode(file_get_contents('php://input'), true);
		$u = $input['email']; //email Posted
        $p = sha1($input['pass']); //Password Posted
        $q = array('email' => $u); //For where query condition
        $jwtkey = $this->config->item('thekey');
        $invalidLogin = ['status' => 'Invalid Login']; //Response if login invalid
        $val = $this->User_model->getUser($q)->row(); //Model to get single data row from database base on email
        if($this->User_model->getUser($q)->num_rows() == 0){
			echo json_encode(array('status'=>REST_Controller::HTTP_NOT_FOUND,'data'=>'','message'=>'Invalid Email'));
		}
		$match = $val->password;   //Get password for user from database
        if($p == $match){  //Condition if password matched
			$token['id'] = $val->id; 
            $token['username'] = $u;
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60*60*5; //To here is to generate token
            $output['token'] = JWT::encode($token,$jwtkey ); //This is the output token
            echo json_encode(array('status'=>REST_Controller::HTTP_OK,'data'=>$output,'message'=>''));
        }
        else {
            echo json_encode(array('status'=>REST_Controller::HTTP_NOT_FOUND,'data'=>'','message'=>'Invalid Login'));
        }
		die;
	}  
}
