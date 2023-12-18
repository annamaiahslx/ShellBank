<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends WWF_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'title' => $this->config->item('app_name'),
			'csrf_fname' => $this->security->get_csrf_token_name(),
			'csrf_hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('user/login',$data);
		if ($this->input->server('REQUEST_METHOD') == 'POST'){
			$newdata = array(
					'logged_in' => TRUE,
					'user_role'=> 'admin', //manager , user, admin
					'user_id'=>'12',
					'country_id'=>'13'
			);
			$this->session->set_userdata($newdata);
			redirect('/audit');
			
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	
	
	
}
