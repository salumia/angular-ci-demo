<?php   
/**
 * Post model Class
 *
 * @date 07-04-2018
 * @author NS
 */
class Post_model extends CI_Model  {
	public function __construct(){
        $this->load->database();
    }

	/**
	 * getAllPosts
	 *
	 * This function is use to get all the posts
	 *
	 * @return array
	 */
	public function getAllPosts(){
		$this->db->select("post.id,post.title,post.user_id,user.first_name,user.last_name,DATE_FORMAT(post.updated_at, '%D %M, %Y') as created,SUBSTRING_INDEX(body, ' ', 100) as description");
		$this->db->from('post');
		$this->db->join('user', 'user.id = post.user_id');
		$query = $this->db->get();
        return $query->result_array();
	}
	
	/**
	 * getAllPostsByUser
	 *
	 * This function is use to get all posts of user
	 *
	 * @param user id $userId
	 *
	 * @return array
	 */
	public function getAllPostsByUser($userId){
		$this->db->select("post.id,post.title,post.user_id,user.first_name,user.last_name,DATE_FORMAT(post.updated_at, '%D %M, %Y') as created,SUBSTRING_INDEX(body, ' ', 100) as description");
		$this->db->from('post');
		$this->db->join('user', 'user.id = post.user_id');
		$this->db->where('post.user_id', $userId); 
		$query = $this->db->get();
        return $query->result_array();
	}
	
	/**
	 * getPostById
	 *
	 * This function is use to get post data
	 *
	 * @param id $id
	 *
	 * @return array
	 */
	public function getPostById($id){    
		$this->db->select("post.id,post.title,post.body as description,post.user_id,user.first_name,user.last_name,DATE_FORMAT(post.updated_at, '%D %M, %Y') as created");
		$this->db->from('post');
		$this->db->join('user', 'user.id = post.user_id');
		$this->db->where('post.id', $id); 
		$query = $this->db->get();
        return $query->row_array();
    }
	
	/**
	 * setPost
	 *
	 * This function is use to save post data
	 *
	 * @param array $input
	 * @param id $id 'optional'
	 *
	 * @return object
	 */
	public function setPost($input,$id = 0){
        $data = array(
            'title' => $this->db->escape_str($input['title']),
            'body' => $this->db->escape_str($input['desc']),
            'user_id' => $this->db->escape_str($input['userId']),
            'updated_at' => date('Y-m-d H:i:s')
        ); 	
        
        if ($id == 0) {
            return $this->db->insert('post', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('post', $data);
        }
    }
}
