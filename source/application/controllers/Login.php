<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	*@access public
	* Function to login
	* Request Types: POST,GET
	* Accepted Params: Email(string), Password(string), RememberMe(Boolean)
	**/
	public function index() {
		if($this->input->post()) {

			$email 			= $this->input->post("email");
			$password 		= $this->input->post("password");
			$remember_me 	= $this->input->post("remember_me");

			if($email=="") {
				$this->session->set_flashdata('error', lang('error_3'));
				redirect('login');
		    }
		    
			if(!valid_email($email)) {
				$this->session->set_flashdata('error', lang('error_4'));
				redirect('login');
		    }

			$this->form_validation->set_rules('email', 'Email', 'required|trim');
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('error',validation_errors());
				$this->session->set_flashdata('postedData',$this->input->post());
				redirect('login');
			}

			$status=$this->common_model->login($email,$password,$remember_me);
			if($status) {
				$this->session->set_flashdata('success', lang('success_3'));
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', lang('error_10'));
				redirect('login');
			}
		}

		$data['site_title'] = lang('ctn_1').': Login';
		$this->load->view('header', $data);
		$this->load->view('login');
		$this->load->view('footer');
	}

	/**
	*@access public
	*Function to logout user
	**/
	public function logout() {
		$this->session->sess_destroy();
		redirect('');
	}

}
