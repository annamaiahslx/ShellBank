<?php

class WWF_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'role_action_helper'));
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'custom_helper'));
        $this->load->library('form_validation');
        $this->load->library('template');
//Administrator, Audit Supervisor, Assigned Auditor, Responsible Manager, Responsible Officer, Viewer.
        //check the login redirection
		$this->isAdmin = $this->isRmanager = $this->isViewer = $this->isOfficer = $this->isRofficer = $this->isAofficer = false;
		$user_assign_role = $this->session->userdata('user_assign_role');
		if($user_assign_role!=''){
			$user_assign_role = explode(',',$user_assign_role);
			if(count($user_assign_role)>0){
				foreach($user_assign_role as $uar){
					if($uar == '5'){
						$this->isAdmin = true;
					}else if($uar == '37'){
						$this->isRmanager = true;
					}else if($uar == '38'){
					}else if($uar == '39'){
						 $this->isViewer = true;
					}else if($uar == '44'){
						$this->isOfficer = true;
					}else if($uar == '45'){
						$this->isRofficer = true;
					}
				}
			}
		}
        $this->isAofficer = $this->session->userdata('audit_user_role') == 'Audit Officer' ? true : false;
        $this->isUserID = $this->session->userdata('user_id');
        $this->isCountryID = $this->session->userdata('country_id');
		
		$this->isAssignedAuditor = $this->session->userdata('audit_app_assigauditor') != '' ? true : false;
        $this->isAuditSupervisor = $this->session->userdata('audit_app_superisor') != '' ? true : false;
        $this->isResponsiblemanager = $this->session->userdata('audit_app_resp_mang') != '' ? true : false;
        $this->isResponsibleOfficer = $this->session->userdata('audit_app_resp_officer') != '' ? true : false;
        $this->isAuditViewer = $this->session->userdata('audit_app_viewer') != '' ? true : false;
		$this->isAuditAdmin = $this->session->userdata('audit_app_admin') != '' ? true : false;
		

       
	   if ($this->router->fetch_class() == 'user') {
       if ($this->router->fetch_method() != 'logout' && $this->router->fetch_method() != 'switch_role' ) {
       if ($this->session->userdata('audit_logged_in')) {
       redirect('/audit');
       }
       }
       } else {
       if (!$this->session->userdata('audit_logged_in')) {
       redirect('/user');
       }
       }

        $this->audit = 471; // Audit Module
        $this->audit_type = 472; // Audit Type  Module
        $this->department = 473; // Department  Module
        $this->area_recommendation = 474; // Area of recommendation  Module
        $this->user_mang = 475; // user managment module
        $this->report = 476;
        $this->activity_master = 659;
        $this->activities = 664;
		
		$this->findings = 635;
		$this->recommendation = 636;
		$this->agreed_action = 637;
		$this->user_guide = 641;
		$this->email_template = 642;
		$this->closed_audits = 643;
		$this->activity_master = 655;
		$this->activities = 656;
    }
}
