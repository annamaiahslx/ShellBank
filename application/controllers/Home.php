<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends WWF_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$data = array();
		$this->template->set('title', $this->config->item('app_name'));
		$this->template->set('page_title', 'Dashboard');
		$this->template->set('page_breadcrumb', 'User - Dashboard');
		$this->template->load('template', 'contents' , 'home',$data);
		
	}
	
	public function cronTest(){

		$data['email'] = 'annamaiah@yopmail.com';
		$data['added_date'] = date('Y-m-d H:i:s');

		$this->db->insert('TEST_USERS', $data);

		return TRUE;
	}
}
