<?php
/**
	* User Controller Class
	* @date 07-04-2018
	* @Purpose:This controller class handles all user related api.
	* @author NS	
**/
class User extends My_Controller {
	
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
    public function __construct()
    {
        parent::__construct();
		//Load user model
        $this->load->model('user_model');		
    }

		
	/**
	 * register
	 *
	 * This function is use to handle register user api
	 *
	 * @param int 
	 * @return void
	 */
	public function register_post(){	
		//get input data
		$input = json_decode(file_get_contents('php://input'), true);
		if((isset($input['email']) && !empty($input['email'])) && (isset($input['pass']) && !empty($input['pass']))){
			// check user already exist.
			if(!$this->user_model->checkUserAlreadyExist($input['email'])){
				// save user in db.
				if ($this->user_model->setUser($input)){                             
					//echo json_encode(array('status'=>200,'message'=>''));
					$this->response([
										'status' => true,
										'message' => ''
									], REST_Controller::HTTP_OK);					
				}else{                
					//echo json_encode(array('status'=>201,'message'=>'Something went wrong'));
					$this->response([
										'status' => false,
										'message' => 'Something went wrong'
									], REST_Controller::HTTP_OK);					
				}
			} else {
				//echo json_encode(array('status'=>201,'message'=>'User already exist'));
				$this->response([
										'status' => false,
										'message' => 'User already exist'
									], REST_Controller::HTTP_OK);						
			}
		} else {
			//echo json_encode(array('status'=>201,'message'=>'Required fields are missing'));	
			$this->response([
								'status' => false,
								'message' => 'Required fields are missing'
							], REST_Controller::HTTP_OK);
		}			
    }
	
	/**
	 * login
	 *
	 * This function is use to handle login api
	 *
	 * @param email $email
	 * @param password $email
	 * @return void
	 */
	public function login_post(){
		//get input data
		$input = json_decode(file_get_contents('php://input'), true);
		if((isset($input['email']) && !empty($input['email'])) && (isset($input['pass']) && !empty($input['pass']))){
			//Authenticate user exist against credentials and return user data, if authorize. 
			if ($user = $this->user_model->authenticateUser($input)){ 
				//echo json_encode(array('status'=>200,'message'=>'','user'=>$user));			
				$this->response([
								'status' => true,
								'message' => '',
								'user'=>$user
							], REST_Controller::HTTP_OK);
			} else {
				//echo json_encode(array('status'=>201,'message'=>'Invalid Credentials'));
				$this->response([
								'status' => false,
								'message' => 'Invalid Credentials'
							], REST_Controller::HTTP_OK);
			} 
		} else {
			//echo json_encode(array('status'=>201,'message'=>'Required fields are missing'));
			$this->response([
								'status' => false,
								'message' => 'Required fields are missing'
							], REST_Controller::HTTP_OK);
		}
    
    }
       
}
