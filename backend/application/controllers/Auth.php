<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;
require_once(APPPATH.'libraries/JWT.php');
require_once(APPPATH.'libraries/REST_Controller.php');

class Auth extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_main');
    }
	
    public function login_post()
    {
        /*$u = $this->post('email'); //Username Posted
        $p = sha1($this->post('password')); //Password Posted
        $q = array('email' => $u); //For where query condition
        $jwtkey = $this->config->item('thekey');
        $val = $this->M_main->get_user($q)->row(); //Model to get single data row from database base on username
        if($this->M_main->get_user($q)->num_rows() == 0){
			echo json_encode(array('status'=>REST_Controller::HTTP_NOT_FOUND,'data'=>'','message'=>'Invalid Login'));
		}
		$match = $val->password;   //Get password for user from database
        if($p == $match){  //Condition if password matched
		*/
		$jwtkey = $this->config->item('thekey');
        if(true){  //Condition if password matched
        	$token['id'] = 1;//$val->id;  //From here
            $token['username'] = 'nitin@gmail.com';//$u;
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
