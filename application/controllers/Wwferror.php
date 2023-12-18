<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wwferror extends WWF_Controller {

	public function __construct() 
	 {
	    parent::__construct(); 
	 } 
	public function index()
	{	$data=array();
	
		$this->template->set('title', $this->config->item('app_name'));
		$this->template->set('page_title', 'Page not Found');
		$this->template->set('page_breadcrumb', 'Page not Found');
		$this->template->load('template', 'contents' , 'error_404',$data);
	}

	public function access_denied(){
		$data=array();
		$this->template->set('title', $this->config->item('app_name'));
		$this->template->set('page_title', 'Unauthorized');
		$this->template->set('page_breadcrumb', 'Unauthorized');
		$this->template->load('template', 'contents' , 'access_denied',$data);
	}
}
