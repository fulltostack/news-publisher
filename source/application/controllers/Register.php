<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('encrypt');
	}

	/**
	*@access public
	* Function to Register new user
	* Request Types: POST, GET
	* Accepted Params : first_name(string), last_name(string), email(string), password(string), confirm_password(string),
	**/
	public function index() {
		if($this->input->post()) {
			$first_name 	= $this->input->post("first_name");
			$last_name 		= $this->input->post("last_name");
			$email 			= $this->input->post("email");
			$password 		= $this->input->post("password");

			if($email=="") {
				$this->session->set_flashdata('error', lang('error_3'));
				redirect('register');
		    }

		    if(!valid_email($email)) {
				$this->session->set_flashdata('error', lang('error_4'));
				redirect('register');
		    }

			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|callback_user_email_check');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error',validation_errors());
				$this->session->set_flashdata('postedData',$this->input->post());
				redirect('register');
			}

			$userData = array(
				"first_name"	=>	$first_name,
				"last_name"		=>	$last_name,
				"email"			=>	$email,
				"password"		=>	md5($password),
				"created_date"	=>	date("Y-m-d H:i:s")
				);

			$status=$this->common_model->register($userData);
			if($status) {
				//Send verification email
				$this->send_email(array("user_id"=>$status, "first_name"=>$first_name, "last_name"=>$last_name, "email"=>$email, "password"=>$password));

				$this->session->set_flashdata('success', lang('success_1').' <a href="'.base_url('verify').'">'.lang('ctn_109').'</a>');
				redirect('register');
			} else {
				$this->session->set_flashdata('error', lang('error_1'));
				redirect('register');
			}
		}

		$data['site_title'] = lang('ctn_1').': Register';
		$this->load->view('header', $data);
		$this->load->view('register');
		$this->load->view('footer');
	}

	/**
	*@access public
	*Function for new password 
	* Request Types: POST
	* Accepted Params: id (int), password (string)
	**/
	public function newpassword() {
		if($this->input->post()) {
			$user_id = preg_replace('/\s+/', '+', urldecode($this->input->post("id")));
			$user_id=$this->encrypt->decode($user_id);
			$status=$this->common_model->getUser(array('id'=>$user_id));
			if(empty($status)) {
				$this->session->set_flashdata('error', lang('error_2'));
				redirect('newpassword');
			}

			$password 	= $this->input->post("password");

			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error',validation_errors());
				redirect('newpassword');
			}

			$userData = array(
				"email_verify"	=>	1,
				"password"		=>	md5($password),
				"updated_date"	=>	date("Y-m-d H:i:s")
				);

			$status=$this->common_model->updateUser(array('id'=>$user_id), $userData);
			if($status) {			
				$this->session->set_flashdata('success', lang('success_4'));
				redirect('login');
			} else {
				$this->session->set_flashdata('error', lang('error_1'));
				redirect('newpassword');
			}
		}

		$data['site_title'] = lang('ctn_1').': New Password';
		$this->load->view('header', $data);
		$this->load->view('newpassword');
		$this->load->view('footer');
	}

	/**
	*@access public
	* Function to verify user Registration Email
	* Request Types: POST
	* Accepted Params: email (string)
	**/
	public function verify() {
		if($this->input->post()) {
			$email = $this->input->post("email");

			if($email=="") {
				$this->session->set_flashdata('error', lang('error_3'));
				redirect('verify');
		    }

			if(!valid_email($email)) {
				$this->session->set_flashdata('error', lang('error_4'));
				redirect('verify');
		    }

			$this->form_validation->set_rules('email', 'Email', 'required|trim');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error',validation_errors());
				$this->session->set_flashdata('postedData',$this->input->post());
				redirect('verify');
			}

			$userData=$this->common_model->getUser(array('email'=>$email));
			if(empty($userData)) {
				$this->session->set_flashdata('error', lang('error_2'));
				redirect('verify');
			} else {
				//Send verification email
				$this->send_email(array("user_id"=>$userData->id, "first_name"=>$userData->first_name, "last_name"=>$userData->last_name, "email"=>$userData->email));
				
				$this->session->set_flashdata('success', lang('success_5'));
				redirect('login');
			}
		}

		$data['site_title'] = lang('ctn_1').': New Password';
		$this->load->view('header', $data);
		$this->load->view('verify');
		$this->load->view('footer');
	}

	/**
	*@access public
	*Function for check user email availability
	**/
	public function user_email_check($str) {
		$record = $this->common_model->checkUserEmailAvailability(array('email'=>$str));
		if ($record) {
			$this->form_validation->set_message('user_email_check', lang('error_5'));
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	*@access private
	*Function to send verification email
	**/
	private function send_email($data) {
		$this->load->library('email');
		$config = array(
			'protocol' 	=> 'smtp',
			'smtp_host' => SMTP_HOST,
			'smtp_port' => SMTP_PORT,
			'smtp_user' => SMTP_USER,
			'smtp_pass' => SMTP_PASS,
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from(FROM_MAIL, lang('ctn_1'));
		$this->email->to($data['email']); 
		$this->email->subject(lang('ctn_1')." verification");
		$body = $this->load->view('email_templates/verification_email_register.php',$data,TRUE);
		$this->email->message($body);   
		$this->email->send();
	}
}