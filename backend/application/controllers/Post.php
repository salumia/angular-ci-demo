<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
/**
	* Post Controller Class
	* @date 07-04-2018
	* @Purpose:This controller class handles all post related api.
	* @author NS
	
**/
class Post extends CI_Controller
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
	function index(){
		// get all posts from db
		if($data=$this->Post_model->getAllPosts()){
			echo json_encode(array('status'=>200,'posts'=>$data,'message'=>''));	
		} else {
			echo json_encode(array('status'=>200,'posts'=>array(),'message'=>'Posts not found in database'));
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
	function myPosts(){
		//get user id from url
		$userId = $this->uri->segment(3);
		
		// get user posts from db
		if($data=$this->Post_model->getAllPostsByUser($userId)){
			echo json_encode(array('status'=>200,'posts'=>$data,'message'=>''));	
		} else {
			echo json_encode(array('status'=>200,'posts'=>array(),'message'=>'Your dont have posts'));
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
	public function create(){
		//get input data
		$input = json_decode(file_get_contents('php://input'), true);
		if((isset($input['title']) && !empty($input['title'])) && (isset($input['desc']) && !empty($input['desc']))){
			// save post data in db	
			if ($this->Post_model->setPost($input)){                             
				echo json_encode(array('status'=>200,'message'=>''));			
			}else{                
				echo json_encode(array('status'=>201,'message'=>'Something went wrong.'));	
			} 
		} else {
			echo json_encode(array('status'=>201,'message'=>'Required fields are missing'));
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
	function view(){
		//get post id from url
		$id = $this->uri->segment(3);		
        if(empty($id)){
            show_404();
        }		
		// get post data from db	
		if($data=$this->Post_model->getPostById($id)){
			echo json_encode(array('status'=>200,'post'=>$data,'message'=>''));	
		} else {
			echo json_encode(array('status'=>200,'post'=>array(),'message'=>'Post not found in database'));
		} 
	}	
}