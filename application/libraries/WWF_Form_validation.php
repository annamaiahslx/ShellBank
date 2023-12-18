<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WWF_Form_validation extends CI_Form_validation {
    protected $CI;

	public function __construct($config = array())
	   {
			parent::__construct($config);
			$this->CI =& get_instance();
			$this->_config_rules = $config;
	   }

	  public function edit_unique($value, $params)  {
	  
	   		$CI =& get_instance();
		   	$CI->load->database();
		   
		   	$CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
		   
		   	list($table, $wherefieldid, $cur_field_id,$current_id) = explode(".", $params);
		   
		   	$query = $CI->db->select()->from($table)->where($wherefieldid, $value)->limit(1)->get();
		   
		   	if ($query->row() && $query->row()->$cur_field_id != $current_id)
		   	{
		   		return FALSE;
		   	} else {
		   		return TRUE;
		   	}
	   }
}