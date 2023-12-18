<?php
 if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
 }

if (!function_exists('action_authorization')) {
    function action_authorization($id, $action)
    {
        $CI = &get_instance();
        $CI->load->library('session');

         /* Added by PTP - 5592 */
        $activeProfile 	= $CI->session->userdata('active_profile');
		$role_code     	= $activeProfile['ROLE_CODE'];
		$role_id     	= $activeProfile['ROLE_ID'];
		 /* Added by PTP - 5592 */

		if($role_code == 'administrator'){
			return true;
		}

        $app_id = $CI->config->item('app_id');
        $CI->db->select($action);
        $CI->db->where('ELEMENT_ID', $id);
        $CI->db->where('APPLICATION_ID', $app_id);
        $CI->db->where('ROLE_ID', $role_id );
        $result = $CI->db->get('INSIGHT_ACTION')->row();
        if (count($result) == 0) {
            redirect('wwferror/access_denied');
        }else{
        	if($result->$action==0){
        		 redirect('wwferror/access_denied');
        	}else{
        		return true;
        	}
        }
    }
}


if (!function_exists('action_top_header_authorization')) {
    function action_top_header_authorization($id, $action)
    { 
		$urole = array();
        $CI = &get_instance();
        $CI->load->library('session');

         /* Added by PTP - 5592 */
        $activeProfile 	= $CI->session->userdata('active_profile');
		$role_code     	= $activeProfile['ROLE_CODE'];
		$role_id     	= $activeProfile['ROLE_ID'];
		 /* Added by PTP - 5592 */

		 
		$CI->session->userdata('audit_app_admin')!= ''? array_push($urole,$CI->session->userdata('audit_app_admin')): "";		
		$CI->session->userdata('audit_app_viewer')!= ''? array_push($urole,$CI->session->userdata('audit_app_viewer')): "";
		$CI->session->userdata('audit_app_superisor')!= ''? array_push($urole,$CI->session->userdata('audit_app_superisor')): "";
		$CI->session->userdata('audit_app_resp_officer')!= ''? array_push($urole,$CI->session->userdata('audit_app_resp_officer')): "";
		$CI->session->userdata('audit_app_resp_mang')!= ''? array_push($urole,$CI->session->userdata('audit_app_resp_mang')): "";
		$CI->session->userdata('audit_app_assigauditor')!= ''? array_push($urole,$CI->session->userdata('audit_app_assigauditor')): "";
		
     
        $app_id = $CI->config->item('app_id'); 
        $CI->db->select($action);
        $CI->db->where('ELEMENT_ID', $id);
        $CI->db->where('APPLICATION_ID', $app_id);
        $CI->db->where_in('ROLE_ID', $role_id);
        $result = $CI->db->get('INSIGHT_ACTION')->result_array();
        if (count($result) == 0) {
            redirect('wwferror/access_denied');
        }else{
			$retun_status = false;
			foreach($result as $res){
				
				if($res[$action] == 1 ){
					$retun_status = true;
					break;
				}
			}
        	if($retun_status== false){
        		 redirect('wwferror/access_denied');
        	}else{
        		return true;
        	}
        }
    }
	
	
}



if (!function_exists('check_action_permission')) {
    function check_action_permission($id, $action)
    {  
        $CI = &get_instance();
        $CI->load->library('session');

        /* Added by PTP - 5592 */
        $activeProfile 	= $CI->session->userdata('active_profile');
		$role_code     	= $activeProfile['ROLE_CODE'];
		$role_id     	= $activeProfile['ROLE_ID'];
		 /* Added by PTP - 5592 */

		 if($role_code == 'administrator'){
		 	return true;
		 }

        $app_id = $CI->config->item('app_id');
        $CI->db->select($action);
        $CI->db->where('ELEMENT_ID', $id);
        $CI->db->where('APPLICATION_ID', $app_id);
        $CI->db->where_in('ROLE_ID', $role_id ); /* Added by PTP - 5592 */
        $query_obj = $CI->db->get('INSIGHT_ACTION');

        $result = is_object($query_obj) ? $query_obj->row_array() : array();
        
		if (count($result) == 0) {
            return false;
        } else {
        	if($result[$action]==0){
        		return false;
        	}else{
        		return true;
        	}
           
        }
    }
}


if (!function_exists('curdActions')) {
    function curdActions($id)
    {
        $actionID = 0;
        $canView = 0;
        $canAdd = 0;
        $canEdit = 0;
        $canDelete = 0;
        $CI = &get_instance();
        $role_id = $CI->config->item('role_id');
        $app_id = $CI->config->item('app_id');
        $CI->db->select('*');
        $CI->db->where('ELEMENT_ID', $id);
        $CI->db->where('APPLICATION_ID', $app_id);
        $CI->db->where('ROLE_ID', $role_id);
        $result = $CI->db->get('INSIGHT_ACTION')->row();
        if (count($result) > 0) {
            $actionID = $result->ACTION_ID;
        }
        if (isset($result->CAN_VIEW) && $result->CAN_VIEW == 1) {
            $canView = 1;
        }
        if (isset($result->CAN_ADD) && $result->CAN_ADD == 1) {
            $canAdd = 1;
        }
        if (isset($result->CAN_EDIT) && $result->CAN_EDIT == 1) {
            $canEdit = 1;
        }
        if (isset($result->CAN_DELETE) && $result->CAN_DELETE == 1) {
            $canDelete = 1;
        }

        return $actionID.':'.$canView.':'.$canAdd.':'.$canEdit.':'.$canDelete;
    }
}
    if (!function_exists('role_name')) {
        function role_name($role_name)
        {
            if ($role_name == 'User') {
                return 'Responsible Officer';
            } elseif ($role_name == 'Administrator') {
                return 'Audit Supervisor';
            }

            return $role_name;
        }
    }
	
if (!function_exists('action_office_role_authorization')) {
	function action_office_role_authorization($id, $action,$role_id){
		$CI = &get_instance();
		$app_id = $CI->config->item('app_id'); 
        $CI->db->select($action);
        $CI->db->where('ELEMENT_ID', $id);
        $CI->db->where('APPLICATION_ID', $app_id);
        $CI->db->where_in('ROLE_ID', $role_id);
        $result = $CI->db->get('INSIGHT_ACTION')->result_array();
        if (count($result) == 0) {
            return 0;
        }else{
			$retun_status = false;
			foreach($result as $res){
				if($res[$action] == 1 ){
					$retun_status = true;
					break;
				}
			}
        	if($retun_status== false){
        		 return 0;
        	}else{
        		return 1;
        	}
        }
	}
}

if (!function_exists('action_multi_role_authorization')) {
    function action_multi_role_authorization($id, $action,$return_type = null)
    {
        $CI = &get_instance();
        $CI->load->library('session');
		$arrVals = '';
		if($CI->session->userdata('user_assign_role')!=''){
			$arrVals = array_values(explode(',',$CI->session->userdata('user_assign_role')));
		}

		$activeProfile 	= $CI->session->userdata('active_profile');
		$role_code     	= $activeProfile['ROLE_CODE'];
		$role_id     	= $activeProfile['ROLE_ID'];

        $app_id = $CI->config->item('app_id');
        $CI->db->select($action);
        $CI->db->where('ELEMENT_ID', $id);
        $CI->db->where('APPLICATION_ID', $app_id);
		/*if($arrVals!=''){
			$CI->db->where_in('ROLE_ID', array_values($arrVals));
		}*/

		if($role_id != ''){
			$CI->db->where('ROLE_ID', $role_id);
		}

        $result = $CI->db->get('INSIGHT_ACTION')->result_array();

        //pr($result);die;
        //echo $CI->db->last_query();die;
        if (count($result) == 0) {
			if($return_type == 1){
				return false;
			}else{
				redirect('wwferror/access_denied');
			}
            
        }else{
			$access_return = false;
			foreach($result as $r){
				if($r[$action] == '1'){
					$access_return = true;
				}
			}

        	if($access_return){
				return true;
        	}else{
        		if($return_type == 1){
					return false;
				}else{
					redirect('wwferror/access_denied');
				}
        	}
        }
    }
}

if (!function_exists('action_multi_role_office_authorization')) {
    function action_multi_role_office_authorization($id, $action,$office_id,$return_type = null)
    { 
		
        $CI = &get_instance();
        $CI->load->library('session');

        $activeProfile 	= $CI->session->userdata('active_profile');
		$role_code     	= $activeProfile['ROLE_CODE'];
		$role_id     	= $activeProfile['ROLE_ID'];


		//$user_office_role = $CI->session->userdata('user_office_role');
		//$urole_id = $CI->session->userdata('audit_urole_id');
		
		if($role_id == '5'){
			return true;
		}

		$user_access_page = false;

		$access_role = action_office_role_authorization($id, $action,$role_id);
		if($access_role == 1){
			$user_access_page = true;
			
		}

		if($return_type == '1' && $user_access_page == false){
			redirect('wwferror/access_denied');
		}else{
			return $user_access_page;
		}
    }
}