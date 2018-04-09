<?php 
/**
	* Post Controller Class
	* @date 07-04-2018
	* @Purpose:This controller class handles all post related api.
	* @author NS
	
**/
class Post extends My_Controller
{
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	function __construct(){
		parent::__construct();				
		//load post model
		$this->load->model("Post_model");
	}
	
	/**
	 * index
	 *
	 * This function is use to handle get all posts api
	 *
	 * @return void
	 */
	function index_get(){
		// get all posts from db
		if($data=$this->Post_model->getAllPosts()){
			//echo json_encode(array('status'=>200,'posts'=>$data,'message'=>''));	
			$this->response([
                    'status' => true,
					'posts' => $data,
                    'message' => ''
                ], REST_Controller::HTTP_OK);
		} else {
			//echo json_encode(array('status'=>200,'posts'=>array(),'message'=>'Posts not found in database'));
			$this->response([
                    'status' => false,
                    'message' => 'Posts not found in database'
                ], REST_Controller::HTTP_OK);
		} 		
	}	
	
	/**
	 * myPosts
	 *
	 * This function is use to handle get user posts api
	 *
	 * @param int 'user Id'
	 * @return void
	 */
	function myPosts_get(){
		//$this->auth();
		//get user id from url
		$userId = $this->uri->segment(3);
		
		// get user posts from db
		if($data=$this->Post_model->getAllPostsByUser($userId)){
			//echo json_encode(array('status'=>200,'posts'=>$data,'message'=>''));
			$this->response([
                    'status' => true,
					'posts'=>$data,
                    'message' => ''
                ], REST_Controller::HTTP_OK);			
		} else {
			//echo json_encode(array('status'=>200,'posts'=>array(),'message'=>'Your dont have posts'));
			$this->response([
                    'status' => false,
                    'message' => 'You dont have posts'
                ], REST_Controller::HTTP_OK);
		} 
	}	
	
	/**
	 * create
	 *
	 * This function is use to handle create post api
	 *
	 * @param int 
	 * @return void
	 */
	public function create_post(){
		//$this->auth();
		//get input data
		$input = json_decode(file_get_contents('php://input'), true);
		if((isset($input['title']) && !empty($input['title'])) && (isset($input['desc']) && !empty($input['desc']))){
			// save post data in db	
			if ($this->Post_model->setPost($input)){                             
				//echo json_encode(array('status'=>200,'message'=>''));
				$this->response([
                    'status' => true,
                    'message' => 'Blog added successfully'
                ], REST_Controller::HTTP_OK);				
			}else{                
				//echo json_encode(array('status'=>201,'message'=>'Something went wrong.'));	
				$this->response([
                    'status' => false,
                    'message' => 'Something went wrong.'
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
	 * view
	 *
	 * This function is use to handle view post api
	 *
	 * @param int 
	 * @return void
	 */
	function view_get(){
		//$this->auth();
		//get post id from url
		$id = $this->uri->segment(3);		
        if(empty($id)){
            show_404();
        }		
		// get post data from db	
		if($data=$this->Post_model->getPostById($id)){
			//echo json_encode(array('status'=>200,'post'=>$data,'message'=>''));	
			$this->response([
                    'status' => true,
					'post'=>$data,
                    'message' => ''
                ], REST_Controller::HTTP_OK);
		} else {
			//echo json_encode(array('status'=>200,'post'=>array(),'message'=>'Post not found in database'));
			$this->response([
                    'status' => false,
					'post'=>array(),
                    'message' => 'Post not found in database'
                ], REST_Controller::HTTP_OK);
		} 
	}	
}