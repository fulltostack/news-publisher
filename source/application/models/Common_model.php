<?php

class Common_model extends CI_Model
{
	/*Function: Login
	* Params: Email(string), Password(string), Remember_Me(Boolean)
	* Response: True/False
	*/
	public function login($email,$password,$remember_me=0) {
		$this->db->where("email",$email);
		$this->db->where("password",md5($password));		
		$query=$this->db->get("users");
		if($query->num_rows()>0) {
			$row=$query->row();
			if($row->email_verify==0) {
				$this->session->set_flashdata('postedData',array("email"=>$row->email));
				$this->session->set_flashdata('error', lang('error_9').' <a href="'.base_url('verify').'">'.lang('ctn_109').'</a>');
				redirect('login');
			}

			//add all data to session
			$data = array(
				'user_id' 	=> $row->id,
				'user_name' => $row->first_name,
				'email' 	=> $row->email,
				'logged_in' => TRUE,
				'is_user_in'=>TRUE
			);
			$this->session->set_userdata($data);
			
			if($remember_me>0) {
			    $year = time() + 31536000;
				setcookie('remember_me_user', $email, $year);
				setcookie('remember_me_pass', $password, $year);			    	
		    }
			return true;            
		} else {
			return false;
		}
    }

    /*Function: To check if Email is Available to use by user
	* Params: Email(string), Password(string), Remember_Me(Boolean)
	* Response: Number of Times Email Exist
	*/
    public function checkUserEmailAvailability($where=array()) {
		$this->db->where($where);
		$query = $this->db->get("users");
		return $query->num_rows();
	}

	/*Function: Add new user
	* Response: User Created Id
	*/
	public function register($data=array()){ 
     	$this->db->insert("users",$data);
		$num = $this->db->insert_id();
		return $num;
	}

	/*Function: get user for specific conditon
	* Params: where(array type)
	* Response: Array type (user object)
	*/
	public function getUser($where=array()) {
		$this->db->where($where);
		$data = $this->db->get("users");
		if($data->num_rows()>0){
			return $data->row();
		} else {
			return array();
		}
	}

	/*Function: Update user on specific creteria
	* Params: where(array type), data(array type)
	* Response: True/False
	*/
	public function updateUser($where=array(), $data=array()) {
		$this->db->where($where);
		$this->db->update("users",$data);
		if($this->db->affected_rows()>0) {
			return true;
		} else {
			return false;
		}
	}

	/*Function: Delete user by Email
	* Params: Email(string)
	* Response: True/False
	*/
	public function deleteUser($email="") {
     	$this->db->where("email", $email);
   		if($this->db->delete("users")) {
			return true;
		} else {
			return false;
		}
	}

	/*Function: Add New News by User
	* Params: data(array type)
	* Response: News Creation Id
	*/
	public function addNews($data = array()){ 
     	if(count($data) > 0) {
     		$this->db->insert("news",$data);
			$num = $this->db->insert_id();
			return $num;
		} else {
			return false;
		}
	}
	
	/*Function: Get user specific news list
	* Response: News list Object
	*/
	public function getNewsList() {
		$this->db->where(array("user_id"=>$this->session->userdata('user_id')));
		$this->db->order_by('id','DESC');
		$data = $this->db->get("news");
		if($data->num_rows()>0) {
			return $data->result();
		} else {
			return array();
		}
	}

	/*Function: Get latest news
	* Response: News list Object
	*/
	public function getLatestNewsList() {
		$this->db->where(array("status"=>1));
		$this->db->order_by('id','DESC');
		$this->db->limit(10, 0);
		$data = $this->db->get("news");
		if($data->num_rows()>0) {
			return $data->result();
		} else {
			return array();
		}
	}
	/*Function: Get single news by ID
	* Params: Id(int)
	* Response: Single News Object
	*/
	public function getNewsById($id=0) {
		if($id>0) {
			$this->db->where(array("user_id" => $this->session->userdata('user_id'), "id"=>$id));
			$data = $this->db->get("news");
			if($data->num_rows()>0) {
				return $data->row();
			}
		}
		return array();
	}

	/*Function: Get single news by Slug
	* Params: slug(string)
	* Response: Single News Object
	*/
	public function getNewsBySlug($slug="") {
		if($slug=="")
			return array();

		$this->db->where(array("status"=>1, "slug"=>$slug));
		$data = $this->db->get("news");
		if($data->num_rows()>0) {
			return $data->row();
		} else {
			return array();
		}
	}

	/*Function: Delete news by Id
	* Params: Id(int)
	* Response: True/False
	*/
	public function deleteNews($id=0) {
		if($id > 0) {
	     	$this->db->where("id", $id);
	   		if($this->db->delete("news")) {
				return true;
			}
		}
		return false;
	}

	/*Function: Delete news by Slug
	* Params: slug(string)
	* Response: True/False
	*/
	public function deleteNewsBySlug($slug="") {
		if($slug != "") {
     		$this->db->where("slug", $slug);
   			if($this->db->delete("news")) { 
				return true;
			}
		}
		return false;
	}

	/*Function: Update News
	* Params: where(array type), data(array type)
	* Response: True/False
	*/
	public function updateNews($where=array(), $data=array()) {
		if(count($where) > 0 && count($data) > 0) {
			$this->db->where($where);
			$this->db->update("news",$data);
			if($this->db->affected_rows()>0) {
				return true;
			} 
		}
		return false;
	}
	
}/*EOF*/
?>	