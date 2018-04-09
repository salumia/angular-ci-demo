<?php defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class My_Controller extends REST_Controller
{
	private $user_credential;
    public function auth()
    {        
        //JWT Auth middleware
        $headers = $this->input->get_request_header('Authorization');
        $kunci = $this->config->item('thekey'); //secret key for encode and decode
        $token= "token";
       	if (!empty($headers)) {
        	if (preg_match('/Bearer\s(\S+)/', $headers , $matches)) {
            $token = $matches[1];
        	}
    	}
        try {
           $decoded = JWT::decode($token, $kunci, array('HS256'));
           $this->user_data = $decoded;
        } catch (Exception $e) {
			
            $invalid = ['status' => $e->getMessage()]; //Respon if credential invalid
            $this->response($invalid, 401);//401
        }
    }
	
	public function setApiResponse(){      
		$this->response($invalid, 401);//401
	}
	
}