<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		is_user_in();
	}

	/**
	*@access public
	*Function for registration
	**/
	public function index() {
		$data['site_title'] = lang('ctn_1').': '.lang('ctn_5');
		$data['result'] = $this->common_model->getNewsList();
		$this->load->view('header', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}

	/**
	*@access public
	* Function for add news
	* Request Type: POST, GET
	* Accepted Params : title(string), text(string), image(string)
	**/
	public function addNews() {
		if($this->input->post()) {
			$this->load->library("upload");

			$title 	= $this->input->post("title");
			$text 	= $this->input->post("text");

			$this->form_validation->set_rules('title', 'Title', 'required|trim');
			$this->form_validation->set_rules('text', 'Text', 'required|trim');
			if (!isset($_FILES['userfile']['name']) || empty($_FILES['userfile']['name'])){
			    $this->form_validation->set_rules('userfile', 'File', 'required|trim');
			}
			
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error',validation_errors());
				$this->session->set_flashdata('postedData',$this->input->post());
				redirect('add-news');
			}

			$slug = return_availabel_news_url($title);

			$userData = array(
				"slug"		=>	$slug,
				"title"		=>	$title,
				"text"		=>	$text,
				"user_id"	=>	$this->session->userdata('user_id'),
				"status"	=>	0,
				"created_date"	=>	date("Y-m-d H:i:s")
				);

			if ($_FILES['userfile']['size'] > 0) {
				$this->upload->initialize(array( 
			       "upload_path" => UPLOAD_PATH,
			       "overwrite" => FALSE,
			       "max_filename" => 300,
			       "encrypt_name" => TRUE,
			       "remove_spaces" => TRUE,
			       "allowed_types" => "gif|png|jpg|jpeg",
			       //"max_size" => 1028
			    ));

			    if (!$this->upload->do_upload()) {
			    	$this->session->set_flashdata('error', lang("error_101").$this->upload->display_errors());
					$this->session->set_flashdata('postedData',$this->input->post());
					redirect('add-news');
			    }

			    $data = $this->upload->data();

			    $userData['photo'] = $data['file_name'];

			    //Start Image Manupulation
				    imageManupulationCI(UPLOAD_PATH, $image);
			    //End Image Manupulation
			}
			

			$status=$this->common_model->addNews($userData);
			if($status) {				
				$this->session->set_flashdata('success', lang('success_104'));
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', lang('error_1'));
				redirect('add-news');
			}
		}

		$data['site_title'] = lang('ctn_1').': '.lang('ctn_207');
		$this->load->view('header', $data);
		$this->load->view('add_news');
		$this->load->view('footer');	
	}

	/**
	*@access public
	* Function for change news status
	* Request Type: GET
	* Accepted Params : status(string), id(int)
	**/
	public function publishNews($id="") {
		$status = $this->uri->segment(2);
		$id 	= $this->uri->segment(3);
		
		if($status=="" || $id=="") {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('dashboard');
		}
		$getNews = $this->common_model->getNewsById($id);
		if(empty($getNews)) {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('dashboard');
		}

		$isstatus=$this->common_model->updateNews(array('id'=>$id), array("status"=>$status));
		if($isstatus) {
			$successMsg = ($status==0)?lang('success_103'):lang('success_102');
			$this->session->set_flashdata('success', $successMsg);
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', lang('error_1'));
			redirect('dashboard');
		}
	}

	/**
	*@access public
	* Function for delete news
	* Request Type: GET
	* Accepted Params: id(int)
	**/
	public function deleteNews() {
		$id = $this->uri->segment(2);
		if($id=="") {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('dashboard');
		}
		$getNews = $this->common_model->getNewsById($id);
		if(empty($getNews)) {
			$this->session->set_flashdata('error', lang('error_2'));
			redirect('dashboard');
		}

		$getNews = $this->common_model->deleteNews($id);
		$this->session->set_flashdata('success', lang('success_101'));
		redirect('dashboard');		
	}

}