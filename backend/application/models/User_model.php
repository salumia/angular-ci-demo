<?php
/**
 * User model Class
 *
 * @date 07-04-2018
 * @author NS
 */
class User_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
	
	/**
	 * setUser
	 *
	 * This function is use to save user data
	 *
	 * @param array $input
	 * @param id $id 'optional'
	 *
	 * @return object
	 */
    public function setUser($input,$id = 0)
    {		
        $data = array(
            'first_name' => $this->db->escape_str($input['firstName']),
            'last_name' => $this->db->escape_str($input['lastName']),
            'email' => $this->db->escape_str($input['email']),
            'password' => $this->db->escape_str(md5($input['pass'])),
            'updated_at' => date('Y-m-d H:i:s')
        ); 	
        if ($id == 0) {
            return $this->db->insert('user', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('user', $data);
        }
    }	
	
	/**
	 * authenticateUser
	 *
	 * This function is use to authenticate user for login
	 *
	 * @param array $input
	 *
	 * @return array
	 */
	public function authenticateUser($input)
    {
        $query = $this->db->get_where('user', array('email' => $input['email'], 'password' => md5($input['pass'])));        
        return $query->row_array();
    }	
	
	/**
	 * checkUserAlreadyExist
	 *
	 * This function is use to check whether user email exist or not
	 *
	 * @param string $email
	 *
	 * @return boolean
	 */
	public function checkUserAlreadyExist($email){
        $query = $this->db->get_where('user', array('email' => $email));        
        if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
		return false;
    }
    
}
